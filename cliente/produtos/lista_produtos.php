<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" type="text/css" href="../../css_avulsos/lista-registros.css" />
</head>

<body>
    <header>
        <h1></h1>
    </header>
    <main>
        <?php
        include("../../conexao.php");
        include("../../adm/funcoes.php");
        $opcoesPersonalizadas = array("compra/cliente_compra");
        $camposDesejados = array();
        $camposNaoDesejados = array("Categoria");
        listarRegistros("produtos", $conexaoid, $opcoesPersonalizadas, $camposDesejados,$camposNaoDesejados );

        ?>
    </main>
    <footer>
        <br><br><br>
        <button class="menu-link"><a href="lista_produtos.php" class="menu-link">Recarregar</a></button>
    </footer>
</body>

</html>