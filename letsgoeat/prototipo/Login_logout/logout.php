<?php
session_start();
session_unset();
session_destroy();
header('Location: ../index_produtos_registo/index.php');
exit();
?>