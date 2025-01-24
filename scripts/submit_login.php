<?php
// Começo da sessão
session_start();

// Supondo que você tenha uma conexão com o banco de dados já estabelecida
include('db_connection.php');

// Receber os dados do formulário
$email = $_POST['email'];
$password = $_POST['password'];

// Verificar se o usuário existe e a senha está correta
$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $query);

// Se o usuário for encontrado
if ($result && mysqli_num_rows($result) > 0) {
    // Recupera as informações do usuário
    $user = mysqli_fetch_assoc($result);
    
    // Armazena o nome do usuário na variável de sessão
    $_SESSION['name'] = $user['name']; // Isso usa o nome do usuário do banco de dados
    
    // Redireciona o usuário para a página de boas-vindas
    header('Location: /econpoints/welcome.html');

    exit();  // Termina o script para evitar que o código continue executando
} else {
    // Se o login falhar, exibe uma mensagem de erro
    echo "Email ou senha inválidos.";
}
?>
