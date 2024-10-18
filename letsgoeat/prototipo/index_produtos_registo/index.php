<?php

session_start();
    // Exibir a mensagem de sucesso se estiver definida
    if (isset($_SESSION['mensagem_sucesso'])) {
        echo "<div class='alert alert-success'>{$_SESSION['mensagem_sucesso']}</div>";
        // Limpar a mensagem após exibição
        unset($_SESSION['mensagem_sucesso']);
    }
    ?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Let's go eat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
   <link rel="stylesheet" href="../css/index.css">

    <!-- Lightbox2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />

<!-- Lightbox2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>


</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="../imagens/download.jpeg" alt="Logotipo" width="70" height="70" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="produtos.php"><i class="fas fa-box"></i> Produtos</a>
                </li>
                
                <li class="nav-item">
                   <a class="nav-link" href="#sobrenos"><i class="fas fa-info-circle"></i> Sobre Nós</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../Login_logout/login.php"><i class="fas fa-user"></i> Login</a>
                </li>
            </ul>
        </div>
    </nav>
    
   
            <!-- Coluna da Imagem -->

            <div class="container mt-5">
    <h2 class="text-center">Let's go eat!</h2>
    <div class="row">
        <div class="col-md-3 image-container">
            <a href="../imagens/bife.jpg" data-lightbox="meal" data-title="">
                <img src="../imagens/bife.jpg" alt="Imagem de refeição" class="img-fluid rounded-circle">
            </a>
            <p class="lightbox-description">Bife: Um prato delicioso de carne grelhada, servido com acompanhamentos.</p>
        </div>
        <div class="col-md-3 image-container">
            <a href="../imagens/frango.jpg" data-lightbox="meal" data-title="">
                <img src="../imagens/frango.jpg" alt="Imagem de frango" class="img-fluid rounded-circle">
            </a>
            <p class="lightbox-description">Frango: Frango assado suculento com temperos especiais.</p>
        </div>
        <div class="col-md-3 image-container">
            <a href="../imagens/salmao.jpeg" data-lightbox="meal" data-title="">
                <img src="../imagens/salmao.jpeg" alt="Imagem de salmão" class="img-fluid rounded-circle">
            </a>
            <p class="lightbox-description">Salmão: Salmão fresco grelhado com molho de limão.</p>
        </div>
        <div class="col-md-3 image-container">
            <a href="../imagens/dourada.jpg" data-lightbox="meal" data-title="">
                <img src="../imagens/dourada.jpg" alt="Imagem de dourada" class="img-fluid rounded-circle">
            </a>
            <p class="lightbox-description">Dourada: Peixe grelhado  com ervas frescas.</p>
        </div>
    </div>
</div>


            </div>
        </div>
        <!-- Botão Centralizado -->
        <div class="row text-center mt-4">
            <div class="col-md-12">
            <?php if (isset($_SESSION['email'])): ?>
        <a href="../pedidos/area_de_pedidos.php" class="btn btn-primary">Faça o seu pedido</a>
    <?php else: ?>
        <a href="../Login_logout/login.php" class="btn btn-primary">Faça o login para pedir</a>
    <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Mapa -->
    <div class="container mt-5">
     <div class="col-md-12">
     <h2 class="text-center">Let's eat Portugal!</h2>
        <div id="map"></div>
        </div>
     </div>
      
    </div>
    

    <!-- Sobre nós -->

    <div class="container mt-5" id="sobrenos">
        <h2 class="text-center">Sobre a Let's Go Eat</h2>
        <div class="row">
            <p>A Let's Go Eat nasceu com uma missão clara: levar refeições deliciosas e prontas a comer às principais cidades de Portugal. Focada em quem valoriza o seu tempo, mas não quer abrir mão de uma refeição saborosa e nutritiva, a Let's Go Eat oferece uma vasta seleção de pratos de carne e peixe, pensados para agradar a todos os gostos.</p>

                <p>Seja para quem tem uma rotina agitada e não encontra tempo para cozinhar, ou para quem simplesmente prefere a conveniência de ter um prato pronto sem abdicar da qualidade, a Let's Go Eat é a solução ideal. As nossas refeições take away são preparadas com ingredientes frescos e seguem as melhores tradições da cozinha portuguesa.</p>
                
                <p>A nossa promessa? Conquistar o estômago de todos os portugueses, uma refeição de cada vez. Com sabores irresistíveis e um serviço prático e rápido, a Let's Go Eat está aqui para transformar a forma como você se alimenta no dia a dia. Afinal, comer bem nunca foi tão fácil!</p>

        </div>
    </div>

    <!-- Seção de Contactos -->
    <div class="container mt-5">
        <div class="row text-center">
            <h2>Contactos</h2>
        </div>
        <div class="row text-center mt-4">
            <div class="col-md-4">
                <img src="https://cdn-icons-png.flaticon.com/512/732/732200.png" alt="Email Icon" width="80" class="mb-3">
                <h5>Email</h5>
                <p>letsgoeat@email.com</p>
            </div>
            <div class="col-md-4">
                <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Phone Icon" width="80" class="mb-3">
                <h5>Telefone</h5>
                <p>+351 123 456 789</p>
            </div>
            <div class="col-md-4">
                <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Location Icon" width="80" class="mb-3">
                <h5>Localização</h5>
                <p>Rua Lets Go Eat, 123, Porto</p>
            </div>
        </div>
    </div>

    <!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <img class="lightbox-image" id="lightboxImage" src="" alt="Imagem ampliada">
    <p class="lightbox-description" id="lightboxDescription"></p>
    <button class="close-button" id="closeButton">X</button>
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="../js/mapa.js"></script>
    <script src="../js/lightbox.js"></script>
    <script src="../js/scrollIntoView.js"></script>
</body>
</html>
