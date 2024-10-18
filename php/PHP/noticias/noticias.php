<?php 
session_start();

include_once('../config.php');

$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];

function fetch_and_insert_rss_news($conexao) {
    $context = stream_context_create([
        'http' => [
            'header' => 'User-Agent: PHP'
        ]
    ]); 
    $rss_url = 'https://www.techrepublic.com/rssfeeds/articles/';
    $rss_data = file_get_contents($rss_url, false, $context);

    if ($rss_data) {
        $rss = simplexml_load_string($rss_data);
        foreach ($rss->channel->item as $item) {
            $titulo = mysqli_real_escape_string($conexao, $item->title);
            $conteudo = mysqli_real_escape_string($conexao, $item->description);
            $link = mysqli_real_escape_string($conexao, $item->link);

            // Check if the news article already exists
            $check_sql = "SELECT ID FROM noticias WHERE Titulo = '$titulo'";
            $check_result = mysqli_query($conexao, $check_sql);

            if ($check_result && $check_result->num_rows == 0) {
                // Insert only if the news does not exist
                $sql = "INSERT INTO noticias (Titulo, Conteudo) VALUES ('$titulo', '$conteudo')";
                if (!mysqli_query($conexao, $sql)) {
                    echo "Error inserting news: " . mysqli_error($conexao);
                }
            }  
        }

    } else {
        echo "Error parsing RSS feed";
    }
}

function fetch_news($conexao, $id = null) {
    $query = "SELECT ID, Titulo, Conteudo FROM noticias";
    if ($id !== null) {
        $id = intval($id);
        $query .= " WHERE ID = $id";
    } else {
        $query .= " ORDER BY ID DESC LIMIT 5";
    }

    return mysqli_query($conexao, $query);
}

function display_news($news_article) {
    echo "<div class='card mb-3'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . htmlspecialchars($news_article['Titulo']) . "</h5>";
    echo "<p class='card-text'>" . htmlspecialchars($news_article['Conteudo']) . "</p>";
    echo "<a href='editar_noticia.php?id=" . htmlspecialchars($news_article['ID']) . "' class='btn btn-primary me-2'>Edit</a>";
    echo "<a href='eliminar_noticia.php?id=" . htmlspecialchars($news_article['ID']) . "' class='btn btn-danger'>Delete</a>";
    echo "</div>";
    echo "</div>";
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        
        
      </ul>
      
    </div>
    
      
   
  </div>
</nav>
    <div class="container mt-5">
        <?php 
        if ($is_admin && isset($_GET['update_news'])) { // Ex: adicionar ?update_news=1 para acionar
            fetch_and_insert_rss_news($conexao);
        } else {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $result = fetch_news($conexao, $id);
            if ($result && $result->num_rows > 0) {
                while ($news_article = $result->fetch_assoc()) {
                    display_news($news_article);
                }
                echo '<br><a href="homepage.php" class="btn btn-secondary">Voltar ao Início</a>';
            } else {
                echo "<p class='alert alert-warning'>No news articles found.</p>";
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMzcd4rdIbLLJzB5qZsej5FLAlAq8muvr7rbtf80bY3H+HfK5LRr8vV3RoJ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-QD23nK3LQI8NUPB4faNg61vJDoP5w28n5Z4lgV3MgplbZamZFLp1H4wjfQmR5x0Q" crossorigin="anonymous"></script>
</body>
</html>
