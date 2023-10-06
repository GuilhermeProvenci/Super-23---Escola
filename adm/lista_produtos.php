<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" type="text/css" href="../css_avulsos/lista-registros.css" />
</head>
<body>
    <h1>Cadastro de Produtos</h1>
    <?php
    include("../conexao.php");
    include("funcoes.php");
    $opcoesPersonalizadas = array("Editar", "Excluir");
    listarRegistros("produtos", $conexaoid, $opcoesPersonalizadas);
    ?>
    <br>
    <footer>
        <a href="../funcoes/gerar-pdf.php?tabela=Produtos">Gerar PDF</a>
        <a href="./opcoes.html">Voltar para a página inicial</a>
    </footer>
</body>
</html>
