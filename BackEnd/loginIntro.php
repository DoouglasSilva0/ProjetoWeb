<?php
require_once 'conexao.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        if (!empty($email) && !empty($senha)) {
            $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $nome, $senhaHash);
                $stmt->fetch();
                
                if (password_verify($senha, $senhaHash)) {
                    $_SESSION['usuario_id'] = $id;
                    $_SESSION['usuario_nome'] = $nome;
                    header("Location: ../index.php"); 
                    exit();
                } else {
                    $message = "Usuário ou Senha Errados";
                }
            } else {
                $message = "Usuário não cadastrado";
            }
            
            $stmt->close();
        } else {
            $message = "Preencha todos os campos.";
        }
        
        $conn->close();

 
        header("Location: ../FrontEnd/login.php?message=" . urlencode($message));
        exit();
    }
}
?>
