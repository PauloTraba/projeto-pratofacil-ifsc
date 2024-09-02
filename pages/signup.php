<?php

include('../includes/config.php'); // Arquivo com a configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $name = $_POST['name'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $confirm_password = $_POST['confirm_password'];
 $birthdate = $_POST['birthdate'];

 // Validação básica para conferir se as senhas coincidem
 if ($password !== $confirm_password) {
  $_SESSION['error'] = "As senhas não coincidem.";
 } else {
  // Hash da senha antes de armazenar no banco de dados
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Prepara e executa a inserção no banco de dados
  $stmt = $conn->prepare("INSERT INTO users (name, email, password, birthdate) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $hashed_password, $birthdate);

  if ($stmt->execute()) {
   $_SESSION['success'] = "Cadastro realizado com sucesso! Você pode entrar agora.";
   header("Location: login.php");
   exit();
  } else {
   $_SESSION['error'] = "Erro ao cadastrar. Tente novamente.";
  }
 }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Cadastro - Prato Fácil</title>
 <link rel="stylesheet" href="../assets/css/signup.css">
</head>

<body>
 <div class="signup-container">
  <h1>Cadastre-se</h1>
  <p class="subtitle">Insira os dados corretamente</p>

  <?php
  if (isset($_SESSION['error'])) {
   echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
   unset($_SESSION['error']);
  }
  if (isset($_SESSION['success'])) {
   echo "<p class='success-message'>" . $_SESSION['success'] . "</p>";
   unset($_SESSION['success']);
  }
  ?>

  <form action="signup.php" method="POST">
   <div class="input-group">
    <label for="name">Nome</label>
    <input type="text" id="name" name="name" required>
   </div>
   <div class="input-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>
   </div>
   <div class="input-group">
    <label for="password">Senha</label>
    <input type="password" id="password" name="password" required>
   </div>
   <div class="input-group">
    <label for="confirm_password">Confirme a Senha</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
   </div>
   <div class="input-group">
    <label for="birthdate">Data de Nascimento</label>
    <input type="date" id="birthdate" name="birthdate" required>
   </div>
   <button type="submit" class="btn">Cadastrar</button>
  </form>

  <p class="login-link">Já tem uma conta? <a href="login.php">Entre aqui</a></p>
 </div>
</body>

</html>