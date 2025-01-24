<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Se não estiver logado, redireciona para a página de login
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EconPoints</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Cabeçalho -->
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Cadastro</a></li>
            </ul>
        </nav>
    </header>

    <!-- Perfil do Usuário -->
    <main>
        <section>
            <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>

            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            <p><strong>Telefone:</strong> <?php echo htmlspecialchars($_SESSION['phone']); ?></p>
            <p><strong>Endereço:</strong> <?php echo htmlspecialchars($_SESSION['address']); ?></p>

            <a href="logout.php">Sair</a>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> EconPoints. Todos os direitos reservados.</p>
    </footer>

</body>
</html>
