<?php 

session_start();

include_once('config.php');

if(isset($_GET['id'])) {
  $id = $_GET['id'];
} else if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
} else {
    echo "ID do utilizador não especificado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $data_nascimento = $_POST['data_nascimento'];
    $morada = $_POST['morada'];
    $preco = $_POST['preco'];
    $email = $_POST['email'];
    $nome_produto = $_POST['nome_produto'];



 $stmt = mysqli_prepare($conexao, "UPDATE  encomendas SET nome =?, apelido = ?, data_nascimento= ?, morada_envio =?, preco_total_encomenda =?, email=?, nome_produto=?  WHERE encomendaID = ? ");
    mysqli_stmt_bind_param($stmt, "ssssissi", $nome,$apelido,$data_nascimento, $morada, $preco, $email,$nome_produto, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Encomenda atualizada com sucesso! <br>"; 
        echo '<a href="homepage.php">Voltar à homepage</a>';
    } else {
        echo "Erro ao atualizar encomenda ou nenhuma alteração realizada.";
    }
    mysqli_stmt_close($stmt);
    exit;

} 
    // Verifica se o ID foi passado para editar o usuário existente
    

        $stmt = mysqli_prepare($conexao, "SELECT nome, apelido, data_nascimento, morada_envio,preco_total_encomenda, email, nome_produto  FROM encomendas WHERE encomendaID = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        
        if (mysqli_stmt_errno($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        } 

        mysqli_stmt_bind_result($stmt, $nome,$apelido,$data_nascimento, $morada, $preco, $email ,$nome_produto);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

   

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Editar Utilizador</title>
</head>
<body class="bg-info">
<nav class="navbar navbar-expand-lg  navbar-light bg-light ">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin.php">Voltar atras</a>
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
                <h1 class="text-center">Editar encomenda</h1>
                <form class="border border-primary p-4 rounded" action="" method="post">
                
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id);?>" >

                <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nome" id="data" name="nome" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="data" class="col-sm-2 col-form-label">Apelido</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="apelido" id="data" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Data de Nascimento</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="data_nascimento" id="hora" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Morada de envio</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="morada" id="hora" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Preço total da encomenda</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="preco" id="hora" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="hora" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hora" class="col-sm-2 col-form-label">Nome dos produtos</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nome_produto" id="hora" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            <table class="table mt-4 border table-bordered">
           <thead>
                <tr>
                    <th>Nome</th>
                    <th>Apelido </th>
                    <th>Data de Nascimento </th>
                    <th>Morada de envio </th>
                    <th>Preço total da encomenda</th>
                    <th>Email</th>
                    <th>Pratos</th>

                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($nome);  ?></td>
                    <td><?php echo htmlspecialchars($apelido);  ?></td>
                    <td><?php echo htmlspecialchars($data_nascimento);  ?></td>
                    <td><?php echo htmlspecialchars($morada);  ?></td>
                    <td><?php echo htmlspecialchars($preco);  ?> EUR</td>
                    <td><?php echo htmlspecialchars($email);  ?></td>
                    <td><?php echo htmlspecialchars($nome_produto);  ?></td>
                    
                </tr>
                
            </tbody>
 </table>

</div>
</div>
</div>
</div>


 
</body>
</html>