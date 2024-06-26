<?php
$message = "";

if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>allskiin • criar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../Styles/util.css">
    <link rel="stylesheet" type="text/css" href="../Styles/main.css">
</head>

<body>


    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
            <form class="login100-form validate-form" method="POST" action="../BackEnd/CadastroInsert.php">
                <span class="login100-form-title p-b-37">
                    Criar
                </span>
                <div class="wrap-input100 validate-input m-b-20" data-validate="nome em falta">
                    <input class="input100" type="text" name="nome" placeholder="nome">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 validate-input m-b-20" data-validate="email em falta">
                    <input class="input100" type="text" name="email" placeholder="email">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 validate-input m-b-25" data-validate="senha em falta">
                    <input class="input100" type="password" name="senha" placeholder="senha">
                    <span class="focus-input100"></span>
                </div>

                <div class="error">
                    <?php if (!empty($message)): ?>
                    <p><?php echo $message; ?></p>
                    <?php endif; ?>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        Criar
                    </button>
                </div>
                <div class="text-center">
                    <a href="login.php" class="txt2 hov1">
                        Entrar
                    </a>
                </div>
            </form>

        </div>
    </div>
    <div id="dropDownSelect1"></div>
</body>

</html>