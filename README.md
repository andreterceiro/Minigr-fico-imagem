Uma antiga biblioteca para gerar gráficos que eu fiz

Exemplo de como usar. Abaixo supomos que será um imagem.php:
```
<?php
	require_once("MiniGraficoImagem.php");
	$grafico = new MiniGraficoImagem ;
	$grafico->cadastrar("40","quarenta","ff0000") ;
	$grafico->cadastrar("60","sessenta","0000ff") ;
	$grafico->gerarGrafico("titulo");
?>
```
Chamando a imagem por exemplo em um index.html. Tirando detalhes de HTML, o que importa é:
```
<img src="imagem.php" />

Licensa Mit
