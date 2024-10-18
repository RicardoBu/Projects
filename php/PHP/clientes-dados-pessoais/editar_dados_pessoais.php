<?php 
include_once('../config.php');
session_start(); // Inicia a sessão

// Ativa a exibição de erros para ajudar na depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    echo "ID da sessão não está definido.";
    exit;
}

// Obtém todos os registros da tabela clientes
$sql = "SELECT * FROM clientes";
$result = $conexao->query($sql);

if ($result === false) {
    die("Erro ao buscar dados: " . $conexao->error);
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<title>Editar Dados Pessoais</title>
</head>
<body class="bg-info">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="../homepage.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> <!-- Feche o botão corretamente aqui -->
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="upload_dados_pessoais.php">Adicionar</a>
        </li> <!-- Fechamento correto do <li> -->
        
        
        <?php if (isset($is_admin) && $is_admin === 'topadmin'): ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="registo.php">Criar utilizadores</a>
        </li> <!-- Fechamento correto do <li> -->
        <?php endif; ?>
        
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
<div class="row">
<div class="col text-center">
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Editar dados pessoais</h1>
                
            </div>
        </div>
        <table class="table mt-4 border">
           <thead>
                <tr>
                    <th>Nome</th>
                    <th>Apelido </th>
                    <th>Profissao</th>
                    <th>Editar/Eliminar</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['Nome']); ?></td>
                    <td><?php echo htmlspecialchars($row['Apelido']); ?></td>
                    <td><?php echo htmlspecialchars($row['Profissao']); ?></td>
                    <td>
                        <a class='btn btn-primary' href="editar_id_dado_pessoal.php?id=<?php echo htmlspecialchars($row['ID']); ?>">Editar</a>
                        <a class='btn btn-danger' href="eliminar_dado_pessoal.php?id=<?php echo htmlspecialchars($row['ID']); ?>">Eliminar</a>
                    </td>
                </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum usuario encontrado</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

</div>
</div>
</div>

</body>
</html>
