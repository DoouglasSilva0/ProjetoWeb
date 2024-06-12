<?php
require_once("conexao.php");

if (isset($_GET['id'])) {
    $carrinho_id = $_GET['id'];

  
    $sql = "SELECT quantidade FROM carrinho WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $carrinho_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $quantidade = $row['quantidade'];

       
        $sql = "DELETE FROM carrinho WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $carrinho_id);
    

    $stmt->execute();

    $sql_total = "SELECT SUM(c.quantidade * p.valor) AS total_carrinho
                  FROM carrinho c
                  INNER JOIN produto p ON c.produto_id = p.id";
    $result_total = $conn->query($sql_total);
    $row_total = $result_total->fetch_assoc();
    $total_carrinho = number_format($row_total['total_carrinho'], 2, ',', '.');

 
    echo $total_carrinho;

    $stmt->close();
} else {
    echo "Nenhum ID de item fornecido.";
}

$conn->close();
?>
