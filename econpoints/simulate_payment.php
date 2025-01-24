<?php
session_start();
require 'db_connection.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Obter o serviço (ENDE)
$service_id = 1; // ID fixo para ENDE
$query = "SELECT * FROM services WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $service_id);
$stmt->execute();
$result = $stmt->get_result();
$service = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_date = $_POST['payment_date'];
    $due_date = $service['due_date'];
    $base_points = $service['base_points'];

    // Calcular pontos
    $days_diff = (strtotime($due_date) - strtotime($payment_date)) / (60 * 60 * 24);
    $bonus_points = 0;

    if ($days_diff > 0) {
        $bonus_points = min($days_diff * 2, 20); // 2 pontos por dia de antecedência, até 20 pontos
    } elseif ($days_diff === 0) {
        $bonus_points = 5; // Pontos por pagar no dia
    }

    $total_points = $base_points + $bonus_points;

    echo "<p>Data do pagamento: $payment_date</p>";
    echo "<p>Pontos acumulados: $total_points</p>";
    echo "<p><a href='profile.php'>Voltar ao perfil</a></p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulação de Pagamento</title>
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
    <div class="container">
        <h2>Simulação de Pagamento</h2>
        <p>Serviço: <?php echo htmlspecialchars($service['name']); ?></p>
        <p>Descrição: <?php echo htmlspecialchars($service['description']); ?></p>
        <p>Data de vencimento: <?php echo htmlspecialchars($service['due_date']); ?></p>

        <form method="POST" action="">
            <label for="payment_date">Selecione a data de pagamento:</label>
            <input type="date" id="payment_date" name="payment_date" required>
            <button type="submit">Simular</button>
        </form>
        <a href="profile.php">Voltar ao perfil</a>
    </div>
</body>
</html>
