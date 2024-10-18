
<?php 

session_start();
include_once('../config.php');

if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}

$logado = $_SESSION['email'];

$sql = "SELECT * FROM marcacoes";
$result = $conexao->query($sql);

function podeModificar($dataMarcacao, $horaMarcacao) {
  // Obtém a data e hora atuais
  $agora = new DateTime();
  
  // Combina a data e hora da marcação em um único objeto DateTime
  $dataMarcacaoCompleta = new DateTime($dataMarcacao . ' ' . $horaMarcacao);
  
  // Calcula a diferença entre a data/hora atual e a data/hora da marcação
  $intervalo = $agora->diff($dataMarcacaoCompleta);

  // Verifica se a consulta já passou
  if ($agora > $dataMarcacaoCompleta) {
      return false; // Não pode modificar uma consulta que já passou
  }

  // Verifica se faltam pelo menos 72 horas para a consulta
  $horasRestantes = ($intervalo->days * 24) + $intervalo->h;
  return ($horasRestantes >= 72);
}

?>

<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Consultas Marcadas</title>
       
    </head>
    <body class="bg-info">
  <nav class="navbar navbar-expand-lg  navbar-light bg-light ">
  <div class="container-fluid">
    <a class="navbar-brand" href="../homepage.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="marcar_consulta.php">Marcar consultas</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

 <div class="container mt-5">
 <div class="row">
 <div class="col text-center">
   <?php echo "<h1>Utilizador logado: $logado</h1>" ?>
   <table class="table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Descricao</th>
                    <th>Modificação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($result->num_rows >0){
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" .$row['Data da consulta'] . "</td>";
                        echo "<td>" .$row['Hora'] . "</td>";
                        echo "<td>" .$row['Descricao'] . "</td>";
                        echo "<td>";
                        if( podeModificar($row['Data da consulta'], $row['Hora'])) {
                            
                            echo "<a class='btn btn-primary me-2' href='editar_consulta.php?id=". $row['ID']."'>Modificar</a>";
                            echo "<a class='btn btn-danger' href='eliminar_consulta.php?id=". $row['ID']."'>Apagar</a>";
                        } else {
                            echo "Não pode ser modificado";
                        }
                        echo "</td>";
                        echo "</tr>";

                    } 

                } else {
                    echo "<tr><td colspan='4'>Nenhuma consulta  encontrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
 </div>
 </div>
 </div>
</body>
</html>
