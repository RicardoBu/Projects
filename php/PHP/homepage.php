<?php 
session_start();
include_once('logica.php');

$logado = isset($_SESSION['email']) ? $_SESSION['email'] : false;
$is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;

?>

<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="../js/noticias.js"></script>
</head>
<body class="bg-info">

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            

            <?php if ($logado): ?>
                <h1>Perfil de Utilizador</h1>
                <h2>Utilizador:<strong><?php echo htmlspecialchars($logado); ?></strong></h2>
                
                <ul class="list-group">
                    <li class="list-group-item"><a class="text-decoration-none" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    <li class="list-group-item"><a class="text-decoration-none" href="consultas/consultas_marcadas.php"> <i class="bi bi-calendar-check"></i> Consultas marcadas </a></li>
                    <li class="list-group-item"><a class="text-decoration-none" href="consultas/marcar_consulta.php"> <i class="bi bi-calendar-plus"></i> Marcar Consultas</a></li>
                    <li class="list-group-item"><a class="text-decoration-none" href="clientes-dados-pessoais/upload_dados_pessoais.php">  <i class="bi bi-person-plus"></i> Adicionar dados pessoais</a></li>
                    <li class="list-group-item"><a class="text-decoration-none" href="clientes-dados-pessoais/clientes.php"> <i class="bi bi-person-lines-fill"></i> Alterar dados pessoais</a></li>
                    <li class="list-group-item"><a class="text-decoration-none" href="../html/indice.html">  <i class="bi bi-house"></i>Pagina inicial</a></li>
                </ul>

                

                <?php if ($is_admin): ?>
                    <h2>Area Administrativa</h2>
                    <ul class="list-group">
                        <li class="list-group-item"><a class="text-decoration-none" href="admin-topadmin/admin.php"> <i class="bi bi-tools"></i> Expandir Area Administrativa</a></li>
                        <li class="list-group-item"><a class="text-decoration-none" href="noticias/noticias.php" id="noticias-link"> <i class="bi bi-newspaper"></i> Noticias Tecnologia</a></li>
                    </ul>
                <?php endif; ?>

                <?php if ($is_admin === 'topadmin'): ?>
                    <h2>Area Top Admin</h2>
                    <ul class="list-group">
                        <li class="list-group-item"><a class="text-decoration-none" href="admin-topadmin/topadmin.php">  <i class="bi bi-person-badge"></i> Top Admin</a></li>
                        <li class="list-group-item"><a class="text-decoration-none" href="noticias/noticias.php" id="noticias-link"> <i class="bi bi-newspaper"></i> Noticias Tecnologia</a></li>
                    </ul>
                <?php endif; ?>
                
            <?php else: ?>
                <h1>Bem-vindo visitante</h1>
            <?php endif; ?>

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

</body>
</html>



