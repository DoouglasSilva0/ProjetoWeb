<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Loja";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $valor = $_POST["valor"];
    $fotoName = $_FILES["foto"]["name"];
    $fotoTmpName = $_FILES["foto"]["tmp_name"];
    $fotoSize = $_FILES["foto"]["size"];
    $fotoError = $_FILES["foto"]["error"];
    
   
    $fotoNewName = uniqid() . '-' . $fotoName;
    $fotoDestination = 'upload/' . $fotoNewName;

    if ($fotoError === 0) {
        if (move_uploaded_file($fotoTmpName, $fotoDestination)) {
            $sql = "INSERT INTO produto (nome, valor, foto) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sds", $nome, $valor, $fotoDestination);
            
            if ($stmt->execute()) {
                echo "Produto adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar produto: " . $stmt->error;
            }
            
            $stmt->close();
        } else {
            echo "Erro ao mover o arquivo da imagem para o diretório de upload.";
        }
    } else {
        echo "Erro no upload da imagem.";
    }
}

$conn->close();
?>