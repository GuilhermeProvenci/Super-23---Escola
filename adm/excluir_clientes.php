<html>
<head>
<title>Exclusão de cliente</title>
</head>
<body>
<?php
include("../conexao.php");

// Verifique se o parâmetro CodCliente foi passado via GET
if(isset($_GET['CodCliente'])){
    $CodCliente = $_GET['CodCliente'];
    
    // Consulta para obter os detalhes do cliente
    $query = "SELECT * FROM clientes WHERE CodCliente='$CodCliente'";
    $resultado = mysqli_query($conexaoid, $query);

    // Verifique se a consulta foi bem-sucedida
    if($resultado){
        $registro = mysqli_fetch_array($resultado);
    } else {
        die("Não foi possível selecionar o cliente");
    }
} else {
    die("Código do cliente não fornecido");
}
?>
<form name="form1" method="post" action="del_cliente1.php">
<table width="75%" border="0" align="center" cellpadding="1" cellspacing="3">
<tr>
<td colspan="2"><div align="center">Exclusão de Clientes</div></td>
</tr>
<tr>
<td width="50%" align="right">Código:</td>
<td width="50%"><input name="CodCliente" type="text" id="CodCliente" value="<?php echo $CodCliente; ?>" readonly="true"></td>
</tr>
<tr>
<td width="50%" align="right">Nome:</td>
<td width="50%"><input name="Nome" type="text" id="Nome" value="<?php echo $registro['Nome']; ?>"></td>
</tr>
<tr>
<td width="50%" align="right"> &nbsp; </td>
<td width="50%"><input name="Excluir" type="submit" id="excluir" value="Excluir">
<input type="button" value="Voltar" OnClick="window.location='lista_clientes.php'">
</td>
</tr>
</table>
</form>
<a href=opcoes.html>Opções do ADM</a>
</body>
</html>
