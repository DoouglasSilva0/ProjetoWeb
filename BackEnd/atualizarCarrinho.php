<?php
require_once("conexao.php");

session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_id'] == 0) {
    header("Location: index.php");
    exit();
}

function obterQuantidadeTotalCarrinho($conn, $usuario_id) {
    $sql = "SELECT SUM(quantidade) AS quantidade_total FROM carrinho WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['quantidade_total'];
    } else {
        echo 0;
    }
}

$usuario_id = $_SESSION['usuario_id'];
obterQuantidadeTotalCarrinho($conn, $usuario_id);

$conn->close();
?>
