<html>
<head>
<title>Validação do Cliente</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php
include("..\conexao.php");
$CodCliente = isset($_GET["CodCliente"]) ? $_GET["CodCliente"] : (isset($_POST["CodCliente"]) ? $_POST["CodCliente"] : null);

$query = "SELECT * FROM Clientes WHERE CodCliente='$CodCliente'";
$resultado = mysqli_query($conexaoid, $query) or die("Não foi possível selecionar o usuário");
$registro = mysqli_fetch_array($resultado);
?>

<form name="form1" method="post" action="validar_clientes.php">
<table width="75%" border="0" align="center" cellpadding="1" cellspacing="3">
  <tr>
     <td width="50%" align="right">Código:</td>
     <td width="50%"><input name="CodCliente" id="CodCliente" readonly="true" value="<?php echo $CodCliente; ?>"></td>
  </tr>
  <tr>
    <td width="50%" align="right">Nome:</td>
    <td width="50%"><input name="nome" type="text" id="nome" readonly="true" value="<?php echo $registro["Nome"]; ?>"></td>
  </tr>
  <tr>
     <td align="right">Cidade:</td>
     <td><input name="cidade" type="text" id="cidade" readonly="true" value="<?php echo $registro["Cidade"]; ?>"></td>
  </tr>
  <tr>
     <td align="right">Estado:</td>
     <td><input name="estado" type="text" id="estado" readonly="true" value="<?php echo $registro["Estado"]; ?>"></td>
  </tr>
  <tr>
     <td align="right">E-mail:</td>
     <td><input name="email" type="text" id="email" readonly="true" value="<?php echo $registro["Email"]; ?>"></td>
  </tr>
  <tr>
     <td align="right">Login:</td>
     <td><input name="login" type="text" id="login" readonly="true" value="<?php echo $registro["Login"]; ?>"></td>
  </tr>
  <tr>
     <td align="right">Senha:</td>
     <td><input name="senha" type="text" id="senha" readonly="true" value="<?php echo $registro["Senha"]; ?>"></td>
  </tr>
  <tr>
    <td width="50%" align="right">Validar(Sim)/Desvalidar(Não):</td>
    <td width="50%">
      <SELECT Name="Validado" ID="Validado">
      <?php
      $ValAux = $registro["Validado"];
      if ($ValAux == 0) {
        echo "<option value='S' checked> Sim </option>";
        echo "<option value='N'>Não</option>";
      } else if ($ValAux == 1) {
        echo "<option value='N' checked>Não</option>";
        echo "<option value='S'>Sim</option>";
      }
      ?>
      </SELECT>
    </td>
  </tr>
  <!-- botoes de envio -->
  <tr>
     <td align="right">&nbsp;</td>
     <td><input name="Validar" type="submit" id="Validar" value="Validar">
         <input name="limpar" type="reset" id="limpar" value="Limpar"></td>
  </tr>
</table>
</form>

<?php
function validado($Valor)
{
    if ($Valor == 0) {
        return ('n');
    } else {
        return ('s');
    }
}

if (isset($_POST["Validar"])) {
    $Validado = $_POST["Validado"];
    print("validado:$Validado - codcliente:$CodCliente");
    if ($Validado == 's' OR $Validado == 'S') {
        $query = "UPDATE Clientes SET Validado='1' WHERE CodCliente='$CodCliente'";
        $resultado = mysqli_query($conexaoid, $query) or die("Não foi possível atualizar os dados");
        if ($resultado) {
            echo "<BR>Cliente Validado<br>";
        }
    } else if ($Validado == 'n' OR $Validado == 'N') {
        $query = "UPDATE Clientes SET Validado='0' WHERE CodCliente='$CodCliente'";
        $resultado = mysqli_query($conexaoid, $query) or die("Não foi possível atualizar os dados");
        if ($resultado) {
            echo "<BR>Cliente Desabilitado<br>";
        }
    }
}
?>
</body>
<a href=opcoes.html>Opções do Administrador</a>
</html>
