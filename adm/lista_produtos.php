<?php
include("../conexao.php");
include("funcoes.php");
$opcoesPersonalizadas = array("Editar", "Excluir");
listarRegistros("produtos", $conexaoid, $opcoesPersonalizadas);
?>
