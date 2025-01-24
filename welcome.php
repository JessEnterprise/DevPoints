<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Incluir conexão com o banco de dados
include('db_connection.php');

// Obter dados do usuário
$user_id = $_SESSION['user_id'];
$query = "SELECT name, email, phone, address, points FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Obter os últimos pagamentos do usuário
$query_payments = "SELECT amount, payment_date, status FROM payments WHERE user_id = ? ORDER BY payment_date DESC LIMIT 5";
$stmt = $conn->prepare($query_payments);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$payments_result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - EconPoints</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <p>Você foi logado com sucesso.</p>

        <!-- Informações pessoais -->
        <h2>Informações do Perfil</h2>
        <ul>
            <li><strong>Nome:</strong> <?php echo htmlspecialchars($user['name']); ?></li>
            <li><strong>E-mail:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
            <li><strong>Telefone:</strong> <?php echo htmlspecialchars($user['phone']); ?></li>
            <li><strong>Endereço:</strong> <?php echo htmlspecialchars($user['address']); ?></li>
            <li><strong>Pontos Acumulados:</strong> <?php echo htmlspecialchars($user['points']); ?> pontos</li>
        </ul>

        <!-- Últimos pagamentos -->
        <h2>Últimos Pagamentos</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Valor (KZ)</th>
                    <th>Data</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($payment = $payments_result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                        <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                        <td><?php echo htmlspecialchars($payment['status']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Simulador de pagamentos -->
        <h2>Simulador de Pagamentos e Ganhos</h2>
        <form action="simulate_payment.php" method="POST">
            <label for="amount">Valor do Pagamento (KZ):</label>
            <input type="number" id="amount" name="amount" required><br>

            <label for="payment_date">Data do Pagamento:</label>
            <input type="date" id="payment_date" name="payment_date" required><br>

            <button type="submit">Simular</button>
        </form>

        <!-- Botão de logout -->
        <a href="logout.php" class="button">Sair</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

