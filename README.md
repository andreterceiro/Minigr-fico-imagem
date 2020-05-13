Uma antiga biblioteca para gerar gráficos que eu fiz

Exemplo de como usar:
```
<?php
	require_once("MiniGraficoImagem.php");
	$grafico = new MiniGraficoImagem ;
	$grafico->cadastrar("40","quarenta","ff0000") ;
	$grafico->cadastrar("60","sessenta","0000ff") ;
	$grafico->gerarGrafico("titulo");
?>
```
Licensa Mit
