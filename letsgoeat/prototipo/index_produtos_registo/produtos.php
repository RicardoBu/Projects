<?php 
session_start();
include_once('../Login_logout/config.php');

//if (!isset($_SESSION['email'])) {
    // Redirecionar o utilizador para a página de login, se não estiver logado
 //   header("Location: login.php");
  //  exit();
 // }
  
 // $emailUtilizador = $_SESSION['email'];
$query= "SELECT * FROM produtos";
$result = mysqli_query($conexao, $query);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="projecto final" content="description">
        <meta name="author" content="ricardo">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="index.css">
        <style>
        body {
    background-color: #f8f0e3
}

    </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../index_produtos_registo/index.php"><strong>Home</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
        
        <div class="container mt-5">
            <div class="row">
                <div class="col text-center">
                    <h1>Lista de Pratos</h1>
                    <table class="table table-bordered" style="background-color: white;">
                        <thead>
                            <tr>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Prato</th>
                                <th scope="col">Tipo de comida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            while( $user_data = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" .htmlspecialchars($user_data['quantidade'])   . "</td>";
                                echo "<td>" .htmlspecialchars($user_data['preco']) .  " EUR" . "</td>";
                                echo "<td>" .htmlspecialchars($user_data['nome_produto'])  . "</td>";
                                echo "<td>" .htmlspecialchars($user_data['tipo_comida'])  . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <a href="../pedidos/area_de_pedidos.php" class="btn btn-primary">Faça já o seu pedido</a>
                </div>
            </div>
        </div>
        
    </body>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
