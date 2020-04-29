<?php
// inicializa a sessão
session_start();
 
// elimina todas as variáveis de sessão
$_SESSION = array();
 
// Destrói a sessão.
session_destroy();
 
// Redireciona para a página login
header("location: Index.php");
exit;
?>