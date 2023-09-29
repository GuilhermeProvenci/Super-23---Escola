<?php
$CodCliente = $_POST["CodCliente"];
$Nome = $_POST["Nome"];

if ($_POST['Excluir']) {
    include("../conexao.php");
    $query = "delete from clientes where CodCliente='$CodCliente'";
    $resultado = mysqli_query($conexaoid, $query) or die ("Não foi possível excluir");

    if ($resultado) {
        print("cliente $Nome excluído<BR>");
    }
}
print("<a href='./lista_cliente.php'>Opções de adm</a>");
?>
