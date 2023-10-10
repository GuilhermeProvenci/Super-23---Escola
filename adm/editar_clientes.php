<html>
<head>
<title>Edição de cliente</title>
<link rel="stylesheet" type="text/css" href="../css_avulsos/compra-style.css" />
</head>
<body>
<?php
include("../conexao.php");
$CodCliente = $_GET['CodCliente'];
$query = "SELECT * FROM clientes WHERE CodCliente = '$CodCliente'";
$resultado = mysqli_query($conexaoid, $query) or die("Não foi possível selecionar o usuário");
$registro = mysqli_fetch_array($resultado);
?>
<form name="form1" method="post" action="edt_cliente1.php">
<table width="75%" border="0" align="center" cellpadding="1" cellspacing="3">
<tr align="center">
<td colspan="2">Atualizar cliente</td>
<td><input name="CodCliente" type="hidden" value="<?php echo $CodCliente; ?>"></td>
</tr>
<tr>
<td width="50%" align="right">Nome:</td>
<td width="50%"><input name="Nome" id="Nome" type="text" value="<?php echo $registro['Nome']; ?>"></td>
</tr>
<HR>
<tr><td width="50%" align="right">Cidade:</td>
<td width="50%"><input name="Cidade" id="Cidade" type="text" value="<?php echo $registro['Cidade']; ?>"></td>
</tr>
<tr><td width="50%" align="right">Estado:</td>
<td width="50%"><select name="Estado" id="Estado">
    <option value="SC" <?php if ($registro['Estado'] == 'SC') echo 'selected'; ?>>SC</option>
    <option value="PR" <?php if ($registro['Estado'] == 'PR') echo 'selected'; ?>>PR</option>
    <option value="RS" <?php if ($registro['Estado'] == 'RS') echo 'selected'; ?>>RS</option>
    <option value="SP" <?php if ($registro['Estado'] == 'SP') echo 'selected'; ?>>SP</option>
    <option value="RJ" <?php if ($registro['Estado'] == 'RJ') echo 'selected'; ?>>RJ</option>
    <option value="MG" <?php if ($registro['Estado'] == 'MG') echo 'selected'; ?>>MG</option>
</select></td></tr>

<tr><td width="50%" align="right">Email:</td>
<td width="50%"><input name="Email" id="Email" type="text" value="<?php echo $registro['Email']; ?>"></td>  </tr>
<tr><td width="50%" align="right">Login:</td>
<td width="50%"><input name="LoginUsuario" id="Login" type="text" value="<?php echo $registro['Login']; ?>"></td>  </tr>

<tr><td width="50%" align="right">Senha:</td>
<td width="50%"><input name="SenhaUsuario" id="Senha" type="text" value="<?php echo $registro['Senha']; ?>"></td>   </tr>

<tr> <td align="right">&nbsp</td>
<td width="50%">
<button>Salvar <input name="Salvar" id="salvar" type="submit" value="Salvar" style="display : none"></button>
<button>Limpar <input name="Limpar" id="limpar" type="reset" value="Limpar" style="display : none"></td></tr></button>
 </table>
 </form>
 <HR>
</body>
<html>
