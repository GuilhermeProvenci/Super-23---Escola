<html>
<body>
<?php
include("../conexao.php");

$LoginUsuario = $_POST["LoginUsuario"];
$SenhaUsuario = $_POST["SenhaUsuario"];
$Nome = $_POST["Nome"];
$Cidade = $_POST["Cidade"];
$Estado = $_POST["Estado"];
$Email = $_POST["Email"];
$CodCliente = $_POST["CodCliente"];

if ($_POST["Salvar"]) {
    $query = "UPDATE clientes SET Nome='$Nome', Cidade='$Cidade', Estado='$Estado', Email='$Email', Login='$LoginUsuario', Senha='$SenhaUsuario' WHERE CodCliente='$CodCliente'";
    $resultado = mysqli_query($conexaoid, $query) or die("Não foi possível atualizar");

    if ($resultado) {
        print("<BR>cliente $Nome alterado com sucesso");
    } else {
        die("Não foi possível atualizar o cliente");
    }
}
?>
</body>
<a href=opcoes.html><br>Opções do Administrador</a>
</html>
