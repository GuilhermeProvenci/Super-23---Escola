<?php
include("./conexao.php");

if ($_POST) {
    $LoginUsuario = mysqli_real_escape_string($conexaoid, $_POST['LoginUsuario']); // Evite SQL Injection
    $SenhaUsuario = mysqli_real_escape_string($conexaoid, $_POST['SenhaUsuario']); // Evite SQL Injection

    if (!$LoginUsuario or !$SenhaUsuario) {
        print("É necessário digitar login e senha <BR>");
    } else {
        $query = "SELECT * FROM clientes WHERE ";
        $query .= " login='$LoginUsuario' ";

        $resultado = mysqli_query($conexaoid, $query); // Use mysqli_query em vez de mysql_query
        $registro = mysqli_fetch_array($resultado);

        if ($registro) {
            if (password_verify($SenhaUsuario, $registro['Senha'])) {
                // Senha válida, o usuário está autenticado
                if ($registro["Login"] == "adm") {
                    echo ("<script type='text/javascript'>");
                    echo ("window.location.href = 'adm/opcoes.html';"); // Redireciona para a nova página
                    echo ("window.close();"); // Fecha a página de login
                    echo ("</script>");
                } else {
                    echo ("<script type='text/javascript'>");
                    echo ("window.location.href = 'cliente/produtos/lista_produtos.php?CodCliente={$registro['CodCliente']}';"); // Redireciona para a nova página
                    echo ("window.close();"); // Fecha a página de login
                    echo ("</script>");
                }
            } else {
                // Senha incorreta
                echo "<script>window.alert('Senha incorreta para o login: $LoginUsuario. A senha correta é ----{$registro['Senha']}---- a Senha a qual você fornceu foi: $SenhaUsuario')</script>";
                require_once("login.html");
            }
        } else {
            // Usuário não encontrado
            echo "<script>window.alert('Login não encontrado: $LoginUsuario')</script>";
            require_once("login.html");
        }
    }
}
?>