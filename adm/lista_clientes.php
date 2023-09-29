<?php
include("../conexao.php");
include("funcoes.php");
$opcoesPersonalizadas = array("Validar", "Editar", "Excluir");
listarRegistros("clientes", $conexaoid, $opcoesPersonalizadas);
?>
