<?php
session_start();
include_once('../config.php');

// Ativa a exibição de erros para ajudar na depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $profissao = $_POST['profissao'];

    // Utiliza prepared statements para evitar SQL Injection
    $sql = "INSERT INTO clientes ( Nome, Apelido, Profissao) VALUES ( ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    
    if ($stmt === false) {
        die("Erro na preparação do statement: " . $conexao->error);
    }

    $stmt->bind_param("sss",  $nome, $apelido, $profissao);

    if ($stmt->execute()) {
        echo "Registo feito com sucesso!";
    } else {
        echo "Erro ao fazer o registo: " . $stmt->error;
    }

    $stmt->close();
}

$conexao->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Dados Pessoais</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-info">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../homepage.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <div class="row justify-content-center">
                <h1>Adicionar Dados Pessoais</h1>
                <form class="border border-primary p-4 rounded" action="" method="POST">
                    
                    <div class="mb-3 row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="apelido" class="col-sm-2 col-form-label">Apelido:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="apelido" id="apelido" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="profissao" class="col-sm-2 col-form-label">Profissao:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="profissao" id="profissao" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submeter</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
