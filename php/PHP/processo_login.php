<?php

session_start();
include_once('config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email =  trim($_POST['email']);
    $senha =  trim($_POST['senha']);
    

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

        if (password_verify($senha, $user_data['Senha'])) {
            // Definir o ID do utilizador na sessão
            $_SESSION['user_id'] = $user_data['ID'];
            $_SESSION['email'] = $user_data['Email'];
            
            // Redirecionar com base no nível de admin
            if ($user_data['Admin'] == 'topadmin') {
                $_SESSION['is_admin'] = 'topadmin';
                header('Location: admin-topadmin/topadmin.php');
            } elseif ($user_data['Admin'] == 'sim') {
                $_SESSION['is_admin'] = true;
                header('Location: admin-topadmin/admin.php');
            } else {
                $_SESSION['is_admin'] = false;
                header('Location: homepage.php');// ver o erro que ha aqui
            }
            exit(); // Garantir que o script não continua após o redirecionamento

        } else {
            // Senha incorreta
            header('Location: login.php?erro=1');
            exit();
        }
    } else {
        // Usuário não encontrado
        header('Location: login.php?erro=1');
        exit();
    }
} else {
    // Acesso não permitido
    header('Location: login.php?erro=1');
    exit();
}



?>