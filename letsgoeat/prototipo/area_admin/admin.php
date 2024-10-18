<?php 
 session_start();
 include_once('../Login_logout/config.php');

 if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
  } else {
    // Se a variável não estiver definida, busca o ID do admin no banco de dados
    $stmt = mysqli_prepare($conexao, "SELECT ID FROM utilizadores WHERE Admin = 1");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
  }

  if (empty($id)) {
    echo "Erro: ID do utilizador não encontrado.";
    exit;
}
?>

<html>
    <head>
        <title>Área do Administrador</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="projecto final" content="description">
        <meta name="author" content="ricardo">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="index.css">
        <style>
        body {
    background-color: #f8f0e3
}

    </style>
    </head>
    <body >

    <div class="container mt-5">
        <div class="row">
            <div class="col text-center">
                <h2>Perfil de Administrador</h2>
                <p>Aqui pode gerir as funcionalidades administrativas</p>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a class="text-decoration-none" href="../area_admin/encomendas_admin.php">
                            <i class="bi bi-folder2"></i> Lista de Encomendas
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="text-decoration-none" href="../area_admin/produtos_admin.php">
                            <i class="bi bi-people-fill"></i> Lista de Pratos
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="text-decoration-none" href="../area_admin/lista_utilizadores.php">
                            <i class="bi bi-newspaper"></i> Lista de Utilizadores
                        </a>
                    </li>
                   
                    <li class="list-group-item">
                        <a class="text-decoration-none" href="../index_produtos_registo/index.php">
                            <i class="bi bi-arrow-left-circle"></i> Voltar ao Início
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="text-decoration-none" href="../Login_logout/logout.php">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
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
