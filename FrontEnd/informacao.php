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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> 
    <title>Informações</title>
    <link rel="stylesheet" href="../Styles/styleInformacao.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
                    <a class="nav-link" href="../FrontEnd/informacao.php">Informações</a>
                </li>
            </ul>
            <?php if($_SESSION['usuario_id'] != '0'): ?>
                <div class="person">
                    <button type="button" class="btn" onclick="gestao()">
                        <ion-icon size="large" name="person-circle-outline"></ion-icon>
                        <span class="navbar-text mr-2"><?php echo htmlspecialchars($nomeUsuario); ?></span>
                   </button> 
                </div>

                <div class="cart">
                    <button type="button" class="btn"  onclick="verCarrinho()">
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

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
        <header>
            <h1>Informações</h1>
        </header>
        <main>
            <section class="faq">
                <?php
                $faqs = [
                    [
                        "question" => "Hospedagem em hotel e incluso nos pacotes?",
                        "answer" => "Sim, é incluso hospedagem em hotel com direito a café da manhã, almoço e janta."
                    ],
                    [
                        "question" => "Precisa fazer reserva?",
                        "answer" => "Normalmente apenas grupos precisam fazer reserva, porém sugerimos que, antes de vir comprar um pacote de hospedagem entre em contato."
                    ],

                    [
                        "question" => "Criança paga?",
                        "answer" => "Criança até 2 anos incompletos viajam no colo gratuitamente em voos."
                    ],
                    [
                        "question" => "Aceita cartão?",
                        "answer" => "Sim aceitamos todas as bandeiras de cartões de crédito ou débito."
                    ],
                    [
                        "question" => "Há controle de lotação?",
                        "answer" => "Sim, uma vez alcançada a quantidade de clientes estipulada, os pacotes de viagens serão esgotados."
                    ],
                ];

                foreach ($faqs as $faq) {
                    echo "<div class=\"faq-item\">";
                    echo "<h3>" . $faq["question"] . "</h3>";
                    echo "<p>" . $faq["answer"] . "</p>";
                    echo "</div>";
                }
                ?>
            </section>
        </main>
        <footer>
            <div class="whatsapp">
                <a href="https://wa.me/5581993788894"><img src="../Images/Whatsimg.png" alt="WhatsApp"></a>
            </div>
        </footer>
        
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
function gestao(){
    window.location.href = "gestao.php";
}



</script>

</script>
<title>Footer Example</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <footer>
        <div class="container">
            <div class="column">
                <h3>Conta</h3>
                <ul>
                    <li><a href="FrontEnd/gestao.php">Meu perfil</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Compras</h3>
                <ul>
                    <li><a href="FrontEnd/produtoslista.php">Planos</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>TuristandoPE</h3>
                <ul>
                    <li><a href="trabalhe-conosco.html">Trabalhe conosco</a></li>
                </ul>
            </div>
            <div class="column central-relacionamento">
                <h3>Central de Relacionamento</h3>
                <a href="FrontEnd/informacao.php"><button>TIRE SUAS DÚVIDAS</button></a>
            </div>
        </div>
        <div class="social-media">
            <h3>Social Mídias</h3>
            <div class="icons">
                <a href="https://www.instagram.com/ryanb_tkd/"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me/5581993788894"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
        <div class="payments">
        <h3>Aceitamos todos os cartões</h3>
            <img src="../images/mastercard.png" alt="Mastercard">
            <img src="../Images/Express.png" alt="American Express">
            <img src="../images/hipercard.png" alt="Hipercard">
            <img src="../Images/PIX.png" alt="Pix">

        </div>
    </footer>
</body>
</html>


</html>

