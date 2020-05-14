<?php
	require_once("MiniGraficoImagem.php");
	$grafico = new MiniGraficoImagem ;
	$grafico->cadastrar(1,"Banana",255,255,0) ;
	$grafico->cadastrar(3,"Laranja",100,100,50) ;
	$grafico->gerarGrafico();
?>
