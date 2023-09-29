<html>
<head>
<title>Atualização de Produto</title>
</head>
<body>
<?php
include("../conexao.php");

$CodProduto = $_POST["CodProduto"];
$Nome = $_POST["Nome"];
$Categoria = $_POST["Categoria"];
$Valor = $_POST["Valor"];

if (isset($_POST["Salvar"])) {
    $query = "UPDATE produtos SET Nome='$Nome', Categoria='$Categoria', Valor='$Valor' WHERE CodProduto='$CodProduto'";
    $resultado = mysqli_query($conexaoid, $query) or die("Não foi possível atualizar o produto");

    if ($resultado) {
        print("<BR>Produto $Nome atualizado com sucesso");
    } else {
        die("Não foi possível atualizar o produto");
    }
}
?>
</body>
<a href=opcoes.html><br>Opções do Administrador</a>
</html>
