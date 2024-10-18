<?php
include_once('../config.php');

if (isset($_POST['id']) && isset($_POST['conteudo']) && isset($_POST['titulo'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    
    $stmt = mysqli_prepare($conexao, "UPDATE noticias SET Titulo = ?, Conteudo = ? WHERE ID = ? ");
    mysqli_stmt_bind_param($stmt, "ssi", $titulo,$conteudo, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: noticias.php?id=' .$id . '&updated=true');
    exit;
    
} else {
   if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = mysqli_prepare($conexao, "SELECT Titulo, Conteudo FROM noticias WHERE ID = ? ");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $titulo, $conteudo);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
} else {
    // Handle the case where the id parameter is not set
    echo "Error: No id parameter provided.Please go back to <a href='noticias.php'>noticias.php</a> and try again.";
    exit;
}

}

?>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Editar noticia</title>
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
          <a class="nav-link active" aria-current="page" href="../admin-topadmin/admin.php">Voltar atras</a>
        </li>
      </ul>
      
    </div>
    
      
   
  </div>
</nav>
    <div class="container mt-5">
<div class="row">
<div class="col text-center">
<div class="row justify-content-center">
<div class="col-md-6">
                <h1 class="text-center">Editar noticia</h1>
                <form class="border border-primary p-4 rounded" action="" method="POST">
                <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Titulo:</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Conteudo:</label>
                        <div class="col-sm-10">
                            <textarea name="conteudo" class="form-control" cols="30" rows="10"><?php echo htmlspecialchars($conteudo); ?></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                            <input  type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            
</div>

</div>
</div>
</div>
        
    </body>
    

</html>



