<html>
<head>
<title>Edição de Produto</title>
</head>
<body>
<?php
include("../conexao.php");
$CodProduto = $_GET['CodProduto'];
$query = "SELECT * FROM produtos WHERE CodProduto = '$CodProduto'";
$resultado = mysqli_query($conexaoid, $query) or die("Não foi possível selecionar o produto");
$registro = mysqli_fetch_array($resultado);
?>
<form name="form1" method="post" action="edt_produt1.php">
<table width="75%" border="0" align="center" cellpadding="1" cellspacing="3">
<tr align="center">
<td colspan="2">Atualizar Produto</td>
<td><input name="CodProduto" type="hidden" value="<?php echo $CodProduto; ?>"></td>
</tr>
<tr>
<td width="50%" align="right">Nome:</td>
<td width="50%"><input name="Nome" id="Nome" type="text" value="<?php echo $registro['Nome']; ?>"></td>
</tr>
<HR>
<tr>
<td width="50%" align="right">Categoria:</td>
<td width="50%"><input name="Categoria" id="Categoria" type="text" value="<?php echo $registro['Categoria']; ?>"></td>
</tr>
<tr>
<td width="50%" align="right">Valor:</td>
<td width="50%"><input name="Valor" id="Valor" type="text" value="<?php echo $registro['Valor']; ?>"></td>
</tr>

<tr> <td align="right">&nbsp</td>
<td width="50%">
<input name="Salvar" id="salvar" type="submit" value="Salvar">
<input name="Limpar" id="limpar" type="reset" value="Limpar"></td></tr>
 </table>
 </form>
 <HR>
</body>
<html>
