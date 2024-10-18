<?php
include_once('../config.php');

// Check connection
if (!$conexao) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the noticia ID from the request
$id = $_GET['id'];

// Query to retrieve the noticia
$query = "DELETE  FROM noticias WHERE id = '$id'";
$result = mysqli_query($conexao, $query);

if($result) {
    echo "Noticia apagada com sucesso! <br>";
    echo '<a href="noticias.php">Voltar às noticias</a>';
} else {
    die("Query failed: " . mysqli_error($conexao));
}


// Close the database connection
mysqli_close($conexao);



?>