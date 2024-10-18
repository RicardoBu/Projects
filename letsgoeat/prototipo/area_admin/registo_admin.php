<?php
session_start();
include_once('../Login_logout/config.php');

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confirm_senha = $_POST['confirm_senha'];
    $admin = $_POST['admin'] === 'sim' ? 1 : 0;

    // Validações de dados
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<div class="alert alert-danger" role="alert">Email inválido.</div>';
    } elseif (strlen($senha) < 5) {
        $message = '<div class="alert alert-danger" role="alert">A senha deve ter pelo menos 5 caracteres.</div>';
    } elseif ($senha !== $confirm_senha) {
        $message = '<div class="alert alert-danger" role="alert">As senhas não coincidem.</div>';
    } else {
        // Verificar duplicidade de email
        $sql_check = "SELECT Email FROM utilizadores WHERE Email = ?";
        $stmt_check = $conexao->prepare($sql_check);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $message = '<div class="alert alert-danger" role="alert">Este e-mail já está registado.</div>';
        } else {
            // Criptografar senha
            $senha_encriptada = password_hash($senha, PASSWORD_DEFAULT);

            // Inserir novo usuário
            $sql = "INSERT INTO utilizadores (Email, Senha, comp_admin) VALUES (?, ?, ?)";
            $stmt = $conexao->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ssi", $email, $senha_encriptada, $admin);

                if ($stmt->execute()) {
                    $message = '<div class="alert alert-success" role="alert">Registo feito com sucesso!</div>';
                } else {
                    $message = '<div class="alert alert-danger" role="alert">Erro ao fazer o registo: ' . $stmt->error . '</div>';
                }
                $stmt->close();
            } else {
                $message = '<div class="alert alert-danger" role="alert">Erro ao preparar a consulta: ' . $conexao->error . '</div>';
            }
        }

        $stmt_check->close();
    }
    $conexao->close();
}
?>

<html>
<head>
    <title>Registo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <style>
        body {
    background-color: #f8f0e3
}

    </style>

</head>
<body >
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index_produtos_registo/index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="../Login_logout/login.php">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Exibe mensagens -->
            <?php if ($message): ?>
                <div><?php echo $message; ?></div>
            <?php endif; ?>
            
            <!-- Formulário de registro -->
            <div class="card shadow-lg p-4">
                <h3 class="text-center mb-4">Registo de Utilizador</h3>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="admin" class="form-label">Tipo de Utilizador:</label>
                        <select class="form-select" name="admin" id="admin">
                            <option value="nao">Utilizador</option>
                            <option value="sim">Administrador</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" class="form-control" name="senha" id="senha" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_senha" class="form-label">Confirmar Senha:</label>
                        <input type="password" class="form-control" name="confirm_senha" id="confirm_senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submeter</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>