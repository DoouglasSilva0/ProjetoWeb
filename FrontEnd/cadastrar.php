<?php
$message = "";

if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
?>

<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Projeto Login</title>
    <link rel="stylesheet" href="../Styles/styleForms.css">
</head>
<body>
<div id="corpo-form-cad">
    <h1>Cadastrar</h1>
    <form method="POST" action="../BackEnd/CadastroInsert.php">
        <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
        <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
        <input type="email" name="email" placeholder="Email" maxlength="40">
        <input type="password" name="senha" placeholder="Senha" maxlength="15">
        <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15">
        <input type="submit" value="Cadastrar">
    </form>
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
</div>
</body>
</html>
