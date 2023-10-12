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
        include("../../../conexao.php");


        // Lógica para buscar informações do produto selecionado no banco de dados
        $CodProduto = isset($_GET['CodProduto']) ? $_GET['CodProduto'] : null;

        // Verifique se o CodProduto foi fornecido na URL
        if ($CodProduto) {
            // Consulta SQL para obter informações do produto com base no CodProduto
            $consulta = "SELECT nome, valor FROM Produtos WHERE CodProduto = $CodProduto";
            $resultadoConsulta = mysqli_query($conexaoid, $consulta);

            // Verifique se a consulta foi bem-sucedida
            if ($resultadoConsulta) {
                $produto = mysqli_fetch_assoc($resultadoConsulta);
                $nomeProduto = $produto['nome'];
                $precoProduto = $produto['valor'];

                // Exiba as informações do produto
                echo "<h2>$nomeProduto</h2>";
                echo "<p>Preço: $precoProduto</p>";
                // Adicione mais detalhes conforme necessário
            } else {
                echo "<p>Erro ao consultar o produto.</p>";
            }
        } else {
            echo "<p>Produto não encontrado.</p>";
        }
        ?>
        <!-- Formulário para preencher os detalhes da compra -->
        <form id="compraForm" action="processar_compra.php" method="post">
            <input type="hidden" name="CodProduto" value="<?php echo $CodProduto; ?>">

            <label for="quantidade">Quantidade:</label>
            <input type="number" name="quantidade" id="quantidade" required>
            <br>

            <label for="nomeCliente">Nome do Cliente:</label>
            <input type="text" name="nomeCliente" id="nomeCliente" required>
            <br>

            <label for="endereco">Endereço de Entrega:</label>
            <textarea name="endereco" id="endereco" rows="4" cols="50" required></textarea>
            <br>

            <label for="formaPagamento">Forma de Pagamento:</label>
            <select name="formaPagamento" id="formaPagamento" required>
                <option value="cartao_credito">Cartão de Crédito</option>
                <option value="boleto">Boleto Bancário</option>
                <option value="PIX">Pix</option>
            </select>

            <br>
            <br>
            <!-- Adicione mais campos de acordo com os detalhes da compra -->
            <button type="submit">Finalizar Compra</button>
        </form>

    </main>
    <footer>
        <!-- Adicione links ou informações adicionais no rodapé conforme necessário -->
    </footer>
</body>

</html>