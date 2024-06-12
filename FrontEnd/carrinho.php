<?php
session_start();
require_once("../BackEnd/conexao.php");

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_id'] == 0) {
    header("Location: index.php");
    exit();
}

$nomeUsuario = isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : '';

$usuario_id = $_SESSION['usuario_id'];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Carrinho de Compras</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../Styles/stylesCart.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <main>
        <div class="page-title">Seu Carrinho</div>
        <div class="content">
            <section>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                  $sql = "SELECT p.nome AS produto, p.foto, c.quantidade, p.valor, (c.quantidade * p.valor) AS total_item, c.id AS carrinho_id
                  FROM carrinho c
                  INNER JOIN produto p ON c.produto_id = p.id
                  WHERE c.usuario_id = ?";
                  
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('i', $usuario_id);
          $stmt->execute();
          $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>";
                            echo "<div class='product'>";
                            echo "<img src='../BackEnd/" . $row['foto'] . "' alt='" . $row['produto'] . "' />";
                            echo "<div class='info'>";
                            echo "<div class='name'>" . $row['produto'] . "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</td>";
                            echo "<td>R$ " . number_format($row['valor'], 2, ',', '.') . "</td>";
                            echo "<td>";
                            echo "<div class='qty'>";
                            echo "<button class='bx bx-minus'></button>";
                            echo "<span class='quantity' data-id='" . $row['carrinho_id'] . "'>" . $row['quantidade'] . "</span>";
                            echo "<button class='bx bx-plus'></button>";
                            echo "</div>";
                            echo "</td>";
                            echo "<td><span class='total_item' data-id='" . $row['carrinho_id'] . "'>R$ " . number_format($row['total_item'], 2, ',', '.') . "</span></td>";
                            echo "<td>";
                            echo "<button class='remove' data-id='" . $row['carrinho_id'] . "'><i class='bx bx-x'></i></button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Seu carrinho está vazio.</td></tr>";
                    }

                    $sql_total = "SELECT SUM(c.quantidade * p.valor) AS total_carrinho
              FROM carrinho c
              INNER JOIN produto p ON c.produto_id = p.id
              WHERE c.usuario_id = ?";

$stmt_total = $conn->prepare($sql_total);
$stmt_total->bind_param('i', $usuario_id);
$stmt_total->execute();
$result_total = $stmt_total->get_result();
$row_total = $result_total->fetch_assoc();

                    ?>
                    </tbody>
                </table>
            </section>
            <aside>
                <div class="box">
                    <header>Resumo da compra</header>
                    <div class="info">
                        <div><span>Sub-total</span><span>R$
                                <?php echo number_format($row_total['total_carrinho'], 2, ',', '.'); ?></span></div>
                    </div>
                    <footer>
                        <span>Total</span>
                        <span>R$ <?php echo number_format($row_total['total_carrinho'], 2, ',', '.'); ?></span>
                    </footer>
                </div>
                <div class="button-group">
                    <?php if ($row_total['total_carrinho'] == 0){ ?>
                    <button class="btn-voltar" onclick="voltar()">Continuar Comprando</button>
                    <?php }else{ ?>
                    <button class="btn-finalizar" onclick="pagar()">Finalizar Compra</button>
                    </br>
                    <button class="btn-voltar" onclick="voltar()">Continuar Comprando</button>
                    <?php } ?>
                </div>

            </aside>
        </div>
    </main>
    <script>
    function pagar() {
        window.location.href = "pagamentos.php";
    }

    $(document).ready(function() {
        $('body').on('click', '.bx-plus', function() {
            var button = $(this).closest('.qty').find('.quantity');
            var id = button.data('id');
            var quantidade = parseInt(button.text()) + 1;
            atualizarQuantidade(id, quantidade, button);
        });

        $('body').on('click', '.bx-minus', function() {
            var button = $(this).closest('.qty').find('.quantity');
            var id = button.data('id');
            var quantidade = parseInt(button.text()) - 1;
            if (quantidade > 0) {
                atualizarQuantidade(id, quantidade, button);
            } else {
                removerItem(id, button);
            }
        });

        function atualizarQuantidade(id, quantidade, button) {
            $.ajax({
                url: '../BackEnd/atualizarcarrinho2.php',
                type: 'POST',
                data: {
                    id: id,
                    quantidade: quantidade
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    button.text(data.quantidade);
                    button.closest('tr').find('.total_item').text('R$ ' + data.total_item);
                    $('.info span').last().text('R$ ' + data.total_carrinho);
                    $('footer span').last().text('R$ ' + data.total_carrinho);
                }
            });
        }

        function removerItem(id, button) {
            $.ajax({
                url: '../BackEnd/removercarrinho.php',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(total_carrinho) {
                    button.closest('tr').remove();
                    $('.info span').last().text('R$ ' + total_carrinho);
                    $('footer span').last().text('R$ ' + total_carrinho);
                }
            });
        }

        $('body').on('click', '.remove', function() {
            var button = $(this);
            var id = button.data('id');

            $.ajax({
                url: '../BackEnd/removercarrinho.php',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(total_carrinho) {
                    button.closest('tr').remove();
                    $('.info span').last().text('R$ ' + total_carrinho);
                    $('footer span').last().text('R$ ' + total_carrinho);
                }
            });
        });
    });

    function voltar() {
        window.location.href = "produtoslista.php";
    }
    </script>
</body>

</html>