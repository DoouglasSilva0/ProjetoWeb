<?php
session_start();

$userId = $_SESSION['usuario_id'];


    require_once '../vendor/autoload.php';
    require_once '../BackEnd/conexao.php';

    $sql_total = "SELECT SUM(c.quantidade * p.valor) AS total_carrinho
    FROM carrinho c
    INNER JOIN produto p ON c.produto_id = p.id";

$result_total = $conn->query($sql_total);
$row_total = $result_total->fetch_assoc();

$total = floatval(str_replace(',', '.', $row_total['total_carrinho']));


    use MercadoPago\MercadoPagoConfig;
    use MercadoPago\Client\Preference\PreferenceClient;
    use MercadoPago\Exceptions\MPApiException;

    MercadoPagoConfig::setAccessToken("APP_USR-6497954043263645-052921-d0289c3991f90e16a36a07f48c8af8aa-1811961210");
    MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);



    $product = array(

        "title" => "TuristandoPE",
        "description" => "TuristandoPE",
        "currency_id" => "BRL",
        "quantity" => 1,
        "unit_price" => $total
    );

    $items = array($product);


    $request = [
        "items" => $items,
        "back_urls" => [
            'success' => 'http://localhost/Projetos/TurismoPE/sucesso.html',
            'failure' => 'http://fodase.com/failure'
        ],
        "statement_descriptor" => "TuristandoPE",
        "external_reference" => "1234567890",
        "expires" => false,
        "auto_return" => 'approved',
        "payment_methods" => [
            "excluded_payment_types" => [
                ["id" => "ticket"]
            ],
            "installments" => 1
        ]

    ];

    $client = new PreferenceClient();

    try {
        $preference = $client->create($request);
        header("Location: " . $preference->init_point);
    } catch (MPApiException $error) {
        echo $error->getMessage();
    }
?>