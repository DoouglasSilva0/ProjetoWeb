<?php
require_once("conexao.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_id'] == 0) {
        header("Location: index.php");
        exit();
    }

    $usuario_id = $_SESSION['usuario_id'];
    $id = $_POST['id'];
    $quantidade = $_POST['quantidade'];

    // Atualiza a quantidade do item no carrinho para o usuário conectado
    $sql = "UPDATE carrinho SET quantidade = ? WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantidade, $id, $usuario_id);
    $stmt->execute();

    // Obtém o valor do produto e o total do item atualizado
    $sql = "SELECT p.valor, (c.quantidade * p.valor) AS total_item
            FROM carrinho c
            INNER JOIN produto p ON c.produto_id = p.id
            WHERE c.id = ? AND c.usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Calcula o total do carrinho para o usuário conectado
    $sql_total = "SELECT SUM(c.quantidade * p.valor) AS total_carrinho
                  FROM carrinho c
                  INNER JOIN produto p ON c.produto_id = p.id
                  WHERE c.usuario_id = ?";
    $stmt_total = $conn->prepare($sql_total);
    $stmt_total->bind_param("i", $usuario_id);
    $stmt_total->execute();
    $result_total = $stmt_total->get_result();
    $row_total = $result_total->fetch_assoc();

    echo json_encode([
        'quantidade' => $quantidade,
        'total_item' => number_format($row['total_item'], 2, ',', '.'),
        'total_carrinho' => number_format($row_total['total_carrinho'], 2, ',', '.')
    ]);
}

$conn->close();
?>
