<?php
$host = "localhost";
$usuario = "root";
$banco = "escola";
$senha = "";

// Conectar usando MySQLi
$conexaoid = new mysqli($host, $usuario, $senha, $banco);

// Verificar a conexão
if ($conexaoid->connect_error) {
    die("Não foi possível conectar ao banco de dados: " . $conexaoid->connect_error);
}
?>
