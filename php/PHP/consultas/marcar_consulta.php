<?php

session_start();
include_once('../config.php');
if(!isset($_SESSION['email']) == true and !isset($_SESSION['senha']) == true) {
  unset($_SESSION['email']);
  unset($_SESSION['senha']);
  header('Location: login.php');  
}

$logado = $_SESSION['email'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $utilizador = $_POST['utilizador'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO marcacoes ( Utilizador ,Hora,`Data da consulta`, Descricao, Email) VALUES('$utilizador','$hora','$data', '$descricao','$logado') ";
    

    if( $conexao->query($sql) === TRUE) {
        echo "Marcacao realizada com sucesso!";
    } else {
        echo "Erro ao fazer a marcacao:" .$conexao->error;
    }
}
?>


</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcar Consultas</title>
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
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="consultas_marcadas.php">Ver consultas</a>
          
        </li>
      </ul>
    </div>
    
  </div>
</nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Marcar Consulta</h1>
                <form class="border border-primary p-4 rounded" action="" method="POST">
                <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Utilizador</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="utilizador" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Data</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="data" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Hora</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" name="hora" id="hora" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="descricao" class="col-sm-2 col-form-label">Descricao</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="descricao" id="descricao" rows="3" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submeter</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
