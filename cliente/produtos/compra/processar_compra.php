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

                if ($formaPagamento == "PIX") {
                    // Aqui você deve configurar as informações para a transação PIX
                    $chavePIX = "46999230911"; // Substitua com a sua chave PIX
                    // $descricao = "Compra de produtos"; // Descrição opcional
                    $valorPIX = $valorBoleto;

                    // Construa os dados do PIX
                    $dadosPIX = "000201"; // Prefixo comum
                    $dadosPIX .= "2614BR.GOV.BCB.PIX"; // Identificador PIX do Banco Central
                    $dadosPIX .= "0105$chavePIX"; // Chave PIX
                    $dadosPIX .= "5303" . str_pad(strlen($valorPIX), 2, "0", STR_PAD_LEFT) . $valorPIX; // Valor da transação
                    $dadosPIX .= "5403BR" . str_pad(strlen($chavePIX), 2, "0", STR_PAD_LEFT) . $chavePIX; // Nome do beneficiário
                    $dadosPIX .= "5802BR"; // País
                    $dadosPIX .= "5913$chavePIX"; // Identificador único do beneficiário
                    $dadosPIX .= "6011"; // Descrição
                    $dadosPIX .= "62070503"; // Uso interno do banco
        
                    // Aqui você gera o QR Code PIX
                    require_once(__DIR__ . '/../../../vendor/chillerlan/phpqrcode/qrlib.php');
                    $path = __DIR__ . '/../../../teste';
                    $qrcode = $path . time() . '.png';
                    QRcode::png($dadosPIX, $qrcode);

                    // Exibe a imagem do QR Code
                    echo '<img src="/Super23/Super-23---Escola/' . substr($qrcode, strpos($qrcode, 'teste')) . '">';
                } elseif ($formaPagamento == "boleto") {
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