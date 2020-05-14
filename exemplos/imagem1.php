<?php
	error_reporting(E_ALL);
	require_once("../MiniGraficoImagem.php");
	$grafico = new MiniGraficoImagem ;
	$grafico->cadastrar(1,"Banana",255,0,0) ;
	$grafico->cadastrar(3,"Laranja",0,255,0) ;
	$grafico->gerarGrafico();
?>
