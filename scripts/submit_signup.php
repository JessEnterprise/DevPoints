<?php
// Recebe os dados do formulário
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];

// Cria um hash da senha
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Conectar ao banco de dados
$conn = new mysqli('localhost', 'root', '', 'econpoints');
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Inserir o usuário no banco de dados
$sql = "INSERT INTO users (name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssss', $name, $email, $phone, $address, $passwordHash);

// Executa a consulta
if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
