<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}


?>

<html>
    <head>
        <title>Login.php</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="../css/index.css">
        <style>
        body {
    background-color: #f8f0e3
}

    </style>
    </head>
    <body >
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="../index_produtos_registo/index.php"><strong>Home</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
      </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <div class="card-body text-center">
                        <h1 class="card-title mb-4">Página de Login</h1>
                        <h2 class="card-subtitle mb-3">Insira os seus dados de acesso</h2>
                        
                        <!-- Mensagem de erro, se existir -->
                        <?php if (isset($_GET['erro']) && $_GET['erro'] == 1): ?>
                            <div class="alert alert-danger" role="alert">
                                Email ou senha incorrectos. Tente novamente.
                            </div>
                        <?php endif; ?>

                        <form action="processo_login.php" method="post">
                            <div class="mb-3 text-start">
                                <label for="inputEmail3" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail3" name="email" required>
                            </div>
                            <div class="mb-4 text-start">
                                <label for="inputPassword3" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="inputPassword3" name="senha" required>
                            </div>
                            <button type="submit"  class="btn btn-primary w-100">Submeter</button>
                        </form>
                        <h2>Não tem conta?</h2>
                        <p><a href="../index_produtos_registo/registo.php" class="btn btn-primary">Registe-se aqui</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
</body>
</html>
