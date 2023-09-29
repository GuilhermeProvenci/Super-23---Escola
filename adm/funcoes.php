<?php
function listarRegistros($tabela, $conexaoid) {
    // Pega a página atual
    $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;

    $query = "SELECT * FROM $tabela";
    $resultado = mysqli_query($conexaoid, $query) or die("Não foi possível selecionar o banco");
    $total = mysqli_num_rows($resultado); // Total de registros
    $lpp = 10; // Linhas por página
    $paginas = ceil($total / $lpp);

    if ($pagina < 1) {
        $pagina = 1;
    } elseif ($pagina > $paginas) {
        $pagina = $paginas;
    }

    $inicio = ($pagina - 1) * $lpp;
    $query = "SELECT * FROM $tabela LIMIT $inicio, $lpp";
    $resultado = mysqli_query($conexaoid, $query);

    print("<h1>LISTA DE " . strtoupper($tabela) . "</h1>");
    print("<BR><font color=red><B>$tabela</b></font><BR>");
    print("<center><br><table border=1>");
    print("<tr>");

    //pega os nomes das colunas da tabela e criando cabeçalhos da table html
    $colunas = [];
    while ($info_coluna = mysqli_fetch_field($resultado)) {
        $coluna_nome = $info_coluna->name;
        $colunas[] = $coluna_nome;
        print("<th>$coluna_nome</th>");
    }
    
    print("<th>Ações</th>");
    print("</tr>");

    while ($registros = mysqli_fetch_array($resultado)) {
        print("<tr>");
        foreach ($colunas as $coluna) {
            print("<td>{$registros[$coluna]}</td>");
        }
        
        $idCampo = $colunas[0]; //na teoria o priemrio cmapo é o id
        print("<td><a href=validar_{$tabela}.php?$idCampo={$registros[$idCampo]}>Validar</a> | <a href=edt_{$tabela}.php?$idCampo={$registros[$idCampo]}>Editar</a> | <a href=del_{$tabela}.php?$idCampo={$registros[$idCampo]}>Excluir</a></td>");
        print("</tr>");
    }
    print("</table></center>");

    #region MOVIMENTAÇÃO
    if ($pagina > 1) {
        $anterior = $pagina - 1;
        $link_anterior = "?pagina=$anterior";
        print("<a href='$link_anterior'>Anterior</a>");
    }
    for ($cont = 1; $cont <= $paginas; $cont++) {
        $link = "?pagina=$cont";
        print(" | <a href='$link'>$cont</a>");
    }
    if ($pagina < $paginas) {
        $proxima = $pagina + 1;
        $link_proxima = "?pagina=$proxima";
        print(" | <a href='$link_proxima'>Próxima</a>");
    }

    print(" | <a href='opcoes.html'>Voltar</a>");

    #endregion
}
?>
