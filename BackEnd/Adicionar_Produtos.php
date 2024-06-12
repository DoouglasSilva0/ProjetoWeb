<?php
require_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $valor = (float)$_POST["valor"];
    $foto = $_FILES["foto"]["tmp_name"];
    $fotoTipo = $_FILES["foto"]["type"];


    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($fotoTipo, $allowedTypes)) {
        if (is_uploaded_file($foto)) {
            $fotoData = addslashes(file_get_contents($foto));
            
            $sql = "INSERT INTO produto (nome, valor, foto) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sds", $nome, $valor, $fotoData);
            
            if ($stmt->execute()) {
                echo "Produto adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar produto: " . $stmt->error;
            }
            
            $stmt->close();
        } else {
            echo "Erro no upload da foto.";
        }
    } else {
        echo "Tipo de arquivo não permitido. Apenas JPEG, PNG e GIF são permitidos.";
    }
}

$conn->close();
?>
