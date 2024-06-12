<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        if (!empty($nome) && !empty($email) && !empty($senha) ) {
            
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                
                $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nome, $email, $senhaHash);
                
                if ($stmt->execute()) {
                    $sucesso = "Usuário cadastrado com sucesso!";

                    header("Location: ../FrontEnd/login.php?sucesso=" . urlencode($sucesso));
                    exit();
                } else {
                    $message = "Erro ao cadastrar o usuário: " . $stmt->error;
                    header("Location: ../FrontEnd/cadastro.php?message=" . urlencode($message));
                   exit();
                }
            
                $stmt->close();
    
        } else {
            $message = "Preencha todos os campos.";

            header("Location: ../FrontEnd/cadastro.php?message=" . urlencode($message));
        exit();
        }
        
        $conn->close();

       
    }
}
?>
