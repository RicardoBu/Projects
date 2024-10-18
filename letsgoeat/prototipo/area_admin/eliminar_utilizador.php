<?php 

include_once('../Login_logout/config.php');

if (!$conexao) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];

$query = "DELETE  FROM utilizadores WHERE utilizadorID = '$id'";
$result = mysqli_query($conexao, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conexao));
} else { echo "Utilizador eliminado!<br>";
        echo '<a href="editar_utilizador.php">Voltar atras</a>';
      } 
?>