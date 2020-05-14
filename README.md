Uma antiga biblioteca para gerar gráficos que eu fiz

Exemplo de como usar. Abaixo supomos que será um imagem.php:
```
<?php
        require_once("MiniGraficoImagem.php");
        $grafico = new MiniGraficoImagem;
        $grafico->setarTipoBorda(2); //0, 1 ou 2. Não precisa setar. O padrão é 1
        $grafico->cadastrar(20,"quarenta",255,0,0) ;
        $grafico->cadastrar(30,"sessenta",0,0,255) ;
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
	require_once("MiniGraficoImagem.php");
	$grafico = new MiniGraficoImagem;
	$grafico->setarLinhaReferencia(5);
	$grafico->cadastrar(1,"Linux",255,0,0);
	$grafico->cadastrar(1,"Windows",0,255,0);
	$grafico->cadastrar(1,"Mac OS",0,0,255);
	$grafico->gerarGrafico();
?>
```

Exemplos estão disponíveis no diretório "exemplos"

Licença Mit
