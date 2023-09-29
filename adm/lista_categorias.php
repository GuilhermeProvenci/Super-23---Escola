<?php
include("../conexao.php");
include("funcoes.php");
$opcoesPersonalizadas = array("Excluir");
listarRegistros("categorias", $conexaoid, $opcoesPersonalizadas);
?>
