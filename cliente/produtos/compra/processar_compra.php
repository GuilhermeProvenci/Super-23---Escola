<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arquivo de Compra</title>
    <link rel="stylesheet" type="text/css" href="../../../css_avulsos/compra-style.css">
</head>

<body>
    <header>
        <h1>Detalhes da Compra</h1>
    </header>
    <main>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os dados do formulário
    $CodProduto = $_POST["CodProduto"];
    $quantidade = $_POST["quantidade"];
    $nomeCliente = $_POST["nomeCliente"];
    $endereco = $_POST["endereco"];
    $formaPagamento = $_POST["formaPagamento"];

    // Valide os dados conforme necessário

    include("../../../conexao.php");

    // Consulta SQL para obter o valor do produto com base no CodProduto
    $consultaProduto = "SELECT valor FROM Produtos WHERE CodProduto = $CodProduto";
    $resultadoConsultaProduto = mysqli_query($conexaoid, $consultaProduto);

    if ($resultadoConsultaProduto) {
        $produto = mysqli_fetch_assoc($resultadoConsultaProduto);
        $precoProduto = $produto['valor'];

        // Calcular o valor total do boleto
        $valorBoleto = $quantidade * $precoProduto;

        // Insira os detalhes da compra no banco de dados
        $inserirCompra = "INSERT INTO Compras (CodProduto, Quantidade, NomeCliente, EnderecoEntrega, FormaPagamento, Valor) VALUES ('$CodProduto', '$quantidade', '$nomeCliente', '$endereco', '$formaPagamento', '$valorBoleto')";

        if (mysqli_query($conexaoid, $inserirCompra)) {
            // A compra foi concluída com sucesso

            if ($formaPagamento == "paypal") {
                // Inclua a biblioteca PHP QR Code
                include_once(__DIR__ . '/../../../vendor/chillerlan/php-qrcode/src/QRCode.php');
                
                // URL do PayPal (substitua pelo URL correto)
                $urlPaypal = "https://www.paypal.com";
                
                // Gere o QR code
                QRcode::png('PHP QR Code :)');
            }
            
            
            elseif ($formaPagamento == "boleto") {
                // Gere o boleto bancário
                // Aqui você deve implementar a lógica para gerar o boleto bancário
                // Pode usar uma biblioteca como 'BoletoPHP' para gerar boletos

                // Exemplo: Gere um boleto simples
                echo "Boleto gerado para pagamento de R$ $valorBoleto";
            } elseif ($formaPagamento == "cartao_credito") {
                // Abra um formulário para inserção de informações do cartão de crédito
                echo '
                <form action="processar_cartao_credito.php" method="post">
                    <!-- Campos para informações do cartão -->
                    <label for="numero_cartao">Número do Cartão:</label>
                    <input type="text" name="numero_cartao" id="numero_cartao" required>
                    <!-- Outros campos e detalhes do cartão -->
                    <button type="submit">Finalizar Pagamento com Cartão</button>
                </form>';
            } else {
                echo "Método de pagamento não reconhecido.";
            }
        } else {
            echo "Erro ao processar a compra: " . mysqli_error($conexaoid);
        }
    } else {
        echo "Erro ao consultar o produto: " . mysqli_error($conexaoid);
    }

    mysqli_close($conexaoid);
} else {
    echo "O formulário não foi enviado corretamente.";
}
?>
    </main>
    <footer>
        <!-- Adicione links ou informações adicionais no rodapé conforme necessário -->
    </footer>
</body>

</html>
