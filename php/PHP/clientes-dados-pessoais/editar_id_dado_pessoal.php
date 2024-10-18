<?php 
include_once('../config.php');
session_start(); // Certifique-se de iniciar a sessão

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se os campos do formulário estão definidos antes de usá-los
    $nome =  $_POST['nome'];
    $apelido =  $_POST['apelido'];
    $profissao =  $_POST['profissao'];
    $id =  $_POST['id'] ?? null; // Usa o id do formulário ou da sessão

    if ($id) {
        $sql = "UPDATE clientes SET `Nome` = ?, `Apelido` = ?, `Profissao` = ? WHERE `ID` = ?";
        $stmt = $conexao->prepare($sql);
        
        if ($stmt === false) {
            die("Erro na preparação do statement: " . $conexao->error);
        }

        $stmt->bind_param("sssi", $nome, $apelido, $profissao, $id);

        if ($stmt->execute()) {
            echo "Alteração feita com sucesso!";
        } else {
            echo "Erro ao fazer a alteração: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "ID não fornecido.";
    }
}

// Correção da consulta para buscar o cliente
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM clientes WHERE ID=?";
    $stmt = $conexao->prepare($sql);

    if ($stmt === false) {
        die("Erro na preparação do statement: " . $conexao->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Erro ao buscar dados: " . $conexao->error);
    }

    $row = $result->fetch_assoc();
} else {
    echo "ID não fornecido na URL.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Editar Dados Pessoais</title>
</head>
<body class="bg-info">
    <!-- Conteúdo do HTML permanece o mesmo -->
    <div class="container mt-5">
   <div class="row">
   <div class="col text-center">
    <h1>Editar dado pessoal</h1>
   <div class="row justify-content-center">
   <form class="border border-primary p-4 rounded" action="" method="POST">
                <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Nome:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nome" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Apelido:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="apelido" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Profissao:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="profissao" id="hora" required>
                        </div>
                    </div>
                    
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"> 
                    <button type="submit" class="btn btn-primary">Submeter</button>
                </form>
   </div>
   </div>
   </div>
   </div>
</body>
</body>
</html>

