<!-- signup.html -->
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário - EconPoints</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <h1>Cadastro de Novo Usuário</h1>

    <!-- Formulário de Cadastro -->
    <form action="process_signup.php" method="post">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="phone">Telefone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="address">Endereço:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
