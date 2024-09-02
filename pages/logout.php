<?php
session_start();

// Destrói todas as variáveis de sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona para a página home.php
header("Location: home.php");
exit();
?>