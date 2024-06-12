<?php
require_once("conexao.php");

session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_id'] == 0) {
    header("Location: index.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql_total = "SELECT SUM(c.quantidade * p.valor) AS total_carrinho
              FROM carrinho c
              INNER JOIN produto p ON c.produto_id = p.id
              WHERE c.usuario_id = ?";

$stmt_total = $conn->prepare($sql_total);
$stmt_total->bind_param('i', $usuario_id);
$stmt_total->execute();
$result_total = $stmt_total->get_result();
$row_total = $result_total->fetch_assoc();

echo number_format($row_total['total_carrinho'], 2, ',', '.');

$conn->close();
?>