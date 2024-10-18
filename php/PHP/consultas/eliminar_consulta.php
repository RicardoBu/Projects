<?php
include_once('../config.php');

// Check connection
if (!$conexao) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the noticia ID from the request
$id = $_GET['id'];

// Query to retrieve the noticia
$query = "DELETE  FROM marcacoes WHERE id = '$id'";
$result = mysqli_query($conexao, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conexao));
} else { echo "Consulta eliminado!";
      echo '<a href="todas_consultas_marcadas.php">Voltar às consultas</a>';
       } 





?>