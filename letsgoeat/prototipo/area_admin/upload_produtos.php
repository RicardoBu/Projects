<?php
session_start();

include_once('../Login_logout/config.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST') {

   $quantidade = $_POST['quantidade'];
   $preco = $_POST['preco'];
   $prato = $_POST['prato'];
   $tipo_comida = $_POST['tipo_comida'];

   $sql = "INSERT INTO produtos ( quantidade ,preco, nome_produto, tipo_comida) VALUES ( '$quantidade' ,'$preco', '$prato', '$tipo_comida' )";

   if( $conexao->query($sql) === TRUE) {
      echo "Prato adicionado  com sucesso!";
  } else {
      echo "Erro ao adicionar  o prato:" .$conexao->error;
  }
}

?>

<html>
   <head>
      <title>Adicionar Pratos</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
             body {
    background-color: #f8f0e3
}
        </style>
   </head>
   <body >
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="admin.php">Home</a>
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
    <h1>Adicionar Pratos</h1>
   <form class="border  p-4 rounded" action="" method="POST">
                <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Quantidade:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantidade" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Preço:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="preco" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Prato:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="prato" id="hora" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Tipo de comida:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tipo_comida" id="hora" required>
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