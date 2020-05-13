<?
class minigraficoimagem{
/*------------------- Estrutura ----------------------//
// -Padrões- //
$this->corpadrao // cor PADRAO área da barra
$this->borda["espessura"] // espessura PADRAO da barra
$this->borda["cor"] // cor PADRAO da barra
$this->fonte["tipo"] // tipo de fonte PADRAO da barra
$this->fonte["cor"] // cor PADRAO da fonte da barra
$this->fonte["tamanho"] // tamanho PADRAO da fonte
$this->borda["cor"] // cor PADRAO da barra
$this->espacamento // Espaçamento PADRAO entre a barra e o valor
$this->tipo // Tipo de grafico PADRAO (semaforo, gradual, random, corfixa)
$this->valor["tipo"] // Tipo de valor padrão apresentado (valor,%,valor e %, nada)
//----------//
// -Funcoes- //
SetarMaximo(valor)
SetarMinimo(valor)
SetarTipo(tipo)
SetarRotulo(valor,fonte,cor,tamanho)
SetarFonteDefault(fonte,cor,tamanho)
SetarTitulo(valor,fonte,cor,tamanho,alinhamento)
SetarCor(cor)
SetarCorDefault(cor)
SetarBordaGrafico(espessura,cor) // cor opcional, pois espessura pode ser=0
SetarBorda(espessura,cor) //Da barra. Cor opcional, pois espessura pode ser=0
SetarBordaPadrao(espessura,cor)
SetarValor(valor,cor,tamanho,fonte,tipo)
AdicionarDado(rotulo,valor)
//----------//
// -Variaveis Internas- //
Índice // Indice para identificar os dados
//----------------------//
------------------------------------------------------*/
// Construtor
function minigraficoimagem() {
   //$dirBaseAntigo = getcwd();
   //chdir(dirname(__FILE__));
   //echo getcwd(); exit;
   //$this->fonte = imageloadfont(dirname(__FILE__) . '/fontes/pf_ronda_seven/pf_ronda_seven.ttf');	
   //$this->fonte = imageloadfont(dirname(__FILE__) . '/fontes/pixeljosh6/pixeljosh6.ttf');	
   //$this->fonteExterna = imageloadfont(dirname(__FILE__) . '/fontes/knuckle/knuckle.gdf');	
   //chdir($dirBaseAntigo);
   $this->borda["tipo"] = 1 ;
   $this->indice=0;
   $this->soma=0 ;
   $this->linha_base["vermelho"]=000000;
   $this->linha_base["verde"]=000000;
   $this->linha_base["azul"]=000000;
   $this->linha_referencia["cor"]["vermelho"]=140;
   $this->linha_referencia["cor"]["verde"]=140;
   $this->linha_referencia["cor"]["azul"]=140;
   $this->linha_referencia["valor"]=0;
}
//----------
	//function Referencias(
function ValidaCor($vermelho,$verde,$azul){
   if (is_integer($vermelho) && $vermelho >=0 && $vermelho <= 255) {
      if (is_integer($verde) && $verde >=0 && $verde <= 255) {
         if (is_integer($azul) && $azul >=0 && $azul <= 255) {
            return 1;
	 }
      }
   }   
}
function SetarLinhaBase($espessura="",$vermelho="",$verde="",$azul="") {
   if ($espessura>=0 && $espessura <6) $this->linha_base["espessura"] = $espessura ;
   if ($this->ValidaCor($vermelho,$verde,$azul)==1) {
      $this->linha_base["cor"]["vermelho"]=$vermelho;
      $this->linha_base["cor"]["verde"]=$verde;
      $this->linha_base["cor"]["azul"]=$azul;
   } 
}
function SetarLinhaReferencia($numlinhas="",$vermelho="",$verde="",$azul="") {
   if ($numlinhas>=0 && $numlinhas <6) $this->linha_referencia["valor"] = $numlinhas ;
   if ($this->ValidaCor($vermelho,$verde,$azul)==1) {
      $this->linha_referencia["cor"]["vermelho"]=$vermelho;
      $this->linha_referencia["cor"]["verde"]=$verde;
      $this->linha_referencia["cor"]["azul"]=$azul;
   } 
}
function SetarTipo($borda=1) {// TIPO 0= sem borda nas barras, TIPO 1= com borda nas barras, TIPO 2= borda indicando o total 
   if (is_integer($borda) && $borda >= 0 && $borda <= 2){
      $this->borda["tipo"]=$borda;
   }   
}   
function SetarCorBarra($vermelho,$verde,$azul) {
   if ($this->ValidaCor($vermelho,$verde,$azul)==1){
      $this->barra["padrao"]["cor"]["vermelho"] = $vermelho ;
      $this->barra["padrao"]["cor"]["verde"] = $verde ;
      $this->barra["padrao"]["cor"]["azul"] = $azul ;
   }   
}   
function SetarCorFonte($vermelho,$verde,$azul) {
   if ($this->ValidaCor($vermelho,$verde,$azul)==1){
     $this->fonte["padrao"]["cor"]["vermelho"] = $vermelho ;
     $this->fonte["padrao"]["cor"]["verde"] = $verde ;
     $this->fonte["padrao"]["cor"]["azul"] = $azul ;
   }   
}   
function Reiniciar(){ // reinicia só os valores
   $this->dados="" ;
   $this->cor="" ;
   $this->rotulo="";
   $this->indice=0;
   $this->soma =0 ;
}
public function incluirNaSoma($valor)
{
	if(is_numeric($valor)) {
		$this->soma += $valor;
		return true;
	}
	
	return false;
}
function Cadastrar($dados,$rotulo,$barravermelha="",$barraverde="",$barraazul="",$fontevermelha="",$fonteverde="",$fonteazul="",$bordavermelha="",$bordaverde="",$bordaazul=""){
   $this->dados[$this->indice]=$dados;
   $this->rotulo[$this->indice]=$rotulo;
   if ($this->ValidaCor($barravermelha,$barraverde,$barraazul)==1) {
      $this->barra["cor"]["vermelho"][$this->indice]=$barravermelha;
      $this->barra["cor"]["verde"][$this->indice]=$barraverde;
      $this->barra["cor"]["azul"][$this->indice]=$barraazul;
   }
   if ($this->ValidaCor($fontevermelha,$fonteverde,$fonteazul)==1) {
      $this->fonte["cor"]["vermelho"][$this->indice]=$fontevermelha;
      $this->fonte["cor"]["verde"][$this->indice]=$fonteverde;
      $this->fonte["cor"]["azul"][$this->indice]=$fonteazul;
   }   
   if ($this->ValidaCor($bordavermelha,$bordaverde,$bordaazul)==1) {
      $this->borda["cor"]["vermelho"][$this->indice]=$bordavermelha;
      $this->borda["cor"]["verde"][$this->indice]=$bordaverde;
      $this->borda["cor"]["azul"][$this->indice]=$bordaazul;
   }   
   $this->indice++; 
   $this->soma = $this->soma + $dados ;
}
function GerarGrafico($fundovermelho=215,$fundoverde=215,$fundoazul=255,$porcentagemNaBarra=1) {
   if ($this->soma==0) $this->soma="1" ; // PARA EVITAR O ERRO DE DIVISÃO POR 0 - NÃo INFLUI NOS RESULTADOS
   $tamanho_total=count($this->dados) * 50 + 30  ; // Calculando a extensão do gráfico no eixo y (plano cartesiano)
   //$this->linha_referencia["valor"] =1;
   if ($this->linha_referencia["valor"] != 0 ) {
      $imagem=ImageCreate(600,$tamanho_total+15); // CRIANDO A IMAGEM 
   }
   else{
      $imagem=ImageCreate(600,$tamanho_total); // CRIANDO A IMAGEM 
   }
   if ($this->ValidaCor($fundovermelho,$fundoverde,$fundoazul)) // Setando a cor de fundo
      $fundo=ImageColorAllocate($imagem,$fundovermelho,$fundoverde,$fundoazul) ; // Configurando a cor de fundo
   else 
      $fundo=ImageColorAllocate($imagem,215,215,215) ; // Configurando a cor de fundo
   $preto=ImageColorAllocate($imagem,0,0,0) ; // Configurando a cor da linha de base
   $cinza=ImageColorAllocate($imagem,80,80,80) ; // Configurando a para porcentagem dentro da barra 
   $cor_da_linha=ImageColorAllocate($imagem,$this->linha_base["cor"]["vermelho"],$this->linha_base["cor"]["verde"],$this->linha_base["cor"]["azul"]) ;
//   echo "<br><br>" . $this->linha["vermelho"] . "<br><Br>"; 
//   ImageLine($imagem,9,10,9,$tamanho_total-10,$cor_da_linha); // Colocando a linha de base	
//   ImageLine($imagem,9,$tamanho_total-10,590,$tamanho_total-10,$cor_da_linha); // Colocando a linha de base
   if ($this->linha_referencia["valor"] == 0) {
      $linha_final = $tamanho_total - 10; 
   }
   else{
      $linha_final = $tamanho_total - 10 ;
   }
      ImageFilledRectangle($imagem,9-$this->linha_base["espessura"],10,9 ,$linha_final + $this->linha_base["espessura"],$cor_da_linha) ; // Colocando a área preenchida
      ImageFilledRectangle($imagem,9,$linha_final,590,$linha_final + $this->linha_base["espessura"],$cor_da_linha); // Colocando a linha de base	
   $cor_pontilhado=imagecolorallocate($imagem,$this->linha_referencia["cor"]["vermelho"],$this->linha_referencia["cor"]["verde"],$this->linha_referencia["cor"]["azul"]) ;
   for($cont=0;$cont<$this->indice ;$cont++) {
      $porcentagem = number_format((($this->dados[$cont] / $this->soma) * 100),2,",",""). "%" ;
      $porcentagemcomponto = str_replace(",",".",$porcentagem) ;
      if ($this->ValidaCor($this->barra["cor"]["vermelho"][$cont],$this->barra["cor"]["verde"][$cont],$this->barra["cor"]["azul"][$cont])==1)
      $cor=ImageColorAllocate($imagem,$this->barra["cor"]["vermelho"][$cont],$this->barra["cor"]["verde"][$cont],$this->barra["cor"]["azul"][$cont]); // Setando a cor 
      $cor_fonte=ImageColorAllocate($imagem,$this->fonte["cor"]["vermelho"][$cont],$this->fonte["cor"]["verde"][$cont],$this->fonte["cor"]["azul"][$cont]); // Setando a cor 
	      $posicao_y= $cont * 50 + 40;
      $posicao_x = $porcentagemcomponto * 4.6 ;
      if ($posicao_x < 10 && $posicao_x != 0) 
         $posicao_x = 10 ;
      if ($this->borda["tipo"]==0 ) {
         ImageString($imagem,3,$porcentagemcomponto * 4.6 + 14,$posicao_y -2 , $this->dados[$cont] . " - " . $porcentagem  ,$cor_fonte) ; // Colocando a área preenchida
      }	 
      if ($this->borda["tipo"]==1 ) {
         ImageRectangle($imagem,10,$posicao_y-1,$posicao_x + 1 ,$posicao_y + 11,$preto) ; // Colocando a área preenchida
         ImageString($imagem,3,$porcentagemcomponto * 4.6 + 14,$posicao_y -2 , $this->dados[$cont] . " - " . $porcentagem  ,$cor_fonte) ; // Colocando a área preenchida
      }	 
      if ($this->borda["tipo"]==2 ) {
         ImageRectangle($imagem,10,$posicao_y-1,460 ,$posicao_y + 21,$preto) ; // Colocando a borda
         ImageRectangle($imagem,10,$posicao_y,11 ,$posicao_y + 20,$fundo) ; // Máscara com a cor de fundo para cobrir o 1px da borda esquerda
         ImageString($imagem,6,  474,$posicao_y + 3 , $this->dados[$cont] . " - " . $porcentagem  ,$cor_fonte) ; // Colocando a área preenchida
      }	 
      if ($this->dados[$cont]>0){	
         ImageFilledRectangle($imagem,10,$posicao_y,$posicao_x ,$posicao_y + 20,$cor) ; // Colocando a área preenchida
      }

      ImageString($imagem,5,15,$posicao_y - 17, $this->rotulo[$cont]  ,$cor_fonte) ; // Colocando a área preenchida
      if ($porcentagemNaBarra!=0) ImageString($imagem,6,15,$posicao_y +3, $porcentagem  ,$cinza) ; // Colocando a porcentagem a barra
   }
//      ImageLine($imagem,460  ,30,460,$tamanho_total-10,$cinza); // CRIANDO A IMAGEM 
   if ($this->linha_referencia["valor"] < 6 && $this->linha_referencia["valor"] > 0) {
   //echo "!" . $this->linha_refeferencia["valor"] . "!"  ;
      for($cont=1;$cont<$this->linha_referencia["valor"];$cont++) {
      #----------------------------------------------------------------
         ImagedashedLine($imagem,(460/$this->linha_referencia["valor"]) * $cont  ,30,(460/$this->linha_referencia["valor"])*$cont,$tamanho_total-10,$cor_pontilhado); // CRIANDO A IMAGEM 
	         ImageString($imagem,5, (460/$this->linha_referencia["valor"]) * $cont -7,$tamanho_total -5  ,round(($cont/$this->linha_referencia["valor"])*100) . "%"  ,$cor_pontilhado) ; // Colocando a área preenchida
      #----------------------------------------------------------------
      }
   }
ImagePng($imagem) ;
}
function GerarCor(){
  $numero =$this->randomico_antigo;
  while ($numero == $this->randomico_antigo)
     $numero = round(rand(1,8));
  if ($numero==1){ //Vermelho
     $vetor[1]=255;
     $vetor[2]=180;
     $vetor[3]=180;
     $vetor[4]=255;
     $vetor[5]=50;
     $vetor[6]=50;
  }
  elseif ($numero==2){ //Azul
     $vetor[1]=180;
     $vetor[2]=180;
     $vetor[3]=255;
     $vetor[4]=50;
     $vetor[5]=50;
     $vetor[6]=255;
  }
  elseif ($numero==3){ //Verde
     $vetor[1]=180;
     $vetor[2]=255;
     $vetor[3]=180;
     $vetor[4]=50;
     $vetor[5]=180;
     $vetor[6]=50;
  }
  elseif ($numero==4){ //Amarelo
     $vetor[1]=255;
     $vetor[2]=255;
     $vetor[3]=180;
     $vetor[4]=180;
     $vetor[5]=180;
     $vetor[6]=50;
  }
  elseif ($numero==5){ //Laranja
     $vetor[1]=255;
     $vetor[2]=225;
     $vetor[3]=180;
     $vetor[4]=225;
     $vetor[5]=180;
     $vetor[6]=50;
  }
  elseif ($numero==6){ //Violeta
     $vetor[1]=255;
     $vetor[2]=180;
     $vetor[3]=255;
     $vetor[4]=180;
     $vetor[5]=50;
     $vetor[6]=180;
  }
  elseif ($numero==7){ //Cinza
     $vetor[1]=220;
     $vetor[2]=220;
     $vetor[3]=220;
     $vetor[4]=180;
     $vetor[5]=180;
     $vetor[6]=180;
  }
  elseif ($numero==8){ //Marrom
     $vetor[1]=210;
     $vetor[2]=190;
     $vetor[3]=170;
     $vetor[4]=190;
     $vetor[5]=170;
     $vetor[6]=150;
  }
  return $vetor;
}
}
/*----------------------COMO USAR------------------------
<?
include "/intranet/andre/include/minigrafico.php" ;
$grafico = new minigraficoimagem("ffffff")  ;
$grafico->Cadastrar("40","quarenta","ff0000") ;
$grafico->Cadastrar("60","sessenta","0000ff") ;
$grafico->GerarGrafico("titulo");
?>
-----------------------------------------------------*/
