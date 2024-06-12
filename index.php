<?php
session_start();
require_once("BackEnd/conexao.php");

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['usuario_id'] = 0;
    header("Location: index.php");
    exit();
}

$nomeUsuario = isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<!--divinectorweb.com-->
<head>
    <meta charset="UTF-8">
    <title>TuristandoPE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Styles/styleIndex.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <img src="Images/logonova1.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Página inicial</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./FrontEnd/produtoslista.php">Compras</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./FrontEnd/informacao.php">Informações</a>
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
    <main>

        <div class="container-fluid">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" style="height: 27em;">
    <div class="carousel-item active">
      <img class="d-block w-100" src="Images/Antigo.jpg" alt="Primeira imagem" style= "background-size: cover; background-position: center; height: 75vh;">
    </div>
    <div class="carousel-item">
    <img class="d-block w-100" src="Images/ground-zero-recife-pernambuco-ancient-reef.jpg" alt="Segunda imagem" style= "background-size: cover; background-position: center; height: 75vh;">
    </div>
    <div class="carousel-item">
    <img class="d-block w-100" src="Images/recife-2014127.jpg" alt="Terceira imagem" style= "background-size: cover; background-position: center; height: 75vh;">
    </div>
  </div>
  </a>
</div>
    </main>
    <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacotes de Viagem</title>
    <link rel="stylesheet" href="Styles/destaques.css">
</head>
<body>
    <div class="container">
        <h2>Pacotes em Destaques</h2>
        <div class="packages international">
            <div class="package">
                <img src="Images/RESERVA DO PAIVA.png" alt="Assunção">
                <div class="details">
                    <h3>Reserva do Paiva</h3>
                    <p>• Hospedagem</p>
                    <p>• Café da manhã</p>
                    <p>• Almoço</p>
                    <p>• Janta<br><span>R$ 1.406</span></p>
                </div>
            </div>
            <div class="package">
                <img src="Images/visitar-porto-de-galinhas.jpg" alt="Córdoba">
                <div class="details">
                    <h3>Porto de Galinhas</h3>
                    <p>• Hospedagem</p>
                    <p>• Café da manhã</p>
                    <p>• Almoço</p>
                    <p>• Janta<br><span>R$ 2.234</span></p>
                </div>
            </div>
            <div class="package">
                <img src="Images/FERNANDO DE NORONHA.jpg" alt="Mendoza">
                <div class="details">
                    <h3>Fernando de Noronha</h3>
                    <p>• Hospedagem</p>
                    <p>• Café da manhã</p>
                    <p>• Almoço</p>
                    <p>• Janta<br><span>R$ 1.745</span></p>
                </div>
            </div>
            <div class="package">
                <img src="Images/Boa viagem.jpg" alt="Montevidéu">
                <div class="details">
                    <h3>Boa Viagem</h3>
                    <p>• Hospedagem</p>
                    <p>• Café da manhã</p>
                    <p>• Almoço</p>
                    <p>• Janta<br><span>R$ 1.663</span></p>
                </div>
            </div>
        </div>
        <div class="packages national">
            <div class="package">
                <img src="Images/Enseada dos Golfinhos.jpg" alt="Rio de Janeiro">
                <div class="details">
                    <h3>Enseada dos Golfinhos</h3>
                    <p>• Hospedagem</p>
                    <p>• Café da manhã</p>
                    <p>• Almoço</p>
                    <p>• Janta<br><span>R$ 3.296</span></p>
                </div>
            </div>
            <div class="package">
                <img src="Images/Itamaraca.jpg" alt="Recife">
                <div class="details">
                    <h3>Coroa do Avião</h3>
                    <p>• Hospedagem</p>
                    <p>• Café da manhã</p>
                    <p>• Almoço</p>
                    <p>• Janta<br><span>R$ 2.782</span></p>
                </div>
            </div>
            <div class="package">
                <img src="Images/Calheitas.jpg" alt="Salvador">
                <div class="details">
                    <h3>Praia de Calheitas</h3>
                    <p>• Hospedagem</p>
                    <p>• Café da manhã</p>
                    <p>• Almoço</p>
                    <p>• Janta<br><span>R$ 1.767</span></p>
                </div>
            </div>
            <div class="package">
                <img src="Images/praia-carneiros-pernambuco-820x615.jpg" alt="Fortaleza">
                <div class="details">
                    <h3>Praia dos carneiros</h3>
                    <p>• Hospedagem</p>
                    <p>• Café da manhã</p>
                    <p>• Almoço</p>
                    <p>• Janta<br><span>R$ 1.224</span></p>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">          
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
<>

  <script>

setInterval(function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'BackEnd/atualizarCarrinho.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            document.querySelector('.contador-carrinho').textContent = response ? response : 0;
        }
    };
    xhr.send();
}, 1);

  function login(){
    window.location.href = "FrontEnd/login.php";
  }

  function verCarrinho() {
    window.location.href = "FrontEnd/carrinho.php";
}

function gestao(){
    window.location.href = "FrontEnd/gestao.php";
}
</script>
<title>Footer Example</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <footer>

    <div class="whatsapp">
                <a href="https://wa.me/5581993788894"><img src="Images/Whatsimg.png" alt="WhatsApp"></a>
            </div>

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
                    <li><a href="FrontEnd/produtoslista.php">Produtos</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>TuristandoPE</h3>
                <ul>
                    <li><a href="https://br.linkedin.com">Trabalhe conosco</a></li>
                    
            </div>
            <div class="column central-relacionamento">
                <h3>Central de Relacionamento</h3>
                <a href="FrontEnd/informacao.php"><button>TIRE SUAS DÚVIDAS</button></a>
            </div>
        </div>
        <div class="social-media">
            <h3>Social Mídias</h3>
            <div class="icons">
                <a href="https://www.instagram.com/dougdmx/"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me/5581993788894"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
        <div class="payments">
        <h3>Aceitamos todos os cartões</h3>
            <img src="images/mastercard.png" alt="Mastercard">
            <img src="Images/Express.png" alt="American Express">
            <img src="images/hipercard.png" alt="Hipercard">
            <img src="images/pix.png" alt="Pix">

        </div>
    </footer>
</body>
</html>
</html>

