<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorias</title>
    <link rel="stylesheet" type="text/css" href="../css_avulsos/lista-registros.css" />
    
</head>
<body>
    <header>
        <h1>Lista de Categorias</h1>
    </header>
    <main>
    <?php
include("../conexao.php");
include("funcoes.php");
$opcoesPersonalizadas = array("Excluir");
listarRegistros("categorias", $conexaoid, $opcoesPersonalizadas);
?>

    </main>
    <footer>
        <a href="./opcoes.html">Voltar para a página inicial</a>
    </footer>
</body>
</html>
