Uma antiga biblioteca para gerar gráficos que eu fiz.

Exemplo de como usar. Abaixo supomos que será um imagem.php:
```
<?php
	require_once("vendor/autoload.php");
	require_once("./vendor/andreterceiro/minigraficoimagem/MiniGraficoImagem.php");
	$grafico = new MiniGraficoImagem ;
	$grafico->cadastrar(1,"Banana",255,255,0) ;
	$grafico->cadastrar(3,"Laranja",100,100,50) ;
	$grafico->gerarGrafico();
?>

```
Chamando a imagem por exemplo em um index.html. Tirando detalhes de HTML, o que importa é:
```
<img src="imagem-exemplo.php" />
```
Um exemplo mais complexo é:
```
<?php
	require_once("vendor/autoload.php");
	require_once("./vendor/andreterceiro/minigraficoimagem/MiniGraficoImagem.php");
	$grafico = new MiniGraficoImagem;
	$grafico->setarLinhaReferencia(5);
	$grafico->cadastrar(1,"Linux",255,0,0);
	$grafico->cadastrar(1,"Windows",0,255,0);
	$grafico->cadastrar(1,"Mac OS",0,0,255);
	$grafico->gerarGrafico(255,255,200);
?>
```

Exemplos estão disponíveis no diretório "exemplos".

Temos exemplos "no ar" em http://www.terceiro.com.br/miniGraficoImagem

Licença Mit.
