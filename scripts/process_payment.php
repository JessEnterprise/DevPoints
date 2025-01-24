<?php
session_start();
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $amount = $_POST['amount'];

    // Inserir pagamento no banco de dados
    $stmt = $conn->prepare("INSERT INTO payments (user_id, amount, status) VALUES (?, ?, ?)");
    $status = 'completed';
    $stmt->bind_param("ids", $user_id, $amount, $status);
    $stmt->execute();

    // Atualizar os pontos do usuário
    $points_earned = floor($amount / 10); // Exemplo: 1 ponto para cada 10 unidades monetárias
    $stmt = $conn->prepare("UPDATE users SET points = points + ? WHERE id = ?");
    $stmt->bind_param("ii", $points_earned, $user_id);
    $stmt->execute();

    // Registro de transação de pontos
    $stmt = $conn->prepare("INSERT INTO points_transactions (user_id, points, description) VALUES (?, ?, ?)");
    $description = "Pagamento de conta no valor de $amount";
    $stmt->bind_param("iis", $user_id, $points_earned, $description);
    $stmt->execute();

    // Redirecionar com mensagem de sucesso
    header("Location: profile.php?message=Pagamento registrado com sucesso!");
    exit();
}
?>
