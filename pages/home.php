<?php
session_start();
include('../includes/config.php');

// Função para verificar se o usuário está logado
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Convidado';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Prato Fácil</title>
    <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../assets/images/logo.png" alt="Logo Prato Fácil">
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <?php if (isUserLoggedIn()): ?>
                    <li><a href="minhas-receitas.php">Minhas Receitas</a></li>
                    <li><a href="profile.php">Meu Perfil</a></li>
                    <li><a href="lista-compras.php">Lista de Compras</a></li>
                    <li><a href="logout.php">Sair</a></li>
                    <li><span><?php echo $user_name; ?></span></li>
                <?php else: ?>
                    <li><a href="login.php">Entrar</a></li>
                    <li><a href="signup.php">Cadastrar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="search-recipes">
            <h2>Pesquise a receita</h2>
            <form action="search.php" method="GET">
                <input type="text" name="ingredient" placeholder="Pesquise a receita..." required>
                <button type="submit">Buscar</button>
            </form>
            <div class="filter-buttons">
                <button class="filter-btn">Todas</button>
                <button class="filter-btn">Vegetarianas</button>
                <button class="filter-btn">Veganos</button>
                <button class="filter-btn">Doce</button>
                <button class="filter-btn">Salgado</button>
            </div>
        </section>

        <section class="recipe-list">
            <h2>Receitas</h2>
            <div class="recipes">
                <!-- Aqui você pode puxar receitas do banco de dados -->
                <div class="recipe-item">
                    <img src="../assets/images/recipe-example.jpg" alt="Bife">
                    <h3>Bife</h3>
                    <p>Retire os bifes da geladeira 10 minutos antes de grelhar...</p>
                    <div class="recipe-meta">
                        <span>10 min</span> | <span>2 Porções</span> | <span>Fácil</span>
                    </div>
                    <div class="recipe-actions">
                        <?php if (isUserLoggedIn()): ?>
                            <button class="btn-favorite">❤ Favoritar</button>
                            <button class="btn-rate">⭐ Classificar</button>
                        <?php else: ?>
                            <p><a href="login.php">Entre</a> para favoritar ou classificar receitas.</p>
                        <?php endif; ?>
                        <a href="#" class="btn-ver-mais">Ver mais</a>
                    </div>
                </div>
                <!-- Repetir para outras receitas -->
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="privacy.php">Política de Privacidade</a>
                <a href="terms.php">Termos de Serviço</a>
                <a href="contact.php">Contato</a>
                <a href="help.php">Ajuda</a>
            </div>
            <div class="footer-social">
                <a href="https://www.facebook.com" target="_blank">Facebook</a> |
                <a href="https://www.instagram.com" target="_blank">Instagram</a> |
                <a href="https://www.twitter.com" target="_blank">Twitter</a>
            </div>
            <div class="footer-logo">
                <img src="../assets/images/logo-footer.png" alt="Logo Prato Fácil">
            </div>
            <div class="footer-copyright">
                &copy; 2024 Prato Fácil. Todos os direitos reservados.
            </div>
        </div>
    </footer>
</body>
</html>
