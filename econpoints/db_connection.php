<?php
$host = 'localhost';  // Endereço do servidor de banco de dados
$user = 'root';       // Nome de usuário do banco de dados
$password = '';       // Senha do banco de dados
$dbname = 'econpoints'; // Nome do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>
