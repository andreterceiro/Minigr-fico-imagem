<?
class Minigraficoimagem {
	public function __construct() 
	{//minigraficoimagem() { PHP 4
	    $this->borda["tipo"] = 1;
	    $this->indice=0;
	    $this->soma=0 ;
	    $this->linha_base["vermelho"]=000000;
	    $this->linhaBase["verde"]=000000;
	    $this->linhaBase["azul"]=000000;
	    $this->linhaReferencia["cor"]["vermelho"]=140;
	    $this->linhaReferencia["cor"]["verde"]=140;
	    $this->linhaReferencia["cor"]["azul"]=140;
	    $this->linhaReferencia["valor"]=0;
	}

	public function validaCor($vermelho, $verde, $azul)
	{
	    if (is_integer($vermelho) && $vermelho >=0 && $vermelho <= 255) {
		    if (is_integer($verde) && $verde >=0 && $verde <= 255) {
			    if (is_integer($azul) && $azul >=0 && $azul <= 255) {
				    return 1;
		        }
		    }
	    }   
	}
	
	public function setarLinhaBase($espessura="", $vermelho="", $verde="", $azul="") 
	{
	    if ($espessura>=0 && $espessura < 6) {
			$this->linhaBase["espessura"] = $espessura;
		}
		
	    if ($this->validaCor($vermelho,$verde,$azul)==1) {
		    $this->linhaBase["cor"]["vermelho"]=$vermelho;
		    $this->linhaBase["cor"]["verde"]=$verde;
		    $this->linhaBase["cor"]["azul"]=$azul;
	    } 
	}

	public function setarLinhaReferencia($numeroDeLinhas="", $vermelho="", $verde="", $azul="") 
	{
	   if ($numeroDeLinhas >=0 && $numeroDeLinhas < 6) $this->linhaReferencia["valor"] = $numeroDeLinhas ;
	   if ($this->ValidaCor($vermelho,$verde,$azul)==1) {
		  $this->linhaReferencia["cor"]["vermelho"]=$vermelho;
		  $this->linhaReferencia["cor"]["verde"]=$verde;
		  $this->linhaReferencia["cor"]["azul"]=$azul;
	   } 
	}

	public function setarTipo($borda=1) 
	{// TIPO 0= sem borda nas barras, TIPO 1= com borda nas barras, TIPO 2= borda indicando o total 
	    if (is_integer($borda) && $borda >= 0 && $borda <= 2){
		    $this->borda["tipo"]=$borda;
	    }
	}

	public function setarCorBarra($vermelho, $verde, $azul) 
	{
		if ($this->ValidaCor($vermelho,$verde,$azul)==1){
			$this->barra["padrao"]["cor"]["vermelho"] = $vermelho ;
			$this->barra["padrao"]["cor"]["verde"] = $verde ;
			$this->barra["padrao"]["cor"]["azul"] = $azul ;
		}   
	}   
	
	public function SetarCorFonte($vermelho, $verde, $azul) 
	{
	    if ($this->validaCor($vermelho, $verde, $azul)==1){
		   $this->fonte["padrao"]["cor"]["vermelho"] = $vermelho ;
		   $this->fonte["padrao"]["cor"]["verde"] = $verde ;
		   $this->fonte["padrao"]["cor"]["azul"] = $azul ;
	    }
	}

	/**
	 * Reinicia alguns valores 
	 * 
	 */ 
	public function Reiniciar()
	{
	    $this->dados="";
	    $this->cor="";
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
	
	function cadastrar($dados, $rotulo, $barraVermelha="", $barraVerde="", $barraAzul="", $fonteVermelha="", $fonteVerde="", $fonteAzul="", $bordaVermelha="", $bordaVerde="", $bordaAzul="")
	{
	   $this->dados[$this->indice]=$dados;
	   $this->rotulo[$this->indice]=$rotulo;
	
	   if ($this->ValidaCor($barraVermelha,$barraVerde,$barraAzul)==1) {
		  $this->barra["cor"]["vermelho"][$this->indice]=$barraVermelha;
		  $this->barra["cor"]["verde"][$this->indice]=$barraVerde;
		  $this->barra["cor"]["azul"][$this->indice]=$barraAzul;
	   }
	
	   if ($this->ValidaCor($fonteVermelha,$fonteVerde,$fonteAzul)==1) {
		  $this->fonte["cor"]["vermelho"][$this->indice]=$fonteVermelha;
		  $this->fonte["cor"]["verde"][$this->indice]=$fonteVerde;
		  $this->fonte["cor"]["azul"][$this->indice]=$fonteAzul;
	   }   
	
	   if ($this->ValidaCor($bordavermelha,$bordaVerde,$bordaAzul)==1) {
		  $this->borda["cor"]["vermelho"][$this->indice]=$bordavermelha;
		  $this->borda["cor"]["verde"][$this->indice]=$bordaVerde;
		  $this->borda["cor"]["azul"][$this->indice]=$bordaAzul;
	   }   
	
	   $this->indice++; 
	   $this->soma = $this->soma + $dados ;
	}

	public function gerarGrafico($fundovermelho=215, $fundoverde=215, $fundoazul=255, $porcentagemNaBarra=1)
	{
	    if ($this->soma==0) $this->soma="1" ; // PARA EVITAR O ERRO DE DIVISÃO POR 0 - NÃo INFLUI NOS RESULTADOS
	    $tamanhoTotal=count($this->dados) * 50 + 30  ; // Calculando a extensão do gráfico no eixo y (plano cartesiano)
	    if ($this->linhaReferencia["valor"] != 0 ) {
	 	    $imagem=ImageCreate(600,$tamanhoTotal+15);
	    } else{
		    $imagem=ImageCreate(600,$tamanhoTotal);
	    }
	   
	    if ($this->ValidaCor($fundovermelho,$fundoverde,$fundoazul)) { // Setando a cor de fundo
		    $fundo=ImageColorAllocate($imagem,$fundovermelho,$fundoverde,$fundoazul) ; // Configurando a cor de fundo
	    } else { 
		    $fundo=ImageColorAllocate($imagem,215,215,215) ; // Configurando a cor de fundo
        }
       
	    $preto=ImageColorAllocate($imagem,0,0,0) ; // Configurando a cor da linha de base
	    $cinza=ImageColorAllocate($imagem,80,80,80) ; // Configurando a para porcentagem dentro da barra 
	    $corDaLinha=ImageColorAllocate($imagem,$this->linhaBase["cor"]["vermelho"],$this->linhaBase["cor"]["verde"],$this->linhaBase["cor"]["azul"]) ;

	    if ($this->linhaReferencia["valor"] == 0) {
		    $linhaFinal = $tamanhoTotal - 10; 
	    } else {
		    $linhaFinal = $tamanhoTotal - 10 ;
	    }
	   
	    // Colocando a área preenchida
	    ImageFilledRectangle(
		    $imagem,
		    9-$this->linhaBase["espessura"],
		    10,
		    9,
		    $linhaFinal + $this->linhaBase["espessura"],
		    $corDaLinha
	    );
	   
	    // Colocando a linha de base	
	    ImageFilledRectangle(
	        $imagem,
	        9,
	        $linhaFinal,
	        590,
	        $linhaFinal + $this->linhaBase["espessura"],
	        $corDaLinha
	    ); 
	   
	    $corPontilhado=imagecolorallocate(
			$imagem,
			$this->linhaReferencia["cor"]["vermelho"],
			$this->linhaReferencia["cor"]["verde"],
			$this->linhaReferencia["cor"]["azul"]
		);
	   
	    for ($cont=0; $cont < $this->indice; $cont++) {
	  	    $porcentagem = number_format((($this->dados[$cont] / $this->soma) * 100),2,",",""). "%" ;
		    $porcentagemcomponto = str_replace(",",".",$porcentagem) ;
		  
		    if (
			    $this->ValidaCor(
			        $this->barra["cor"]["vermelho"][$cont],
			        $this->barra["cor"]["verde"][$cont],
			        $this->barra["cor"]["azul"][$cont]) == 1 
		    ) {
			    $cor = imageColorAllocate(
				    $imagem,
					$this->barra["cor"]["vermelho"][$cont],
					$this->barra["cor"]["verde"][$cont],
					$this->barra["cor"]["azul"][$cont]
				);
		    }
		  
		    $cor_fonte=ImageColorAllocate(
		        $imagem,$this->fonte["cor"]["vermelho"][$cont],
		        $this->fonte["cor"]["verde"][$cont],
		        $this->fonte["cor"]["azul"][$cont]
		    ); 
		  
		    $posicaoY= $cont * 50 + 40;
		    $posicaoX = $porcentagemcomponto * 4.6 ;
		    
		    if ($posicaoX < 10 && $posicaoX != 0) {
			    $posicaoX = 10 ;
			}
			    
		    if ($this->borda["tipo"]==0 ) {
			    ImageString($imagem,3,$porcentagemcomponto * 4.6 + 14,$posicaoY -2 , $this->dados[$cont] . " - " . $porcentagem  ,$cor_fonte) ; // Colocando a área preenchida
		    }	 
		  
		    if ($this->borda["tipo"]==1 ) {
			    ImageRectangle($imagem,10,$posicaoY-1,$posicaoX + 1 ,$posicaoY + 11,$preto) ; // Colocando a área preenchida
			    ImageString($imagem,3,$porcentagemcomponto * 4.6 + 14,$posicaoY -2 , $this->dados[$cont] . " - " . $porcentagem  ,$cor_fonte) ; // Colocando a área preenchida
		    }	 
		  
		    if ($this->borda["tipo"] == 2 ) {
			    ImageRectangle($imagem,10, $posicaoY-1, 460 ,$posicaoY + 21, $preto) ; // Colocando a borda
			    ImageRectangle($imagem,10, $posicaoY, 11 ,$posicaoY + 20, $fundo) ; // Máscara com a cor de fundo para cobrir o 1px da borda esquerda
			    ImageString($imagem,6, 474, $posicaoY + 3 , $this->dados[$cont] . " - " . $porcentagem  ,$corFonte) ; // Colocando a área preenchida
		    }	 
		  
		    if ($this->dados[$cont] > 0){	
			    ImageFilledRectangle($imagem, 10, $posicaoY, $posicaoX , $posicaoY + 20, $cor) ; // Colocando a área preenchida
		    }

		    ImageString($imagem,5,15,$posicaoY - 17, $this->rotulo[$cont]  ,$corFonte) ; // Colocando a área preenchida
		  
		    // Colocando a porcentagem a barra
		    if ($porcentagemNaBarra != 0) {
			    ImageString($imagem,6,15, $posicaoY +3, $porcentagem  ,$cinza);
		    }
	    }

	    if ($this->linhaReferencia["valor"] < 6 && $this->linhaReferencia["valor"] > 0) {
		    for($cont=1;$cont<$this->linhaReferencia["valor"];$cont++) {
			    // CRIANDO A IMAGEM 
			    imageDashedLine(
				    $imagem,
				    (460 / $this->linhaReferencia["valor"]) * $cont,
				    30,
				    (460/$this->linhaReferencia["valor"]) * $cont, 
				    $tamanhoTotal-10,$corPontilhado
			    );
			 
			    // Colocando a área preenchida
			    imageString(
			        $imagem,
			        5,
			        (460/$this->linhaReferencia["valor"]) * $cont -7,$tamanhoTotal -5,
			        round(($cont/$this->linhaReferencia["valor"])*100) . "%"  ,$corPontilhado
				) ; 
		    }
	    }
	   
	    imagePng($imagem) ;
	}

	public function GerarCor()
	{
  	    $numero =$this->randomico_antigo;
	    while ($numero == $this->randomico_antigo) {
		   $numero = round(rand(1,8));
	    }
	    
	    if ($numero==1) {
			//Vermelho
		    $vetor[1]=255;
		    $vetor[2]=180;
		    $vetor[3]=180;
		    $vetor[4]=255;
		    $vetor[5]=50;
		    $vetor[6]=50;
        } elseif ($numero==2){
			 //Azul
			 $vetor[1]=180;
			 $vetor[2]=180;
			 $vetor[3]=255;
			 $vetor[4]=50;
			 $vetor[5]=50;
			 $vetor[6]=255;
		} elseif ($numero==3) { 
			 //Verde
			 $vetor[1]=180;
			 $vetor[2]=255;
			 $vetor[3]=180;
			 $vetor[4]=50;
			 $vetor[5]=180;
			 $vetor[6]=50;
		} elseif ($numero==4) { ]
			 //Amarelo
			 $vetor[1]=255;
			 $vetor[2]=255;
			 $vetor[3]=180;
			 $vetor[4]=180;
			 $vetor[5]=180;
			 $vetor[6]=50;
		} elseif ($numero==5) { 
			 //Laranja
			 $vetor[1]=255;
			 $vetor[2]=225;
			 $vetor[3]=180;
			 $vetor[4]=225;
			 $vetor[5]=180;
			 $vetor[6]=50;
	  	} elseif ($numero==6) {
			//Violeta
			$vetor[1]=255;
			$vetor[2]=180;
			$vetor[3]=255;
			$vetor[4]=180;
			$vetor[5]=50;
			$vetor[6]=180;
		} elseif ($numero==7){
			//Cinza
			$vetor[1]=220;
			$vetor[2]=220;
			$vetor[3]=220;
			$vetor[4]=180;
			$vetor[5]=180;
		    $vetor[6]=180;
		} elseif ($numero==8){
			//Marrom
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
