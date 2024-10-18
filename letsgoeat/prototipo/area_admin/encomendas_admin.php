


<?php 

session_start();
include_once('../Login_logout/config.php');
$query = "SELECT * FROM encomendas";
$result = mysqli_query($conexao, $query);

?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Encomendas</title>
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
                <a class="navbar-brand" href="../area_admin/admin.php"><strong>Home</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
            </div>
        </nav>

        <div class="container mt-5">
            <div class="row">
                <div class="col text-center">
                    <h1>Lista de Encomendas</h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                               
                                <th scope="col">Prato</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Apelido</th>
                                <th scope="col">Morada de envio</th>
                                <th scope="col">Email de utilizador</th>
                                <th scope="col">Editar/Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            
    <?php 
    while ($user_data = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($user_data['nome_produto']) . "</td>";
        echo "<td>" . htmlspecialchars($user_data['preco_total_encomenda']) . "</td>";
        echo "<td>" . htmlspecialchars($user_data['nome']) . "</td>";
        echo "<td>" . htmlspecialchars($user_data['apelido']) . "</td>";
        echo "<td>" . htmlspecialchars($user_data['morada_envio']) . "</td>";
        echo "<td>" . htmlspecialchars($user_data['email']) . "</td>";
        echo "<td>
                <div class='d-flex'>
                    <a class='btn btn-primary me-2' href='editar_encomenda.php?id=" . htmlspecialchars($user_data['encomendaID']) . "'>Editar</a>
                    <a class='btn btn-danger' href='eliminar_encomenda.php?id=" . htmlspecialchars($user_data['encomendaID']) . "'>Eliminar</a>
                </div>
              </td>";
        echo "</tr>";
    }
    ?>
</tbody>

                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
