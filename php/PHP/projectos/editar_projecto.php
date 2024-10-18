<?php 
session_start();
include_once('../config.php');

$id = $_GET['id'];

$sql = "SELECT * FROM projectos WHERE ID = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   // Captura e sanitiza os dados do formulário
   $id = isset($_POST['id']) ? trim($_POST['id']) : null;
   $email = trim($_POST['email']);
   $dados = trim($_POST['dados']);
   $tecnologia = trim($_POST['tecnologia']);
   $tempo = trim($_POST['tempo']);

   if (empty($id)) {
    echo "Erro: ID não fornecido.";
    exit;
}

   // Valida os campos obrigatórios
   if (empty($email) || empty($dados) || empty($tecnologia) || empty($tempo)) {
       echo "Todos os campos são obrigatórios.";
   } else {
       // Usa consulta preparada para evitar SQL Injection
       $sql = "UPDATE projectos 
               SET  `Email` = ?,
                   `Dados do Projecto` = ?, 
                   `Tecnologia Usada` = ?, 
                   `Tempo de Conclusao` = ? 
               WHERE `ID` = ?";
       
       $stmt = $conexao->prepare($sql);
       $stmt->bind_param('ssssi',$email, $dados, $tecnologia, $tempo, $id);

       // Executa a consulta e verifica o resultado
       if ($stmt->execute()) {
           if ($stmt->affected_rows > 0) {
               echo "Alteração feita com sucesso!";
           } else {
               echo "Nenhuma alteração foi feita ou ID não encontrado.";
           }
       } else {
           echo "Erro ao fazer a alteração: " . $stmt->error;
       }

       // Fecha a declaração
       $stmt->close();
   }
}
   

?>

<html>
   <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <title>Editar Projectos</title>
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
          <a class="nav-link active" aria-current="page" href="lista_projectos.php">Ver projectos</a>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../admin-topadmin/admin.php">Voltar atras</a>
        </li>
        </li>
      </ul>
      
    </div>
    
      
   
  </div>
</nav>

<div class="container mt-5">
   <div class="row">
   <div class="col text-center">
   <div class="row justify-content-center">
    <h1>Editar Projecto</h1>
    
   <form class="border border-primary p-4 rounded" action="" method="POST">
                <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Email do utilizador:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Dados do Projecto:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="dados" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Tecnologia Usada:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tecnologia" id="hora" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Tempo de Conclusao:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tempo" id="hora" required>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"> 
                    <button type="submit" class="btn btn-primary">Submeter</button>
                </form>
   </div>
   </div>
   </div>
   </div>
   
   </body>



</html>