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
        $camposDesejados = array();
        $camposNaoDesejados = array("Senha");
        listarRegistros("clientes", $conexaoid, $opcoesPersonalizadas, $camposDesejados, $camposNaoDesejados);

        // Listar todos os campos da tabela
//    listarRegistros('minha_tabela', $conexaoid);
// Listar apenas os campos 'campo1' e 'campo2'
//    listarRegistros('minha_tabela', $conexaoid, array(), array('campo3', 'campo4'));
// Listar todos os campos, exceto 'campo3' e 'campo4'
//    listarRegistros('minha_tabela', $conexaoid, array(), array(), array('campo3', 'campo4'));
        
        // o mais intuitivo na minha opiniao ´e definir no array os campos que voce quer, mas pode passar direto aqui, 
//e os campos tem que estar com o nome igual estpa no banco de daods 
        ?>
    </main>
    <footer>
        <a href="../funcoes/gerar-pdf.php?tabela=Clientes">Gerar PDF</a><br><br>
        <a href="./opcoes.html">Voltar para a página inicial</a>
    </footer>
</body>

</html>