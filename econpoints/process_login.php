<?php
session_start();
require 'db_connection.php';

// Receber os dados do formulário
$email = $_POST['email'];
$password = $_POST['password'];

// Verificar se o usuário existe e a senha está correta
$query = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Se o usuário for encontrado
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verificar se a senha é correta
    if (password_verify($password, $user['password'])) {
        // Armazena os dados do usuário na sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        // Redireciona o usuário para a página de boas-vindas
        header('Location: welcome.php');
        exit();
    } else {
        echo "Senha inválida.";
    }
} else {
    echo "Email não encontrado.";
}
?>
