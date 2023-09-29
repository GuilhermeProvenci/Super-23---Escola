<html>
<head>
    <title>Listas</title>
</head>
<body background="#CCC">
<font size=5>
<?php
include("conexao.php");

if ($_POST) {
    $LoginUsuario = mysqli_real_escape_string($conexaoid, $_POST['LoginUsuario']); // Evite SQL Injection
    $SenhaUsuario = mysqli_real_escape_string($conexaoid, $_POST['SenhaUsuario']); // Evite SQL Injection

    if (!$LoginUsuario or !$SenhaUsuario) {
        print("É necessário digitar login e senha <BR>");
    } else {
        $query = "SELECT * FROM clientes WHERE ";
        $query .= " login='$LoginUsuario' AND ";
        $query .= " senha='$SenhaUsuario' ";

        $resultado = mysqli_query($conexaoid, $query); // Use mysqli_query em vez de mysql_query
        $registro = mysqli_fetch_array($resultado);

        if ($registro['Login'] == $LoginUsuario and
            $registro['Senha'] == $SenhaUsuario) {
            if ($registro["Login"] == "admin" and $registro["Senha"] == "admin") {
                echo ("<script type='text/javascript'>");
                print("window.open('adm/opcoes.html')");
                echo("</script>");
            } else {
                print("<BR><a href='ver_produto.php?CodCliente={$registro['CodCliente']}'> Produtos</a>"); // Use {} para incorporar valores em strings
            }
        } else {
            echo "<script>window.alert('Senha ou login incorreto')</script>";
            require_once("login.html");
        }
    }
}
?>
</body>
</html>
