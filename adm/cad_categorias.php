<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Categorias</title>
    <link rel="stylesheet" type="text/css" href="../css_avulsos/cadastros.css" />
    
</head>
<body>
    <h1>Cadastro de Categorias</h1>
    <?php
    include("funcoes.php");
    include("../conexao.php");
    $nomeTabela = "Categorias";
    $camposDesejados = array();
    $camposNaoDesejados = array(); 
    $camposReadonly = array("CodCategoria");
    criarFormularioCadastro($nomeTabela, $conexaoid, $camposDesejados, $camposNaoDesejados, $camposReadonly);
    ?>

    <br>
    <a href="./opcoes.html">Voltar para a página inicial</a>

    
</body>
</html>
