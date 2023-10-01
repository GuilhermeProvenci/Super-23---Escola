<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuários</title>
</head>
<body>
    <h1>Cadastro de Usuários</h1>
    <?php
include("../conexao.php");
include("funcoes.php");
$nomeTabela = "clientes";
$camposDesejados = array();
$camposNaoDesejados = array(); 
$camposReadonly = array("CodCliente");
criarFormularioCadastro($nomeTabela, $conexaoid, $camposDesejados, $camposNaoDesejados, $camposReadonly);
?>
    <br>
    <a href="./opcoes.html">Voltar para a página inicial</a>
</body>
</html>

