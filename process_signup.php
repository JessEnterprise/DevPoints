<?php
session_start();

// Incluir a conexão com o banco de dados
include('db_connection.php');  // Certifique-se de que o caminho está correto

// Recebe os dados do formulário de maneira segura
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : ''; // Verifica se existe o valor de telefone
$address = isset($_POST['address']) ? $_POST['address'] : ''; // Verifica se existe o valor de endereço
$password = isset($_POST['password']) ? $_POST['password'] : '';
$nif = isset($_POST['nif']) ? $_POST['nif'] : ''; // Captura o valor de NIF

// Verificação simples de se os campos obrigatórios estão preenchidos
if (empty($name) || empty($email) || empty($password) || empty($nif)) {
    die("Por favor, preencha todos os campos obrigatórios.");
}

// Verifica se o NIF já está cadastrado
$stmt = $conn->prepare("SELECT id FROM users WHERE nif = ?");
$stmt->bind_param("s", $nif);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Erro: O NIF informado já está cadastrado.");
}

// Cria um hash da senha
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Conectar ao banco de dados
$conn = new mysqli('localhost', 'root', '', 'econpoints');
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Inserir o usuário no banco de dados
$sql = "INSERT INTO users (name, email, phone, address, password, nif) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssss', $name, $email, $phone, $address, $passwordHash, $nif);

// Executa a consulta
if ($stmt->execute()) {
    // Cadastro realizado com sucesso
    header('Location: signup_success.php');
    exit(); // Garante que o script pare de executar após o redirecionamento
} else {
    // Exibe erro caso o cadastro falhe
    echo "Erro ao cadastrar: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>
