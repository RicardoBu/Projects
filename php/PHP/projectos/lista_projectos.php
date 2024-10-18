
<?php 

session_start();
include_once('../config.php');
$query= "SELECT * FROM projectos";
$result = mysqli_query($conexao, $query);

?>

<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Projectos</title>
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
          <a class="nav-link active" aria-current="page" href="upload_projecto.php">Adicionar projectos</a>
        </li>
        
      </ul>
      
    </div>
  </div>
</nav>
    

    <div class="container mt-5">
    <div class="row">
     <div class="col text-center">
      <h1>Lista de Projectos</h1>
     <table class="table">
            <thead>
                <tr>
                <th scope="col">Email </th>
                <th scope="col">Dados do Projecto</th>
                <th scope="col">Tecnologia Usada</th>
                <th scope="col">Tempo de Conclusao</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
                
                </tr>

            </thead>
            <tbody>
                <?php 
                while( $user_data = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" .htmlspecialchars($user_data['Email']) . "</td>";
                  echo "<td>" .htmlspecialchars($user_data['Dados do Projecto']) . "</td>";
                  echo "<td>" .htmlspecialchars($user_data['Tecnologia Usada']) . "</td>";
                  echo "<td>" .htmlspecialchars($user_data['Tempo de Conclusao']) . "</td>";
                  echo "<td><a class='btn btn-primary'   href='editar_projecto.php?id=" .$user_data['ID']."' >Editar</a></td>";
                  echo "<td><a class='btn btn-danger'   href='eliminar_projecto.php?id=" .$user_data['ID']."' >Eliminar</a></td>";
                  echo "</tr>";

                }
                
                ?>

            </tbody>
        </table>

     </div>
    </div>
    </div>
        
        
    </body>
</html>