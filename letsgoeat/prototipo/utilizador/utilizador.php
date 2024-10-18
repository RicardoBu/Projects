<?php 
session_start();

$logado = isset($_SESSION['email']) ? $_SESSION['email'] : false;
$is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;

?>

<html>
    <head>
    <title>Homepage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="projecto final" content="description">
    <meta name="author" content="ricardo">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
    <style>
      
        /* Define a altura fixa para as imagens */
        .image-container {
            height: 200px; /* Ajuste a altura conforme necessário */
            overflow: hidden; /* Para esconder partes da imagem que ultrapassarem */
            display: flex; /* Para centralizar as imagens */
            justify-content: center; /* Para centralizar horizontalmente */
            align-items: center; /* Para centralizar verticalmente */
        }
        .image-container img {
            height: 100%; /* A imagem ocupará 100% da altura do contêiner */
            width: auto; /* Manter a proporção da imagem */
        }

        body {
    background-color: #f8f0e3
}

    
    </style>
    </head>



    <div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            

            <?php if ($logado): ?>
                <h1>Perfil de Utilizador</h1>
                <h2>Utilizador:<strong><?php echo htmlspecialchars($logado); ?></strong></h2>
                
                <ul class="list-group">
                    <li class="list-group-item"><a class="text-decoration-none" href="../Login_logout/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    <li class="list-group-item"><a class="text-decoration-none" href="../encomendas/encomendas_utilizador.php"> <i class="bi bi-calendar-check"></i> A(s) sua(s) encomenda(s) </a></li>
                    <li class="list-group-item"><a class="text-decoration-none" href="../index_produtos_registo/produtos.php"> <i class="bi bi-calendar-plus"></i> Ver os nossos pratos</a></li>
                    <li class="list-group-item"><a class="text-decoration-none" href="../index_produtos_registo/index.php">  <i class="bi bi-house"></i>Pagina inicial</a></li>
                </ul>

                <?php endif; ?>

                <div class="container mt-5">
        <h2 class="text-center">Let's go eat!</h2>
        <div class="row">
            <!-- Coluna da Imagem -->
            <div class="col-md-3 image-container">
                <img src="../imagens/bife.jpg" alt="Imagem de refeição" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-3 image-container">
                <img src="../imagens/frango.jpg" alt="" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-3 image-container">
                <img src="../imagens/salmao.jpeg" alt="" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-3 image-container">
                <img src="../imagens/dourada.jpg" alt="" class="img-fluid rounded-circle">
            </div>
        </div>
        
        <!-- Botão Centralizado -->
        <div class="row text-center mt-4">
            <div class="col-md-12">
                <a class="btn btn-primary" href="../pedidos/area_de_pedidos.php">Faça já o seu pedido!</a>
            </div>
        </div>
    </div>

                <!-- Seção de Contactos -->
    <div class="container mt-5">
        <div class="row text-center">
            <h2>Contactos</h2>
        </div>
        <div class="row text-center mt-4">
            <!-- Email -->
            <div class="col-md-4">
                <img src="https://cdn-icons-png.flaticon.com/512/732/732200.png" alt="Email Icon" width="80" class="mb-3">
                <h5>Email</h5>
                <p>info@exemplo.com</p>
            </div>
            
            <!-- Telefone -->
            <div class="col-md-4">
                <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Phone Icon" width="80" class="mb-3">
                <h5>Telefone</h5>
                <p>+351 123 456 789</p>
            </div>
            
            <!-- Localização -->
            <div class="col-md-4">
                <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Location Icon" width="80" class="mb-3">
                <h5>Localização</h5>
                <p>Rua Exemplo, 123, Lisboa</p>
            </div>
        </div>
    </div>
</html>

