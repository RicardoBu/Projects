<?php
session_start();
include_once('../Login_logout/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produtoId = $_POST['produtoId'];
    $acao = $_POST['acao']; // Pode ser 'adicionar' ou 'remover'

    // Verificar se o produto existe
    $query = "SELECT quantidade FROM produtos WHERE produtoID = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $produtoId);
    $stmt->execute();
    $stmt->bind_result($quantidadeAtual);
    $stmt->fetch();
    $stmt->close();

    if ($quantidadeAtual !== null) {
        if ($acao === 'adicionar') {
            // Adicionar 1 à quantidade
            $novaQuantidade = $quantidadeAtual + 1;
        } elseif ($acao === 'remover') {
            // Remover 1 da quantidade, se for maior que 0
            $novaQuantidade = max(0, $quantidadeAtual - 1); // Garante que não fique abaixo de 0
        }

        // Atualizar a quantidade no banco de dados
        $updateQuery = "UPDATE produtos SET quantidade = ? WHERE produtoID = ?";
        $stmtUpdate = $conexao->prepare($updateQuery);
        $stmtUpdate->bind_param("ii", $novaQuantidade, $produtoId);
        $stmtUpdate->execute();
        $stmtUpdate->close();
    }
}

header("Location: produtos_admin.php"); // Redireciona de volta para a página de administração
exit();
