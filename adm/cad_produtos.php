<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produtos</title>
</head>
<body>
    <h1>Cadastro de Produtos</h1>
    <?php
    include("funcoes.php");
    include("../conexao.php");
    $nomeTabela = "produtos";
    $camposDesejados = array();
    $camposNaoDesejados = array(); 
    $camposReadonly = array("CodProduto");
    criarFormularioCadastro($nomeTabela, $conexaoid, $camposDesejados, $camposNaoDesejados, $camposReadonly);
    ?>

    <br>
    <a href="./opcoes.html">Voltar para a página inicial</a>

    
</body>
</html>
