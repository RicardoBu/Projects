

<?php 
session_start();
include_once('../Login_logout/config.php');

// Verifica se um ID foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o produto com o ID passado
    $sql = "SELECT * FROM produtos WHERE produtoID = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();
    
    // Verifica se o produto existe
    if (!$produto) {
        echo "Produto não encontrado.";
        exit;
    }
} else {
    echo "Erro: ID não fornecido.";
    exit;
}

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura o novo preço do formulário
    $novoPreco = trim($_POST['preco']);

    // Valida o novo preço
    if (is_numeric($novoPreco) && $novoPreco > 0) {
        // Atualiza o preço do produto
        $sql = "UPDATE produtos SET preco = ? WHERE produtoID = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('di', $novoPreco, $id);

        // Verifica se a atualização foi bem-sucedida
        if ($stmt->execute()) {
            $_SESSION['mensagem'] = "Preço atualizado com sucesso!";
            header("Location: produtos_admin.php");
            exit();
        } else {
            echo "Erro ao atualizar o preço: " . $stmt->error;
        }
    } else {
        echo "Por favor, insira um preço válido.";
    }
}
?>

<html>
   <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Editar Preço</title>
   </head>
   <body class="bg-light">

   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="../index_produtos_registo/index.php">Home</a>
      </div>
   </nav>

   <div class="container mt-5">
       <div class="row">
           <div class="col text-center">
               <h1>Editar Preço</h1>

               <form action="" method="POST" class="border border-primary p-4 rounded">
                   <div class="mb-3 row">
                       <label for="preco" class="col-sm-4 col-form-label">Novo Preço:</label>
                       <div class="col-sm-8">
                           <input type="number" step="0.01" class="form-control" name="preco" id="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>" required>
                       </div>
                   </div>
                   <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"> 
                   <button type="submit" class="btn btn-primary">Guardar</button>
                   <a href="produtos_admin.php" class="btn btn-secondary">Cancelar</a>
               </form>
           </div>
       </div>
   </div>

   </body>
</html>
