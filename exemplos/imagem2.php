<?php
	error_reporting(E_ALL);
	require_once("../MiniGraficoImagem.php");
	$grafico = new MiniGraficoImagem;
    $grafico->setarLinhaReferencia(5);
	$grafico->cadastrar(1,"Linux",255,0,0);
	$grafico->cadastrar(1,"Windows",0,255,0);
	$grafico->cadastrar(1,"Mac OS",0,0,255);
	$grafico->gerarGrafico();
?>
