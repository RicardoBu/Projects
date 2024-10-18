<?php 

include_once('../config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $email = $_POST['email'];
 $senha = $_POST['senha'];
 $senha_encriptada = password_hash($senha, PASSWORD_DEFAULT);
 $admin = $_POST['admin'];
 $id = $_POST['id'];

 $stmt = mysqli_prepare($conexao, "UPDATE   utilizadores SET Email = ?, Senha =?, Admin= ? WHERE ID = ?  ");
    mysqli_stmt_bind_param($stmt, "sssi", $email,$senha_encriptada,$admin, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Utilizador atualizado com sucesso! <br>"; 
        echo '<a href="homepage.php">Voltar à homepage</a>';
    } else {
        echo "Erro ao atualizar utilizador ou nenhuma alteração realizada.";
    }
    mysqli_stmt_close($stmt);
    

} 

$sql = "SELECT ID, Email, Admin FROM utilizadores";
$result = $conexao->query($sql);
    // Verifica se o ID foi passado para editar o usuário existente
    

        $stmt = mysqli_prepare($conexao, "SELECT Email, Senha, Admin FROM utilizadores WHERE ID = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $email, $senha, $admin);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
   

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<title>Editar Utilizadores</title>
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
          <a class="nav-link active" aria-current="page" href="../registo.php">Criar utilizadores</a>
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
                <h1 class="text-center">Editar utilizadores</h1>
                <form class="border border-primary p-4 rounded" action="" method="POST">
                <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Senha:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="senha" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Admin:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="admin" id="hora" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            <table class="table mt-4 border">
           <thead>
                <tr>
                    <th>ID</th>
                    <th>Email </th>
                    <th>Admin</th>
                    <th>Editar/Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows >0): ?>
                   <?php  while( $row = $result->fetch_assoc()):?>
                <tr>
                    <td><?php echo htmlspecialchars($row['ID']);  ?></td>
                    <td><?php echo htmlspecialchars($row['Email']);  ?></td>
                    <td><?php echo htmlspecialchars($row['Admin']);  ?></td>
                    <td>
                        <a class='btn btn-primary' href="editar_utilizador.php?id=<?php echo htmlspecialchars($row['ID']); ?>">Editar</a>
                        <a class='btn btn-danger' href="eliminar_utilizador.php?id=<?php echo htmlspecialchars($row['ID']); ?>">Eliminar</a>
                    </td>
                </tr>
                <?php  endwhile;?>
            <?php  else: ?>
                <tr>
                    <td colspan="4">Nenhum usuario encontrado</td>
                </tr>
                <?php endif; ?>
            </tbody>
 </table>
</div>

</div>
</div>
</div>


</body>
</html>