<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['usuario_id'] = 0;
    header("Location: index.php");
    exit();
}

$nomeUsuario = isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : '';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styleIndex.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> 
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Minha Conta</title>
    <link rel="stylesheet" href="../Styles/gestao.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="../Images/logonova1.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php" >Página inicial </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produtoslista.php" style=font-weight: bold>Compras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="informacao.php">Informações</a>
                </li>
            </ul>
            <?php if($_SESSION['usuario_id'] != '0'): ?>
                <div class="person">
                    <button type="button" class="btn">
                        <ion-icon size="large" name="person-circle-outline"></ion-icon>
                        <span class="navbar-text mr-2"><?php echo htmlspecialchars($nomeUsuario); ?></span>
                   </button> 
                </div>

                <div class="cart">
                    <button type="button" class="btn" onclick="verCarrinho()">
                        <ion-icon size="large" name="cart-outline"></ion-icon>
                        <span class="contador-carrinho">0</span>
                   </button> 
                </div>
            <?php else: ?>
                <button class="btn btn-outline-success my-2 my-sm-0" onclick="login()">Login</button>
            <?php endif; ?>

        </div>
    </nav>

    <!-- Modificação do botão de login -->


    <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="container">
        <h1>MINHA CONTA</h1>
        <div class="cards">

            <!--  A IDEIA ERA MOSTAR OS PEDIDOS MAS DEU PREGUICA ENTT FODA-SE
            <div class="card">
                <a href="meus_pedidos.html">
                    <img src="../images/meus_pedidos.webp" alt="Meus Pedidos">
                    <p>Meus pedidos</p>
                </a>
            </div>
            -->

            <div class="card">
                <a href="../BackEnd/sair.php">
                    <img src="../images/sair.webp" alt="Sair">
                    <p>Sair</p>
                </a>
            </div>
        </div>
    </div>
</body>
<script>
setInterval(function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../BackEnd/atualizarCarrinho.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            document.querySelector('.contador-carrinho').textContent = response ? response : 0;
        }
    };
    xhr.send();
}, 1);

function verCarrinho() {
    window.location.href = "../FrontEnd/carrinho.php";
}
function login() {
    window.location.href = "../FrontEnd/login.php";
}

</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</html>
