Uma antiga biblioteca para gerar gráficos que eu fiz

Exemplo de como usar:
```
<?php
include "/intranet/andre/include/minigrafico.php" ;
$grafico = new minigraficoimagem("ffffff")  ;
$grafico->Cadastrar("40","quarenta","ff0000") ;
$grafico->Cadastrar("60","sessenta","0000ff") ;
$grafico->GerarGrafico("titulo");
?>
```