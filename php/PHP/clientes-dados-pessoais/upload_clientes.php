<?php
session_start();
include_once('../config.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST') {

   $email = $_POST['email'];
   $nome = $_POST['nome'];
   $apelido = $_POST['apelido'];
   $profissao = $_POST['profissao'];
   

   $sql = "INSERT INTO clientes (  Email, Nome ,Apelido, Profissao) VALUES ( '$email','$nome' ,'$apelido', '$profissao' )";

   if( $conexao->query($sql) === TRUE) {
      echo "Registo  feito com sucesso!";
  } else {
      echo "Erro ao fazer o registo:" .$conexao->error;
  }
}

?>

<html>
   <head>
      <title>Adicionar Clientes</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   </head>
   <body class="bg-info">

   <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="homepage.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="clientes.php">Ver clientes</a>
        </li>
        
      </ul>
      
    </div>
    
      
   
  </div>
</nav>
   <div class="container mt-5">
   <div class="row">
   <div class="col text-center">
   <div class="row justify-content-center">
    <h1>Adicionar Clientes</h1>
   <form class="border border-primary p-4 rounded" action="" method="POST">
                    <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="data" required>
                    </div>
                    </div>
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
                    
                    
                    <button type="submit" class="btn btn-primary">Submeter</button>
                </form>
   </div>

   </div>
   </div>
   </div>
   
      
   </body>



</html>