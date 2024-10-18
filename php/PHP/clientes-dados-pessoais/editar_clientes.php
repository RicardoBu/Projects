


<?php
session_start();
include_once('../config.php');

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $profissao = $_POST['profissao'];
    $id = $_POST['id'] ?? null;

    // Verifica se o ID foi fornecido
    if ($id) {
        // Prepara a query de atualização
        $sql = "UPDATE clientes 
                SET `Nome` = ?, 
                    `Apelido` = ?, 
                    `Profissao` = ? 
                WHERE `ID` = ?";

        // Prepara a consulta SQL
        $stmt = $conexao->prepare($sql);

        if ($stmt === false) {
            die("Erro na preparação do statement: " . $conexao->error);
        }

        // Associa os parâmetros à consulta
        $stmt->bind_param("sssi", $nome, $apelido, $profissao, $id);

        // Executa a consulta
        if ($stmt->execute()) {
            echo "Alteração feita com sucesso!";
        } else {
            echo "Erro ao fazer a alteração: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "ID não fornecido.";
    }
} else if (isset($_GET['id'])) {
    // Verifica se o ID foi passado pela URL
    $id = $_GET['id'];

    // Prepara a query para buscar os dados do cliente
    $sql = "SELECT Nome, Apelido, Profissao FROM clientes WHERE ID = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $apelido, $profissao);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "ID do cliente não fornecido!";
    exit;
}
?>

<html>
<head>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <title>Editar dados pessoais</title>
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
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="clientes.php">Ver clientes</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>

   <div class="container mt-5">
      <div class="row">
         <div class="col text-center">
            <div class="row justify-content-center">
               <div class="col-md-6">
                  <h1 class="text-center">Editar dados pessoais</h1>

                  <form class="border border-primary p-4 rounded" action="" method="POST">
                     <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                     
                     <div class="mb-3 row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" name="nome" id="nome" value="<?php echo htmlspecialchars($nome ?? ''); ?>" required>
                        </div>
                     </div>

                     <div class="mb-3 row">
                        <label for="apelido" class="col-sm-2 col-form-label">Apelido:</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" name="apelido" id="apelido" value="<?php echo htmlspecialchars($apelido ?? ''); ?>" required>
                        </div>
                     </div>

                     <div class="mb-3 row">
                        <label for="profissao" class="col-sm-2 col-form-label">Profissão:</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" name="profissao" id="profissao" value="<?php echo htmlspecialchars($profissao ?? ''); ?>" required>
                        </div>
                     </div>

                     <button type="submit" class="btn btn-primary">Atualizar</button>
                  </form>

               </div>
            </div>
         </div>
      </div>
   </div>
</body>
</html>
