<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" type="text/css" href="../css_avulsos/lista-registros.css" /> 
</head>
<body>
    <header>
        <h1>Lista de Clientes</h1>
    </header>
    <main>
        <?php
        include("../conexao.php");
        include("funcoes.php");
        $opcoesPersonalizadas = array("Validar", "Editar", "Excluir");
        listarRegistros("clientes", $conexaoid, $opcoesPersonalizadas);
        ?>
    </main>
    <footer>
        <a href="../funcoes/gerar-pdf.php?tabela=Clientes">Gerar PDF</a>
        <a href="./opcoes.html">Voltar para a página inicial</a>
    </footer>
</body>
</html>
