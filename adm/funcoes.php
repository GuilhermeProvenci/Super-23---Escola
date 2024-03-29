<?php
function listarRegistros($tabela, $conexaoid, $opcoes = array(), $camposDesejados = array(), $camposNaoDesejados = array())
{
    // Pega a página atual
    $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;

    // Monta a lista de campos desejados ou utiliza '*' para todos os campos
    $camposQuery = '*';
    if (!empty($camposDesejados)) {
        $camposQuery = implode(", ", $camposDesejados);
    }

    $query = "SHOW COLUMNS FROM $tabela";
    $resultadoColunas = mysqli_query($conexaoid, $query);
    $colunasTabela = array();

    while ($coluna = mysqli_fetch_assoc($resultadoColunas)) {
        $colunasTabela[] = $coluna['Field'];
    }

    $colunasSelecionadas = array();
    foreach ($colunasTabela as $coluna) {
        if (empty($camposNaoDesejados) || !in_array($coluna, $camposNaoDesejados)) {
            $colunasSelecionadas[] = $coluna;
        }
    }

    // Monta a lista de campos não desejados para filtrar da consulta
    $camposNaoDesejadosQuery = '';
    if (!empty($camposNaoDesejados)) {
        $camposNaoDesejadosQuery = implode(", ", $camposNaoDesejados);
        $query = "SELECT " . implode(", ", $colunasSelecionadas) . " FROM $tabela";
    } else {
        $query = "SELECT " . implode(", ", $colunasSelecionadas) . " FROM $tabela";
    }

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

    if (!empty($camposNaoDesejados)) {
        $query = "SELECT " . implode(", ", $colunasSelecionadas) . " FROM $tabela LIMIT $inicio, $lpp";
    } else {
        $query = "SELECT " . implode(", ", $colunasSelecionadas) . " FROM $tabela LIMIT $inicio, $lpp";
    }

    $resultado = mysqli_query($conexaoid, $query);
    // Imprima a abertura da tabela com a classe "lista-registros"
    print("<h1>LISTA DE " . strtoupper($tabela) . "</h1>");
    print("<BR><font color=red><B>$tabela</b></font><BR>");
    print("<center><br><table class='lista-registros' border=1>");
    print("<tr>");
    // Pega os nomes das colunas da tabela e cria cabeçalhos da tabela HTML
    $colunas = $colunasSelecionadas;
    foreach ($colunas as $coluna) {
        if (empty($camposDesejados) || in_array($coluna, $camposDesejados)) {
            print("<th>$coluna</th>");
        }
    }
    foreach ($opcoes as $opcao) {
        print("<th>$opcao</th>");
    }
    print("</tr>");
    while ($registros = mysqli_fetch_array($resultado)) {
        print("<tr>");
        foreach ($colunas as $coluna) {
            if (empty($camposDesejados) || in_array($coluna, $camposDesejados)) {
                print("<td>{$registros[$coluna]}</td>");
            }
        }
        $idCampo = $colunas[0]; // Na teoria, o primeiro campo é o ID
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
    #endregion
}




function criarFormularioCadastro($tabela, $conexaoid, $inputTypes = array(), $camposDesejados = array(), $camposNaoDesejados = array(), $readonlyCampos = array())
{
    // Obtenha os nomes das colunas da tabela
    $query = "SHOW COLUMNS FROM $tabela";
    $resultado = mysqli_query($conexaoid, $query);

    if ($resultado) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<div class='form-container'><form method='post' action=''>";

            // Inicialize a variável $colunas e $valores
            $colunas = array();
            $valores = array();

            while ($row = mysqli_fetch_assoc($resultado)) {
                $nomeColuna = $row['Field'];

                // Verifique se o campo deve ser incluído ou excluído
                if (!empty($camposDesejados) && !in_array($nomeColuna, $camposDesejados)) {
                    continue;
                }

                // Verifique se o campo deve ser excluído
                if (in_array($nomeColuna, $camposNaoDesejados)) {
                    continue;
                }

                // Verifique se o campo deve ser apenas leitura (readonly)
                $readonly = in_array($nomeColuna, $readonlyCampos) ? "readonly" : "";

                // Determine o tipo de input com base no array $inputTypes
                $inputType = isset($inputTypes[$nomeColuna]) ? $inputTypes[$nomeColuna] : "text";

                if ($inputType === 'password') {
                    $senha = $_POST[$nomeColuna];
                    $hashSenha = password_hash($senha, PASSWORD_DEFAULT);
                    $colunas[] = $nomeColuna;
                    $valores[] = "'" . mysqli_real_escape_string($conexaoid, $hashSenha) . "'";
                } else {
                    $colunas[] = $nomeColuna;
                    $valores[] = "'" . mysqli_real_escape_string($conexaoid, $_POST[$nomeColuna]) . "'";
                }

                // Crie o input com base no tipo definido
                echo "<div class='form-group'>";
                echo "<label for='$nomeColuna'>$nomeColuna:</label>";
                echo "<input type='$inputType' name='$nomeColuna' id='$nomeColuna' value='{$_POST[$nomeColuna]}' $readonly required>";
                echo "</div>";
            }

            // Construa a lista de colunas para o comando SQL
            $colunasQuery = implode(", ", $colunas);
            // Construa a lista de valores para o comando SQL
            $valoresQuery = implode(", ", $valores);

            // Construa a consulta SQL completa
            $inserirQuery = "INSERT INTO $tabela ($colunasQuery) VALUES ($valoresQuery)";

            // Depurar a consulta SQL gerada
            // echo "Consulta SQL: $inserirQuery";

            // Execute a consulta de inserção
            $resultadoInserir = mysqli_query($conexaoid, $inserirQuery);

            if ($resultadoInserir) {
                // Obtenha o nome do arquivo PHP atual
                $nomeArquivo = basename($_SERVER['PHP_SELF']);

                // Redirecione para a mesma página com o novo código
                $proximoCodigo = obterProximoCodigoDisponivel($tabela, $conexaoid);
                echo "<script>window.location.href='$nomeArquivo?codigo=$proximoCodigo';</script>";
                exit();
            } else {
                echo "<p>Erro ao inserir os dados: " . mysqli_error($conexaoid) . "</p>";
            }

            echo "</form></div>";

        } else {
            // Se o formulário não foi submetido, exiba o formulário
            echo "<div class='form-container'><form method='post' action=''>";

            while ($row = mysqli_fetch_assoc($resultado)) {
                $nomeColuna = $row['Field'];

                // Verifique se o campo deve ser incluído ou excluído
                if (!empty($camposDesejados) && !in_array($nomeColuna, $camposDesejados)) {
                    continue;
                }

                // Verifique se o campo deve ser excluído
                if (in_array($nomeColuna, $camposNaoDesejados)) {
                    continue;
                }

                // Verifique se o campo deve ser apenas leitura (readonly)
                $readonly = in_array($nomeColuna, $readonlyCampos) ? "readonly" : "";

                // Determine o tipo de input com base no array $inputTypes
                $inputType = isset($inputTypes[$nomeColuna]) ? $inputTypes[$nomeColuna] : "text";

                // Obtenha o nome da coluna do ID singular com base no nome da tabela plural
                $nomeColunaId = "Cod" . ucfirst(substr($tabela, 0, -1));

                // Se o nome da coluna for a coluna do ID, preencha com o valor obtido
                if ($nomeColuna === $nomeColunaId) {
                    $proximoCodigo = obterProximoCodigoDisponivel($tabela, $conexaoid);
                    echo "<div class='form-group'>";
                    echo "<label for='$nomeColuna'>$nomeColuna:</label>";
                    echo "<input type='$inputType' name='$nomeColuna' id='$nomeColuna' value='$proximoCodigo' $readonly required>";
                    echo "</div>";
                } else {
                    // Obtenha o tamanho máximo da coluna a partir do banco de dados
                    $tamanhoMaximo = obterTamanhoMaximoColuna($tabela, $nomeColuna, $conexaoid);

                    echo "<div class='form-group'>";
                    echo "<label for='$nomeColuna'>$nomeColuna:</label>";
                    echo "<input type='$inputType' name='$nomeColuna' id='$nomeColuna' $readonly required maxlength='$tamanhoMaximo'>";
                    echo "</div>";
                }
            }

            echo "<input type='submit' name='Salvar' value='Salvar' class='btn-submit'>";

            echo "</form></div>";
        }
    } else {
        echo "<p>Erro ao criar o formulário de cadastro: " . mysqli_error($conexaoid) . "</p>";
    }
}


function obterTamanhoMaximoColuna($tabela, $coluna, $conexaoid)
{
    $query = "SELECT CHARACTER_MAXIMUM_LENGTH
              FROM information_schema.COLUMNS
              WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = '$tabela'
              AND COLUMN_NAME = '$coluna'";
    $resultado = mysqli_query($conexaoid, $query);

    if ($resultado && $row = mysqli_fetch_assoc($resultado)) {
        return $row['CHARACTER_MAXIMUM_LENGTH'];
    }

    return 255; // Valor padrão se a consulta falhar
}


function obterProximoCodigoDisponivel($tabela, $conexaoid)
{
    $query = "SELECT AUTO_INCREMENT
              FROM information_schema.TABLES
              WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = '$tabela'";
    $resultado = mysqli_query($conexaoid, $query);

    if ($resultado && $row = mysqli_fetch_assoc($resultado)) {
        return $row['AUTO_INCREMENT'];
    }

    return 1; // Valor padrão se a consulta falhar
}


