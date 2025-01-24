<!DOCTYPE HTML>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EconPoints</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

    <header>
        <h1>Login - EconPoints</h1>
    </header>

    <section>
        <form action="process_login.php" method="post">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Entrar</button>
        </form>
    </section>

</body>
</html>
