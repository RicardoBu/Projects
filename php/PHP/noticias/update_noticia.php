<?php
include_once('../config.php');

$id = $_POST['id'];
$conteudo = $_POST['conteudo'];
$titulo = $_POST['titulo'];

$stmt = mysqli_prepare($conexao, "UPDATE noticias SET Titulo = ?,  Conteudo = ? WHERE ID = ?");
mysqli_stmt_bind_param($stmt, "ssi", $titulo, $conteudo, $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);


$stmt = mysqli_prepare($conexao, "SELECT Titulo, Conteudo FROM noticias WHERE ID = ?");
mysqli_stmt_bind_param($stmt, "i",  $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $titulo, $conteudo);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);


// Redirect back to editar_noticia.php or another page


header('Location: editar_noticia.php?id=' .$id . '&updated=true');

exit;
?>