<?php 
//session_start();

include_once('config.php');

//$logado = null;
//$is_admin = false;
//$result = null;

if (!isset($_SESSION['email'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: login.php");
    exit;
}

$logado = $_SESSION['email'];
$is_admin = $_SESSION['is_admin']; // Pega diretamente da sessão

//if (isset($_SESSION['email']) && isset($_SESSION['senha'])) {
 //   $logado = $_SESSION['email'];

    // Usando Prepared Statements para evitar SQL Injection
    $sql_user = $conexao->prepare("SELECT * FROM utilizadores WHERE Email = ? ");
    $sql_user->bind_param("s", $logado); // Assumindo que a senha ainda não foi tratada corretamente (recomendo hashing)
    $sql_user->execute();
    $result_user = $sql_user->get_result();

    if ($result_user && $result_user->num_rows > 0) {
        $user_data = $result_user->fetch_assoc();

        $_SESSION['user_id'] = $user_data['ID']; 
        $user_id = $user_data['ID'];

        if ($user_data['Admin'] === 'sim') {
            $is_admin = true;
        } elseif ($user_data['Admin'] === 'topadmin') {
            $_SESSION['is_admin'] = 'topadmin';
        } else {
            $_SESSION['is_admin'] = false;
        }

        
    } else {
        // Redireciona para a página de login se o usuário não for encontrado
        session_destroy();
        header("Location: login.php");
        exit;
    }
//}
?>