<?php
session_start();
include_once('../config.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST') {

   $email = $_POST['email'];
   $dados = $_POST['dados'];
   $tecnologia = $_POST['tecnologia'];
   $tempo = $_POST['tempo'];

   $sql = "INSERT INTO projectos ( Email ,`Dados do Projecto`, `Tecnologia Usada`, `Tempo de Conclusao`) VALUES ( '$email' ,'$dados', '$tecnologia', '$tempo' )";

   if( $conexao->query($sql) === TRUE) {
      echo "Registo  feito com sucesso!";
  } else {
      echo "Erro ao fazer o registo:" .$conexao->error;
  }
}

?>

<html>
   <head>
      <title>Adicionar Projectos</title>
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
        
       
      </ul>
      
    </div>
    
      
   
  </div>
</nav>

   <div class="container mt-5">
   <div class="row">
   <div class="col text-center">
   <div class="row justify-content-center">
    <h1>Adicionar Projecto</h1>
   <form class="border border-primary p-4 rounded" action="" method="POST">
                <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Email do utilizador:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Dados do Projecto:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="dados" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Tecnologia Usada:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tecnologia" id="hora" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Tempo de Conclusao:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tempo" id="hora" required>
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