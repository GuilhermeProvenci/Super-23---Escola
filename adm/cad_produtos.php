<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produtos</title>
</head>
<body>
    <h1>Cadastro de Produtos</h1>

    <?php
    include("funcoes.php");
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("../conexao.php");

        $CodProduto = $_POST["CodProduto"];
        $Categoria = $_POST["Categoria"];
        $nome = $_POST["nome"];
        $valor = $_POST["valor"];

        // Verifica se os campos obrigatórios foram preenchidos
        if (!empty($CodProduto) && !empty($Categoria) && !empty($nome) && !empty($valor)) {
            // Insere os dados no banco de dados
            $query = "INSERT INTO produtos (CodProduto, Categoria, nome, valor) ";
            $query .= "VALUES ('$CodProduto', '$Categoria', '$nome', '$valor')";

            $resultado = mysqli_query($conexaoid, $query);

            if ($resultado) {
                echo "<p>Produto adicionado com sucesso.</p>";
            } else {
                echo "<p>Erro ao cadastrar o produto: " . mysqli_error($conexaoid) . "</p>";
            }
        } else {
            echo "<p>Todos os campos são obrigatórios.</p>";
        }
    }

    $nomeTabela = "produtos";
    $camposDesejados = array();
    $camposReadonly = array("CodProdutos");
    criarFormularioCadastro($nomeTabela, $conexaoid, $camposDesejados, $camposReadonly);

    ?>

    <form method="post" action="cad_produtos.php">
        <label for="CodProduto">Código do Produto:</label>
        <input type="text" name="CodProduto" id="CodProduto" required><br>

        <label for="Categoria">Categoria:</label>
        <input type="text" name="Categoria" id="Categoria" required><br>

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br>

        <label for="valor">Valor:</label>
        <input type="text" name="valor" id="valor" required><br>

        <input type="submit" name="Salvar" value="Salvar">
    </form>

    <br>
    <a href="./opcoes.html">Voltar para a página inicial</a>
</body>
</html>
