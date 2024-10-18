

<?php

include_once('../Login_logout/config.php');

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

session_start();  // Certifique-se de que a sessão está iniciada
$email = $_SESSION['email'] ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber o array de opções selecionadas
    $opcoes = json_decode($_POST['opcoes'], true); // Decodificar o JSON para um array PHP

    if (!empty($opcoes) && is_array($opcoes)) {
        // Limpar as entradas antigas para o email atual
        $stmtDelete = $conexao->prepare("DELETE FROM pedidos_temp WHERE email = ?");
        $stmtDelete->bind_param("s", $email);
        if (!$stmtDelete->execute()) {
            echo "Erro ao limpar entradas antigas: " . $stmtDelete->error;
            exit(); // Parar a execução se falhar
        }
        $stmtDelete->close();

        // Preparar a query de inserção para os novos produtos
        $stmt = $conexao->prepare("INSERT INTO pedidos_temp (email, produtos_selecionados, quantidade) VALUES (?, ?, ?)");

        foreach ($opcoes as $opcao) {
            // Inserir cada opção individualmente
            $nomeProduto = $opcao['name'];
            $quantidade = (int) $opcao['quantity']; 
          
            
            $stmt->bind_param("ssi", $email, $nomeProduto,$quantidade); // Inserir também a quantidade

            if (!$stmt->execute()) {
                echo "Erro ao registar o pedido para a opção: " . $nomeProduto;
            }
        }

        echo "Pedido registado com sucesso!";
        $stmt->close();
    } else {
        echo "Nenhuma opção válida selecionada.";
    }
    
    // Receber a quantidade selecionada
    if (isset($_POST['quantidade'])) {
        $quantidadeSelecionada = json_decode ($_POST['quantidade'], true);
        
        foreach ($quantidadeSelecionada as $quantidade) {
            $produtoId = $quantidade['produtoId'];
            $quantidadeValor = $quantidade['quantidade'];
            
            // Inserir a quantidade selecionada na tabela pedidos_temp
            $stmtQuantidade = $conexao->prepare("UPDATE pedidos_temp SET quantidade = ? WHERE email = ? AND produtos_selecionados = ?");
            $stmtQuantidade->bind_param("isi", $quantidadeValor, $email, $nomeProduto);
            if (!$stmtQuantidade->execute()) {
                echo "Erro ao atualizar a quantidade: " . $stmtQuantidade->error;
            }
            $stmtQuantidade->close();
        }
    }
}

// ...

$conexao->close();
?>
