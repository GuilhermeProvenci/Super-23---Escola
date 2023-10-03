<?php
require_once('../lib\dompdf\lib\Cpdf.php'); // Certifique-se de ajustar o caminho correto
include("../conexao.php");

use Dompdf\Dompdf;
use Dompdf\Options;

// Função para gerar o PDF
function imprimirTabelaComoPDF($tabela, $conexao, $opcoes = array()) {
    // Exclua as opções "Validar", "Editar" e "Excluir" da lista de opções
    $opcoesExcluir = array("Validar", "Editar", "Excluir");
    $opcoesFiltradas = array_diff($opcoes, $opcoesExcluir);

    $query = "SELECT * FROM $tabela";
    $resultado = mysqli_query($conexao, $query);

    // Crie uma nova instância DOMPDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    // Carregue o HTML no DOMPDF
    $html = "<h1>Tabela de " . strtoupper($tabela) . "</h1>";
    $html .= "<table border='1'>";
    $html .= "<tr>";

    foreach ($opcoesFiltradas as $opcao) {
        $html .= "<th>$opcao</th>";
    }

    $html .= "</tr>";

    while ($registro = mysqli_fetch_assoc($resultado)) {
        $html .= "<tr>";
        foreach ($opcoesFiltradas as $opcao) {
            $valor = $registro[$opcao];
            $html .= "<td>$valor</td>";
        }
        $html .= "</tr>";
    }

    $html .= "</table>";

    $dompdf->loadHtml($html);

    // Defina o tamanho do papel e a orientação (por exemplo, A4, retrato)
    $dompdf->setPaper('A4', 'portrait');

    // Renderize o PDF
    $dompdf->render();

    // Defina o nome do arquivo de saída (opcional)
    $nomeArquivo = "tabela_$tabela.pdf";

    // Saída do PDF para o navegador (ou salve em um arquivo)
    $dompdf->stream($nomeArquivo);
}

// Verifica se o parâmetro "tabela" foi fornecido
if (isset($_GET['tabela'])) {
    $tabela = $_GET['tabela'];

    // Substitua 'SEU_HOST', 'SEU_USUARIO', 'SUA_SENHA' e 'SEU_BANCO_DE_DADOS' pelas informações corretas
    $conexao = mysqli_connect('localhost', 'root', '', 'escola');

    if (!$conexao) {
        die('Erro na conexão: ' . mysqli_connect_error());
    }

    $opcoesPersonalizadas = array("Validar", "Editar", "Excluir");
    imprimirTabelaComoPDF($tabela, $conexao, $opcoesPersonalizadas);
} else {
    // Se o parâmetro "tabela" não estiver definido, redirecione de volta para a página principal
    header("Location: lista-registros.php");
    exit;
}
?>
