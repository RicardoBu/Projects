

<?php

session_start();
//header("Content-Security-Policy: script-src 'self';");

include_once('../Login_logout/config.php');

if (!isset($_SESSION['email'])) {
  header("Location: ../index_produtos_registo/login.php");
  exit();
}

$emailUtilizador = $_SESSION['email'] ?? '';

$query = "SELECT * FROM produtos";
$result = mysqli_query($conexao, $query);

if (!$result) {
    die("Erro ao obter produtos: " . mysqli_error($conexao));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $produtos = $_POST['produtos'];  
    $nome = htmlspecialchars(trim($_POST['nome']));
    $apelido = htmlspecialchars(trim($_POST['apelido']));
    $data_nascimento = htmlspecialchars(trim($_POST['data']));
    $morada = htmlspecialchars(trim($_POST['morada']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $preco_total = 0;

    $data_nascimento_dt = new DateTime($data_nascimento);
    $hoje = new DateTime();
    $idade = $hoje->diff($data_nascimento_dt)->y;

    if ($idade < 18) {
        echo "Erro: Você deve ter pelo menos 18 anos para fazer um pedido.";
        exit();
    }

    mysqli_begin_transaction($conexao);

    try {
        $nomes_produtos = [];  // Inicialize o array

        // Obter os nomes dos produtos antes de inserir na tabela encomendas
        foreach ($produtos as $produtoId) {
            $query = "SELECT nome_produto FROM produtos WHERE produtoID = ?";
            $stmtProduto = $conexao->prepare($query);
            $stmtProduto->bind_param("i", $produtoId);
            $stmtProduto->execute();
            $stmtProduto->bind_result($nome_produto);
            $stmtProduto->fetch();
            $stmtProduto->close();

            // Armazenar o nome do produto no array
            $nomes_produtos[] = $nome_produto;
        }

        // Concatene os nomes dos produtos em uma string separada por vírgulas
        $nomes_produtos_str = implode(", ", $nomes_produtos);

        // Inserir na tabela encomendas (agora com os nomes dos produtos prontos)
        $stmt = $conexao->prepare("INSERT INTO encomendas (nome, apelido, data_nascimento, morada_envio, email, nome_produto) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nome, $apelido, $data_nascimento, $morada, $email, $nomes_produtos_str);

        if (!$stmt->execute()) {
            throw new Exception("Erro ao inserir a encomenda: " . $stmt->error);
        }

        $encomendaID = $conexao->insert_id;

        // Inserir os produtos na tabela produtos_encomenda
        $stmtProdutoEncomenda = $conexao->prepare("INSERT INTO produtos_encomenda (encomendaID, produtoID, quantidade, preco) VALUES (?, ?, ?, ?)");
        $stmtUpdate = $conexao->prepare("UPDATE produtos SET quantidade = quantidade - ? WHERE produtoID = ?");

        foreach ($produtos as $produtoId) {
            $quantidade = (int)$_POST['quantidade_' . $produtoId];

            if ($quantidade < 1) {
                throw new Exception("A quantidade deve ser um número válido.");
            }

            $query = "SELECT preco FROM produtos WHERE produtoID = ?";
            $stmtProduto = $conexao->prepare($query);
            $stmtProduto->bind_param("i", $produtoId);
            $stmtProduto->execute();
            $stmtProduto->bind_result($preco_produto);
            $stmtProduto->fetch();
            $stmtProduto->close();

            $preco_total_produto = $preco_produto * $quantidade;
            $preco_total += $preco_total_produto;

            $stmtProdutoEncomenda->bind_param("iiid", $encomendaID, $produtoId, $quantidade, $preco_total_produto);
            if (!$stmtProdutoEncomenda->execute()) {
                throw new Exception("Erro ao inserir o produto na encomenda: " . $stmtProdutoEncomenda->error);
            }

            $stmtUpdate->bind_param("ii", $quantidade, $produtoId);
            if (!$stmtUpdate->execute()) {
                throw new Exception("Erro ao atualizar a quantidade do produto: " . $stmtUpdate->error);
            }
        }

        $stmtUpdateEncomenda = $conexao->prepare("UPDATE encomendas SET preco_total_encomenda = ? WHERE encomendaID = ?");
        $stmtUpdateEncomenda->bind_param("di", $preco_total, $encomendaID);
        if (!$stmtUpdateEncomenda->execute()) {
            throw new Exception("Erro ao atualizar o preço total da encomenda: " . $stmtUpdateEncomenda->error);
        }

        mysqli_commit($conexao);

        // Eliminar os dados da tabela pedidos_temp relacionados ao utilizador após o sucesso
$queryDeleteTemp = "DELETE FROM pedidos_temp WHERE email = ?";
$stmtDeleteTemp = $conexao->prepare($queryDeleteTemp);
$stmtDeleteTemp->bind_param("s", $emailUtilizador);

if (!$stmtDeleteTemp->execute()) {
    throw new Exception("Erro ao eliminar os dados temporários: " . $stmtDeleteTemp->error);
}

// Fechar a instrução
$stmtDeleteTemp->close();
        $_SESSION['mensagem_sucesso'] = "Encomenda realizada com sucesso!";
        header("Location: ../index_produtos_registo/index.php");
        exit();

    } catch (Exception $e) {
        mysqli_rollback($conexao);
        echo "Erro ao processar o pedido: " . $e->getMessage();
    }

    if(isset($_GET['produtoID']) && isset($_GET['quantidade'])) {
        $produtoID = $_GET['produtoID'];
        $quantidade = $_GET['quantidade'];
        mysqli_query($conexao, "insert $produtoID and $quantidade INTO pedidos_temp");
    }

 
  if ($stmtProdutoEncomenda) $stmtProdutoEncomenda->close();
  if ($stmtUpdate) $stmtUpdate->close();

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Area de pedidos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="../css/index.css">
    <style>
        body {
    background-color: #f8f0e3
}
.nav-link {
        margin-right: 15px; 
    }
    </style>
    
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="nav-link" href="../index_produtos_registo/index.php">Inicio</a>
    <a class="nav-link" href="../index_produtos_registo/produtos.php">Pratos</a>
</nav>


<div class="container mt-5">
    <div class="caixa1">
        <h2>Área de pedidos</h2>
        <br>
        <?php
        // Recuperar os produtos previamente selecionados da tabela pedidos_temp
$opcoesSelecionadas = [];
$queryTemp = "SELECT produtos_selecionados, quantidade FROM pedidos_temp WHERE email = ?";
$stmtTemp = $conexao->prepare($queryTemp);
$stmtTemp->bind_param("s", $emailUtilizador);
$stmtTemp->execute();
$stmtTemp->bind_result($produtoSelecionado, $quantidadeSelecionada);

while ($stmtTemp->fetch()) {
    $opcoesSelecionadas[] = [
    'produto' => $produtoSelecionado,
    'quantidade' => $quantidadeSelecionada

    ];
     
}

$stmtTemp->close();

        ?>
        <form action="area_de_pedidos.php" method="POST" id="Formulario">
            <h3>Preencha os seguintes campos:</h3>
            
            <div class="mb-3">
                Nome: <input class="form-control" type="text" name="nome" maxlength="20" size="20" id="nome" placeholder="O seu nome" required> *
            </div>
            
            <div class="mb-3">
                Apelido: <input class="form-control" type="text" name="apelido" maxlength="20" size="20" id="apelido" placeholder="O seu apelido" required> *
            </div>

            <div class="mb-3">
                Data de nascimento: <input class="form-control" type="date" name="data" id="data" required> *
            </div>

            <div class="mb-3">
                Morada de envio: <input class="form-control" type="text" name="morada" maxlength="30" id="morada" placeholder="A sua morada" required> *
            </div>
            <div class="mb-3">
                Email: <input class="form-control" type="email" name="email" maxlength="40" id="email" placeholder="O seu email" required> *
            </div>

            <div class="mb-3">
                Produto escolhido:
                <select class="form-control" name="produtos[]" id="produto" onchange="" multiple required>
                    <?php 
                    while ($produto = mysqli_fetch_assoc($result)) {
                        $produtoId = $produto['produtoID'];
                        $nomeProduto = $produto['nome_produto'];
                        $precoProduto = $produto['preco'];

                        $selecionado = '';
                        $quantidadeSelecionada = 1; // Valor padrão de quantidade
                        foreach ($opcoesSelecionadas as $opcao) {
                            if ($opcao['produto'] == $nomeProduto) {
                                $selecionado = 'selected';
                                $quantidadeSelecionada = $opcao['quantidade']; // Atribui a quantidade armazenada
                                break;
                            }
                        }
            
                        echo "<option value='{$produtoId}' data-preco='{$precoProduto}' data-quantidade='{$produto['quantidade']}' {$selecionado}>{$nomeProduto} - {$precoProduto} EUR</option>";
            
                        // Exibe a quantidade associada ao produto selecionado
                        if ($selecionado) {
                            echo "<script>document.addEventListener('DOMContentLoaded', function() {
                                novoSelectQuantidade('{$produtoId}', '{$nomeProduto}');
                                document.querySelector('#quantidade_{$produtoId}').value = '{$quantidadeSelecionada}';
                            });</script>";
                        }
                    }

                      
                    ?>
                    
   
                </select>*
                <button type="button" id="finalizar">Escolher pratos </button>
                
            </div>

            <div id="quantidadesContainer" class="mb-3">
                <!-- Aqui aparecerão os selects de quantidade por produto -->
            </div>

            <p>(*) Os campos marcados com um asterisco são obrigatórios.</p>

            <div class="mb-3">
                Preço total: <input class="form-control" type="text" id="orcamento" name="preco" readonly>
            </div>
            <input type="submit" class="btn btn-primary" value="Comprar">

            
        </form>
        <div id="resultado"></div>
    </div>
</div>

</body>
<script src="../js/pedidos.js"></script>


</html>