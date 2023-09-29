<?php
function listarRegistros($tabela, $conexaoid, $opcoes = array()) {
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

    foreach ($opcoes as $opcao) {
        print("<th>$opcao</th>");
    }
    
    print("</tr>");

    while ($registros = mysqli_fetch_array($resultado)) {
        print("<tr>");
        foreach ($colunas as $coluna) {
            print("<td>{$registros[$coluna]}</td>");
        }
        
        $idCampo = $colunas[0]; // na teoria o primeiro campo é o id
        
        foreach ($opcoes as $opcao) {
            $opcaoLink = strtolower($opcao);
            print("<td><a href={$opcaoLink}_{$tabela}.php?$idCampo={$registros[$idCampo]}>$opcao</a></td>");
        }
        
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

// function criarFormularioCadastro($tabela, $conexaoid, $camposDesejados = array(), $readonlyCampos = array()) {
//     // Obtenha os nomes das colunas da tabela
//     $query = "SHOW COLUMNS FROM $tabela";
//     $resultado = mysqli_query($conexaoid, $query);

//     if ($resultado) {
//         echo "<form method='post' action='cad_$tabela.php'>";
//         while ($row = mysqli_fetch_assoc($resultado)) {
//             $nomeColuna = $row['Field'];
            
//             // Verifique se o campo deve ser incluído ou excluído
//             if (!empty($camposDesejados) && !in_array($nomeColuna, $camposDesejados)) {
//                 continue;
//             }
            
//             // Verifique se o campo deve ser apenas leitura (readonly)
//             $readonly = in_array($nomeColuna, $readonlyCampos) ? "readonly" : "";

//             echo "<label for='$nomeColuna'>$nomeColuna:</label>";
//             echo "<input type='text' name='$nomeColuna' id='$nomeColuna' $readonly required><br>";
//         }
//         echo "<input type='submit' name='Salvar' value='Salvar'>";
//         echo "</form>";
//     } else {
//         echo "<p>Erro ao criar o formulário de cadastro: " . mysqli_error($conexaoid) . "</p>";
//     }
// }

function criarFormularioCadastro($tabela, $conexaoid, $camposDesejados = array(), $readonlyCampos = array()) {
    // Obtenha os nomes das colunas da tabela
    $query = "SHOW COLUMNS FROM $tabela";
    $resultado = mysqli_query($conexaoid, $query);

    if ($resultado) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Se o formulário foi submetido, execute a inserção de dados
            $inserirQuery = "INSERT INTO $tabela (";
            $valores = array();
            
            while ($row = mysqli_fetch_assoc($resultado)) {
                $nomeColuna = $row['Field'];

                // Verifique se o campo deve ser incluído ou excluído
                if (!empty($camposDesejados) && !in_array($nomeColuna, $camposDesejados)) {
                    continue;
                }

                // Verifique se o campo deve ser apenas leitura (readonly)
                $readonly = in_array($nomeColuna, $readonlyCampos) ? "readonly" : "";

                echo "<label for='$nomeColuna'>$nomeColuna:</label>";
                echo "<input type='text' name='$nomeColuna' id='$nomeColuna' $readonly required><br>";

                // Construa a lista de colunas e valores para a inserção
                $inserirQuery .= "$nomeColuna, ";
                $valores[] = "'" . mysqli_real_escape_string($conexaoid, $_POST[$nomeColuna]) . "'";
            }

            // Remova a vírgula extra no final da lista de colunas
            $inserirQuery = rtrim($inserirQuery, ", ") . ") VALUES (" . implode(", ", $valores) . ")";

            // Execute a consulta de inserção
            $resultadoInserir = mysqli_query($conexaoid, $inserirQuery);

            if ($resultadoInserir) {
                echo "<p>Dados inseridos com sucesso.</p>";
            } else {
                echo "<p>Erro ao inserir os dados: " . mysqli_error($conexaoid) . "</p>";
            }
        } else {
            // Se o formulário não foi submetido, exiba o formulário
            echo "<form method='post' action=''>";
            
            while ($row = mysqli_fetch_assoc($resultado)) {
                $nomeColuna = $row['Field'];

                // Verifique se o campo deve ser incluído ou excluído
                if (!empty($camposDesejados) && !in_array($nomeColuna, $camposDesejados)) {
                    continue;
                }

                // Verifique se o campo deve ser apenas leitura (readonly)
                $readonly = in_array($nomeColuna, $readonlyCampos) ? "readonly" : "";

                echo "<label for='$nomeColuna'>$nomeColuna:</label>";
                echo "<input type='text' name='$nomeColuna' id='$nomeColuna' $readonly required><br>";
            }

            echo "<input type='submit' name='Salvar' value='Salvar'>";
            echo "</form>";
        }
    } else {
        echo "<p>Erro ao criar o formulário de cadastro: " . mysqli_error($conexaoid) . "</p>";
    }
}



