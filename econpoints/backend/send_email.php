// send_email.php (Exemplo de backend)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    $mail->setFrom('no-reply@econpoints.com', 'EconPoints');
    $mail->addAddress($user_email, 'Usuário'); // Endereço de e-mail do usuário
    $mail->Subject = 'Lembrete de Pagamento';
    $mail->Body    = 'Este é um lembrete para o pagamento da sua conta. Não se esqueça de pagar antes do vencimento!';
    $mail->send();
} catch (Exception $e) {
    echo 'Erro ao enviar o e-mail: ', $mail->ErrorInfo;
}
