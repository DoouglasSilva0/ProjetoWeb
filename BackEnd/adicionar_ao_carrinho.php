<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Loja";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Assumindo que o usuário está logado e o ID do usuário está armazenado na sessão
$usuario_id = $_SESSION["usuario_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto_id = $_POST["produto_id"];
    $quantidade = $_POST["quantidade"];

    // Verifica se o produto já está no carrinho do usuário
    $sql = "SELECT id FROM carrinho WHERE produto_id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $produto_id, $usuario_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Atualiza a quantidade do produto no carrinho do usuário
        $sql = "UPDATE carrinho SET quantidade = quantidade + ? WHERE produto_id = ? AND usuario_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $quantidade, $produto_id, $usuario_id);
    } else {
        // Insere o produto no carrinho do usuário
        $sql = "INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $usuario_id, $produto_id, $quantidade);
    }

    if ($stmt->execute()) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } else {
        echo "Erro ao adicionar produto ao carrinho: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
