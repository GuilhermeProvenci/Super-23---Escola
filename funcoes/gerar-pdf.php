<?php
require_once __DIR__ . '/../vendor/autoload.php';

include("../conexao.php");

use Dompdf\Dompdf;
use Dompdf\Options;

// Função para gerar o PDF
function imprimirTabelaComoPDF($tabela, $conexao)
{
    $query = "SELECT * FROM $tabela";
    $resultado = mysqli_query($conexao, $query);

    // Crie uma nova instância DOMPDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    // Carregue o HTML no DOMPDF
    $html = "<h1>Tabela de " . strtoupper($tabela) . "</h1>";
    $html .= "<style>
    .lista-registros {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .lista-registros th,
    .lista-registros td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .lista-registros th {
        background-color: rgba(6, 126, 245, 0.849);
        color: #fff;
        font-weight: bold;
    }

</style>";
    $html .= "<table class='lista-registros' border='1'>";


    // Adicione cabeçalhos das colunas
    $html .= "<tr>";
    while ($coluna = mysqli_fetch_field($resultado)) {
        $html .= "<th>{$coluna->name}</th>";
    }
    $html .= "</tr>";

    // Adicione dados das linhas
    while ($registro = mysqli_fetch_assoc($resultado)) {
        $html .= "<tr>";
        foreach ($registro as $valor) {
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

    $conexao = mysqli_connect('localhost', 'root', '', 'escola');

    if (!$conexao) {
        die('Erro na conexão: ' . mysqli_connect_error());
    }

    imprimirTabelaComoPDF($tabela, $conexao);
} else {
    // Se o parâmetro "tabela" não estiver definido, redirecione de volta para a página principal
    header("Location: lista-registros.php");
    exit;
}
?>