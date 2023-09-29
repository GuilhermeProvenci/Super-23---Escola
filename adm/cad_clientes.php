<?php
include("../conexao.php");
include("funcoes.php");
// $LoginUsuario = $_POST["LoginUsuario"];
// $SenhaUsuario = $_POST["SenhaUsuario"];
// $nome = $_POST["nome"];
// $cidade = $_POST["cidade"];
// $estado = $_POST["estado"];
// $email = $_POST["email"];

// if (isset($_POST["Salvar"])) {
//     $query = "INSERT INTO clientes (nome, cidade, estado, email, Login, Senha) ";
//     $query .= "VALUES ('$nome', '$cidade', '$estado', '$email', '$LoginUsuario', '$SenhaUsuario')";

//     $resultado = mysqli_query($conexaoid, $query);

//     if ($resultado) {
//         echo "Cliente adicionado com sucesso";
//     } else {
//         echo "Não foi possível cadastrar o cliente: " . mysqli_error($conexaoid);
//     }
// }

// echo "<br><a href=../login.html>Login</a>";

// Exemplo 1: Criar um formulário para todos os campos, com todos os campos em readonly
//$nomeTabela = "produtos";
//criarFormularioCadastro($nomeTabela, $conexaoid, array(), array());

// Exemplo 2: Criar um formulário apenas com os campos escolhidos em readonly
$nomeTabela = "clientes";
$camposDesejados = array();
$camposReadonly = array("CodCliente");
criarFormularioCadastro($nomeTabela, $conexaoid, $camposDesejados, $camposReadonly);
?>
