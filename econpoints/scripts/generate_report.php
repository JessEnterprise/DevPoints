<?php
session_start();
require 'config.php';

$user_id = $_SESSION['user_id'];

// Obter dados de consumo
$stmt = $conn->prepare("SELECT SUM(amount) AS total_payments, SUM(points) AS total_points FROM payments INNER JOIN users ON payments.user_id = users.id WHERE users.id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo "Total Pago: " . $data['total_payments'] . "<br>";
echo "Pontos Acumulados: " . $data['total_points'];
?>
