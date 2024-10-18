<?php 

session_start();
include_once('../config.php');

if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
    exit();
}

$logado = $_SESSION['email'];



$sql = "SELECT * FROM clientes ";
$stmt = $conexao->prepare($sql);

$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>

<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Clientes</title>
       
    </head>
    <body class="bg-info">
    <nav class="navbar navbar-expand-lg  navbar-light bg-light ">
  <div class="container-fluid">
    <a class="navbar-brand" href="../homepage.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="upload_clientes.php">Adicionar clientes</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
    <div class="container mt-5">
      <div class="row">
       <div class="col text-center">
        <?php echo "<h1>Utilizador logado: $logado</h1>" ?>
       <table class="table">
            <thead>
                <tr>
                    
                    <th>Nome</th>
                    <th>Apelido</th>
                    <th>Profissao</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                if($result->num_rows >0){
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                       
                        echo "<td>" .$row['Nome'] . "</td>";
                        echo "<td>" .$row['Apelido'] . "</td>";
                        echo "<td>" .$row['Profissao'] . "</td>";
                        echo "<td><a class='btn btn-primary'   href='editar_clientes.php?id=" .$row['ID']."'>Editar</a></td>";
                        echo "<td><a class='btn btn-danger'  href='eliminar_clientes.php?id=" .$row['ID']."'>Eliminar</a></td>";
                         
                        echo "</td>";
                        echo "</tr>";
                    } 

                } else {
                    echo "<tr><td colspan='4'>Nenhum cliente  encontrado.</td></tr>";

            
                }
                
                ?>
            </tbody>

        </table>

       </div>
      </div>
    </div>
        
    </body>
</html>