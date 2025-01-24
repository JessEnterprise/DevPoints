<?php
// submit_payment.php (Exemplo de backend)
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id']; // ID do usuário logado
    $amount = $_POST['amount']; // Valor do pagamento

    // Lógica de cálculo de pontos (exemplo simples)
    $points_earned = floor($amount / 10); // 1 ponto para cada 10 unidades de valor pago

    // Atualiza a pontuação no banco de dados
    $sql = "UPDATE users SET points = points + $points_earned WHERE id = $user_id";
    mysqli_query($conn, $sql);

    echo "Pagamento realizado com sucesso. Pontos acumulados: $points_earned";
}
?>
