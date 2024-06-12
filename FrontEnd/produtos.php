<?php
session_start();
require_once("../BackEnd/conexao.php");

$sql = "SELECT id, nome, valor, foto FROM produto";
$result = $conn->query($sql);

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['usuario_id'] = 0;
    header("Location: index.php");
    exit();
}

$nomeUsuario = isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : '';

?>

<!DOCTYPE html>
<html>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> 
<link rel="stylesheet" href="../Styles/styleIndex.css">
</script>


<head>
    <title>Loja de Produtos</title>
    <style>
    .produto {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
        width: 300px;
        text-align: center;
        margin-right: 20px;
    }


    .produto img {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
    }

    .container1 {
        margin-top: 15vh;
        position: relative;
        height: 10vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    button {
        margin-top: 10px
    }

    .cm {
        position: absolute;
        top: 20px;
        text-align: center;
    }

    .cart {
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .produtos-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .contador-carrinho {
        position: absolute;
        top: 0;
        right: 2;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 14px;
    }
    </style>
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
                    <a class="nav-link" href="produtos.php" style=font-weight: bold>Compras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contato.html">Contato</a>
                </li>
            </ul>
            <?php if($_SESSION['usuario_id'] != '0'): ?>
                <div class="cart">
        <a href="carrinho.php" class="icon-car">
       
            <button type="button" class="btn">
                <ion-icon size="large" name="cart-outline"></ion-icon>
                <span class="contador-carrinho">0</span>
            </button>
        </a>
    </div>
            <?php else: ?>
            <a href="login.php">
                <button class="btn btn-outline-success my-2 my-sm-0">Login</button>
            </a>
            <?php endif; ?>

        </div>
    </nav>

    <!-- Modificação do botão de login -->


    <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    



    </div>




    <div class="container1">
        <div class="cm">
            <h1>Produtos</h1>
        </div>

    </div>
    <div class="produtos-container">
        <?php
      
        if ($result->num_rows > 0) {
        
            while($row = $result->fetch_assoc()) {
                ?>
        <div class="produto">
            <h2><?php echo htmlspecialchars($row["nome"]); ?></h2>
            <p>Preço: R$ <?php echo number_format($row["valor"], 2, ',', '.'); ?></p>
            <?php if (!empty($row['foto'])): ?>
            <img src="<?php echo '../BackEnd/' . htmlspecialchars($row['foto']); ?>"
                alt="<?php echo htmlspecialchars($row['nome']); ?>" style="max-width: 100%; height: 20vh;">
            <?php else: ?>
            <p>Imagem não disponível</p>
            <?php endif; ?>
            <form action="../BackEnd/adicionar_ao_carrinho.php" method="POST">
                <input type="hidden" name="produto_id" value="<?php echo $row["id"]; ?>">
                <?php if($_SESSION['usuario_id'] != '0'): ?>
                <label for='quantidade'>Quantidade:</label>
                <input type='number' name='quantidade' min='1' value='1'>
                <button type='submit'>Adicionar ao Carrinho</button>
                <?php endif; ?>
            </form>
        </div>
        <?php
            }
        } else {
            echo "<p>Nenhum produto encontrado.</p>";
        }
     
        $conn->close();
        ?>
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
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

</html>