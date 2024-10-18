<?php
include_once('../config.php');

if (isset($_POST['id']) && isset($_POST['content'])) {
  $id = intval($_POST['id']);
  $content = $_POST['content'];
  $query = "UPDATE noticias SET conteudo = '$content' WHERE id = $id";
  if (mysqli_query($conexao, $query)) {
    echo "Notícia atualizada com sucesso!";
  } else {
    echo "Erro ao atualizar notícia.";
  }
} else {
  echo "ID ou conteúdo inválido.";
}
?>