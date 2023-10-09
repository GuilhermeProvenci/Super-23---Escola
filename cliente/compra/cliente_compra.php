<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arquivo de Compra</title>
  <link rel="stylesheet" type="text/css" href="seu-estilo.css">
</head>

<body>
  <header>
    <h1>Detalhes da Compra</h1>
  </header>
  <main>
    <?php
    // Lógica para buscar informações do produto selecionado no banco de dados e preencher os detalhes da compra
    $idProduto = isset($_GET['idProduto']) ? $_GET['idProduto'] : null;

    // Substitua esta lógica pela consulta ao banco de dados para obter os detalhes do produto com base no $idProduto
    $nomeProduto = "Nome do Produto";
    $precoProduto = "Preço do Produto";

    if ($idProduto) {
      echo "<h2>$nomeProduto</h2>";
      echo "<p>Preço: $precoProduto</p>";
      // Adicione mais detalhes conforme necessário
    } else {
      echo "<p>Produto não encontrado.</p>";
    }
    ?>
    <!-- Formulário para preencher os detalhes da compra -->
    <form id="compraForm" action="processar_compra.php" method="post">
      <input type="hidden" name="idProduto" value="<?php echo $idProduto; ?>">
      <label for="quantidade">Quantidade:</label>
      <input type="number" name="quantidade" id="quantidade" required>
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