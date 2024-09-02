<!-- config.php -->
<?php
$hostname = "localhost"; // ou 127.0.0.1
$username = "root"; // ou outro usuário configurado
$password = ""; // senha do MySQL, geralmente vazia no WAMP
$database = "projetopratofeito";

// Conexão com o banco de dados
$conn = new mysqli($hostname, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
