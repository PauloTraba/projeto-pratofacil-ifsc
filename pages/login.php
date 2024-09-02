<?php
session_start();
include('../includes/config.php'); // Arquivo com a configuração do banco de dados

// Verifica se o usuário já está logado e redireciona para a home se estiver
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepara e executa a consulta no banco de dados
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifica se a senha está correta
        if (password_verify($password, $user['password'])) {
            // Armazena os dados do usuário na sessão
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            // Redireciona para a página principal
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['error'] = "Senha incorreta.";
        }
    } else {
        $_SESSION['error'] = "Usuário não encontrado.";
    }
}
?>

<!-- HTML começa aqui -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Prato Fácil</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <h1>Entrar</h1>

        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>

        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Lembrar-me</label>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>

        <div class="social-login">
            <button class="btn-social">Facebook</button>
            <button class="btn-social">Google</button>
        </div>
        <p class="signup-link">Ainda não tem uma conta? <a href="signup.php">Cadastre-se</a></p>
    </div>
</body>

</html>