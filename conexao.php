<?php
require_once 'config.php';

$conexaoid = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if ($conexaoid->connect_error) {
    die("Não foi possível conectar ao banco de dados: " . $conexaoid->connect_error);
}

// Outras configurações para segurança
$conexaoid->set_charset(DB_CHARSET);
?>