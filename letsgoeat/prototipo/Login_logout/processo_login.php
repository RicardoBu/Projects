
<?php
session_start();
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Preparar e executar a consulta
    $sql = "SELECT * FROM utilizadores WHERE Email = ?";
    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die('Erro na preparação do statement: ' . $conexao->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
       // $hash_no_banco = $user_data['Senha'];

        

        // Verificar a senha usando password_verify
        if (password_verify($senha, $user_data['senha'])) {
            echo 'A senha está correta!<br>';

            // Definir o ID do utilizador na sessão
            $_SESSION['user_id'] = $user_data['utilizadorID'];
            $_SESSION['email'] = $user_data['email'];

            // Redirecionar com base no nível de admin
            if ($user_data['comp_admin'] == '1') {
                $_SESSION['is_admin'] = '1';
                header('Location: ../area_admin/admin.php');
            } elseif ($user_data['comp_admin'] == '0') {
                $_SESSION['is_admin'] = '0';
                header('Location: ../utilizador/utilizador.php');
            }
            exit();
        } else {
            // Caso a senha esteja errada
            echo 'Senha incorreta!<br>';
            header('Location: login.php?erro=1');
            exit();
        }
    } else {
        // Usuário não encontrado
        echo 'Usuário não encontrado!<br>';
        header('Location: login.php?erro=1');
        exit();
    }
}
