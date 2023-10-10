<!DOCTYPE html>
<html>

<head>
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" type="text/css" href="../css_avulsos/cadastros.css" />
</head>

<body>
    <h1>Cadastro de Usuários</h1>
    <?php
    include("../conexao.php");
    include("funcoes.php");
    $nomeTabela = "clientes";
    $camposDesejados = array();
    $camposNaoDesejados = array("Validado");
    $camposReadonly = array("CodCliente");
    criarFormularioCadastro($nomeTabela, $conexaoid, $camposDesejados, $camposNaoDesejados, $camposReadonly);
    ?>
    <br>
    <a href="./opcoes.html">Voltar para a página inicial</a>
</body>

</html>