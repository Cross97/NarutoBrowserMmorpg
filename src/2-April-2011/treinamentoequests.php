<?php // users.php :: Handles user account functions.


/*$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);*/


if ($valorlib == ""){//valor para nao redeclarar esses scripts.
include('lib.php');
$link = opendb();

include('cookies.php');
$userrow = checkcookies();
}
include('funcoesinclusas.php');



		


if (isset($_GET["do"])) {
    
    $do = $_GET["do"];
    if ($do == "treinamento") { treinamento(); }
	elseif ($do == "quests") { quests(); }
	
	}

function treinamento($conteudodois) {
global $topvar;

$topvar = true;
$conteudo = $_GET['conteudo'];

    /* testando se est� logado */
		//include('cookies.php');
		//$userrow = checkcookies();
		global $userrow;

		if ($userrow == false) { display("Por favor fa�a o <a href=\"login.php?do=login\">log in</a> no jogo antes de executar essa a��o.","Erro",false,false,false);
		die(); }
	
					if ($userrow["currentaction"] == "Fighting") {header('Location: ./index.php?do=fight&conteudo=Voc� n�o pode acessar essa fun��o no meio de uma batalha!');die(); }					
					if ($userrow["batalha_timer2"] == 5) {global $topvar;
$topvar = true; display("Voc� n�o pode fazer nenhum movimento enquanto estiver em um duelo. Clique <a href=\"users.php?do=resetarduelo\">aqui</a>, para resetar seu Duelo atual. ","Erro",false,false,false);die(); }

	
//separando o treinamento.
$treinamento = explode(";",$userrow["treinamento"]);
$quantidade = count($treinamento) - 2;

for ($i = 0; $i <= $quantidade; $i++){
	$subtreino = explode(",",$treinamento[$i]);
	
	
	$off = "";
	$frase = "";
	//variaveis para a fun��o em javascript.
	if ($subtreino[0] == "Jutsu de Busca"){
		$recompensa = "Utiliza��o do Jutsu de Busca.";
		$requerimento = "Possuir o Byakugan como Jutsu Ocular.";	
		$localtreino = "Vila da Areia.";
		$linkdotreino = "<a href=\"jutsudebusca.php?do=aprendendo2\">"; $linkdotreino2 = "</a>";
		$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "Treino n�o Dispon�vel";}
    $townrow = mysql_fetch_array($townquery);
if ($townrow["id"] != 5) {$off = "2";$frase = "Treino n�o Dispon�vel";}//vila da areia
	}
	elseif ($subtreino[0] == "Senjutsu"){
		$recompensa = "Aquisi��o da Arte Eremita, o Senjutsu. Quando ativado, lhe conceder� 20% de aumento de Ataque e Destreza.";
		$requerimento = "Ser um Genin.";	
		$localtreino = "Montanha Myoboku.";
		$linkdotreino = "<a href=\"senjutsu.php?do=aprendendo2\">"; $linkdotreino2 = "</a>";
		$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "Treino n�o Dispon�vel";}
    $townrow = mysql_fetch_array($townquery);
if ($townrow["id"] != 2) {$off = "2";$frase = "Treino n�o Dispon�vel";}//montanha myoboku
	}
	//fim jutsus separados.
	


	
	
	/*qual imagem...
	if ($subtreino[1] == $subtreino[2]){
		$qual = "aceitar.gif";	
	}else{$qual = "deletar.gif";}*/
	
	//porcentagem da pedra
	$porcentagem = ($subtreino[1] * 100)/$subtreino[2];
	if ($porcentagem == 0){$pedra = "<img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem > 0) && ($porcentagem < 20)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 20) && ($porcentagem < 40)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 40) && ($porcentagem < 60)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 60) && ($porcentagem < 80)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 80) && ($porcentagem < 100)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif ($porcentagem == 100){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";$off = "2";$frase = "Treino Conclu�do";}
	//fim porcentagem pedra.
	
		//tempo..
	include('funcoesinclusas.php');
	$retorno = tempojutsu($subtreino[3], $subtreino[4], $subtreino[5]);
	if ($retorno == "ok"){$relogio = "relogio2";$relogiotitle = "Tempo de Espera Conclu�do";}else{
		$relogio = "relogio"; $relogiotitle = "Restam ".$retorno." Minutos de Espera at� o Pr�ximo Treinamento";$off = "2";$frase = "Treino n�o Dispon�vel";}
	if ($subtreino[1] == $subtreino[2]){$relogio = "relogio2";$relogiotitle = "Treinamento Conclu�do";$off = "2";$frase = "Treinamento Conclu�do";
	}//fim tempo.
	
	//sem link p treino
	if ($subtreino[1] == $subtreino[2]){$linkdotreino = ""; $linkdotreino2 = "";}	
	
	if ($frase == ""){$frase = "Treinar Agora";}
			
	$html .= "<table width=\"100%\"><tr bgcolor=\"#613003\"><td width=\"*\"><font color=\"white\">".$subtreino[0]."</font></td><td width=\"17\"><img src=\"images/".$relogio.".gif\" title=\"".$relogiotitle."\"></td><td width=\"17\">$linkdotreino<img src=\"images/treinar$off.gif\" title=\"$frase\" border=\"0\">$linkdotreino2</td><td width=\"84\">$pedra</td><td width=\"20\"><a href=\"javascript:mostrartreino('$i', '$recompensa', '$requerimento', '$localtreino')\"><img src=\"images/setabaixo.gif\" title=\"Mostrar Dados\" border=\"0\"></a></td><td width=\"20\"><a href=\"javascript:escondertreino('$i')\"><img src=\"images/setacima.gif\" title=\"Esconder Dados\" border=\"0\"></a></td></tr></table><div id=\"elemento$i\"></div><br>";

		
}//fim for
	
	//se n�o houver nada.
	if (($html == "") && ($conteudodois == "")){header('Location: ./index.php?conteudo=Voc� ainda n�o adquiriu nenhum treinamento.');die(); }
	
	//para aparecer a fala dentro do pergaminho.
	if(($conteudodois == "") && ($conteudo == "") && ($townrow['name'] == "")){$conteudodois = "<br>";}
	if(($conteudodois == "") && ($conteudo != "") && (mysql_num_rows($townquery) != 0)){$conteudodois = personagemgeral($conteudo, $townrow["id"],$townrow["kage"]); $conteudo = "";}
	elseif(($conteudodois == "") && ($conteudo == "") && ($townrow['name'] != "")){$conteudodois = personagemgeral('Ol� '.$userrow['charname'].'! voc� est� na(o) '.$townrow['name'].', pretende treinar algum Jutsu? Posso ajudar em alguma coisa? Use as op��es abaixo para completar treinamentos.', $townrow["id"],$townrow["kage"]); $conteudo = "";}
	
	
			
	if ($conteudo != ""){$conteudo = "<center><font color=brown>".$conteudo."</font></center><br>";}
	
	$page = "<table width=\"100%\"><tr><td width=\"100%\" align=\"center\"><center><img src=\"images/treinamento.gif\" /></center></td></tr></table>
	$conteudo
	$conteudodois
	$html";
			 
			 display($page, "Treinamento", false, false, false);
	die();
	
	
	
	
}















































function quests($conteudodois) {
global $topvar;

$topvar = true;
$conteudo = $_GET['conteudo'];

    /* testando se est� logado */
		//include('cookies.php');
		//$userrow = checkcookies();
		global $userrow;

		if ($userrow == false) { display("Por favor fa�a o <a href=\"login.php?do=login\">log in</a> no jogo antes de executar essa a��o.","Erro",false,false,false);
		die(); }
	
					if ($userrow["currentaction"] == "Fighting") {header('Location: ./index.php?do=fight&conteudo=Voc� n�o pode acessar essa fun��o no meio de uma batalha!');die(); }					
					if ($userrow["batalha_timer2"] == 5) {global $topvar;
$topvar = true; display("Voc� n�o pode fazer nenhum movimento enquanto estiver em um duelo. Clique <a href=\"users.php?do=resetarduelo\">aqui</a>, para resetar seu Duelo atual. ","Erro",false,false,false);die(); }

	
//separando o miss�es aux.

$quests = explode(";",$userrow["questsaux"]);
$quantidade = count($quests) - 2;
if ($userrow["questsaux"] == "None"){$quantidade = 0;}

for ($i = 0; $i <= $quantidade - 1; $i++){
	$subtreino = explode(",",$quests[$i]);
		
	$off = "";
	$frase = "";
	
	
	$conclusao = "N�o Obrigat�ria.";
	
	//variaveis para a fun��o em javascript.
	if ($subtreino[0] == "Jutsu de Busca"){
		$recompensa = "Utiliza��o do Jutsu de Busca.";
		$requerimento = "Nenhum.";	
		$localtreino = "Vila da Areia.";
		$nivel = "Rank ?";
		$linkdotreino = "<a href=\"jutsudebusca.php?do=aprendendo2\">"; $linkdotreino2 = "</a>";
		$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel";}
    $townrow = mysql_fetch_array($townquery);
if ($townrow["id"] != 5) {$off = "2";$frase = "N�o Dispon�vel";}//vila da areia
	}
	elseif ($subtreino[0] == "Senjutsu"){
		$recompensa = "Aquisi��o da Arte Eremita, o Senjutsu. Quando ativado, lhe conceder� 10% de aumento de Ataque e Destreza.";
		$requerimento = "Ser um Genin.";	
		$localtreino = "Montanha Myoboku.";
		$nivel = "Rank ?";
		$linkdotreino = "<a href=\"senjutsu.php?do=aprendendo2\">"; $linkdotreino2 = "</a>";
		$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel";}
    $townrow = mysql_fetch_array($townquery);
if ($townrow["id"] != 2) {$off = "2";$frase = "N�o Dispon�vel";}//montanha myoboku
	}



	
	
	/*qual imagem...
	if ($subtreino[1] == $subtreino[2]){
		$qual = "aceitar.gif";	
	}else{$qual = "deletar.gif";}*/
	
	//porcentagem da pedra
	$porcentagem = ceil(($subtreino[1] * 100)/$subtreino[2]);
	if ($porcentagem == 0){$pedra = "<img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem > 0) && ($porcentagem < 20)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 20) && ($porcentagem < 40)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 40) && ($porcentagem < 60)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 60) && ($porcentagem < 80)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 80) && ($porcentagem < 100)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif ($porcentagem == 100){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";$off = "2";$frase = "Miss�o Conclu�da";}
	//fim porcentagem pedra.
	

	
		//tempo..
	include('funcoesinclusas.php');
	$retorno = tempojutsu($subtreino[3], $subtreino[4], $subtreino[5]);
	if ($retorno == "ok"){$relogio = "relogio2";$relogiotitle = "Tempo de Espera Conclu�do";
	}else{
		$relogio = "relogio"; $relogiotitle = "Restam ".$retorno." Minutos de Espera";$off = "2";$frase = "N�o Dispon�vel";}
	if ($subtreino[1] == $subtreino[2]){$relogio = "relogio2";$relogiotitle = "Miss�o Conclu�da";$off = "2";$frase = "Miss�o Conclu�da";
	}//fim tempo.
	
	//sem treino
	if ($subtreino[1] == $subtreino[2]){$linkdotreino = ""; $linkdotreino2 = "";}	


	if ($frase == ""){$frase = "Fazer Miss�o Agora";}
	
		//se n�o tiver o q treinar
	if (($subtreino[1] == 0) && ($subtreino[2] == 0)){
		$relogio = "relogio2"; $relogiotitle = "Sem Tempo de Espera para essa Miss�o";
		$off = "";$frase = "Completar Miss�o";
	}
	
			
	$html .= "<table width=\"100%\"><tr bgcolor=\"#613003\"><td width=\"*\"><font color=\"white\">".$subtreino[0]."</font></td><td width=\"17\"><img src=\"images/".$relogio.".gif\" title=\"".$relogiotitle."\"></td><td width=\"17\">$linkdotreino<img src=\"images/treinar$off.gif\" title=\"$frase\" border=\"0\">$linkdotreino2</td><td width=\"84\">$pedra</td><td width=\"20\"><a href=\"javascript:mostrarquest('$i"."aux"."', '$recompensa', '$requerimento', '$localtreino', '$nivel', '$conclusao')\"><img src=\"images/setabaixo.gif\" title=\"Mostrar Dados\" border=\"0\"></a></td><td width=\"20\"><a href=\"javascript:escondertreino('$i')\"><img src=\"images/setacima.gif\" title=\"Esconder Dados\" border=\"0\"></a></td></tr></table><div id=\"elemento$iaux\"></div><br>";

		
}//fim for









































//atualizando dados
global $userrow;
$atualizar = doquery("SELECT missao, missaoultdata FROM {{table}} WHERE charname='".$userrow["charname"]."' LIMIT 1", "users");
if (mysql_num_rows($atualizar) == 0) { display("H� um erro com sua conta. Por favor tente novamente.","Error"); die();}
$atualizardados = mysql_fetch_array($atualizar);
$userrow["missao"] = $atualizardados["missao"];
$userrow["missaoultdata"] = $atualizardados["missaoultdata"];
//fim do atualizando dados.


//separando o miss�es obrigat�rias.
$quests = explode(",",$userrow["missao"]);
$quantidade = $quests[0];
$tempojutsuatual = explode(";", $userrow["missaoultdata"]);

for ($i = 1; $i <= $quantidade; $i++){
$subtreino = explode(",",$userrow["missao"]);
		
	$off = "";
	$frase = "";
	$porcentagem = 0;
	
	
	$conclusao = "Obrigat�ria.";
	

		//miss�o 1
		if ($i == 1){
			$subtreino[0] = "Miss�o ".$i.": Fartura do Fogo!";
			$recompensa = "Nenhuma.";
			$requerimento = "Levar o item <b>Fartura do Fogo</b> at� a Vila da Folha.";
			$itemprocurado = ", 'Fartura do Fogo'";	//deixar formata��o.
			$localtreino = "Vila da Folha.";
			$nivel = "Rank E.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 1) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		//miss�o 2
		if ($i == 2){
			$subtreino[0] = "Miss�o ".$i.": Lixos no Caminho!";
			$recompensa = "50 Ryou.";
			$requerimento = "Konoha est� precisando de ajuda comunit�ria para limpeza da cidade. Colete o lixo 10 vezes � cada 1 minuto para completar essa miss�o.";
			$itemprocurado = "";	//deixar formata��o.
			$localtreino = "Vila da Folha.";
			$nivel = "Rank E.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 1) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		
		//miss�o 3
		if ($i == 3){
			$subtreino[0] = "Miss�o ".$i.": Konoha Precisa de Ajuda!";
			$recompensa = "100 Ryou.";
			$requerimento = "Procure pelo <b>Lobo Rubro</b> que est� causando problemas aos arredores da Vila da Folha, mate-o e venha imediatamente at� a Vila da Folha.";
			$itemprocurado = ", '', '', 'Lobo Rubro'";	//deixar formata��o.
			$localtreino = "Vila da Folha.";
			$nivel = "Rank E.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 1) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
	
		
		
		
		//miss�o 4
		if ($i == 4){
			$subtreino[0] = "Miss�o ".$i.": Bagun�a Total!";
			$recompensa = "30 Ryou.";
			$requerimento = "Seu quarto est� bagun�ado. Arrume o seu quarto 5 vezes � cada 1 minuto para completar essa miss�o.";
			$itemprocurado = "";	//deixar formata��o.
			$localtreino = "Vila da Folha.";
			$nivel = "Rank E.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 1) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		
		//miss�o 5
		if ($i == 5){
			$subtreino[0] = "Miss�o ".$i.": Boneca Perdida!";
			$recompensa = "100 Ryou.";
			$requerimento = "Uma crian�a da vila perdeu sua boneca. Voc� precisa levar o item <b>Boneca Perdida</b> at� a Vila da Folha.";
			$itemprocurado = ", 'Boneca Perdida'";	//deixar formata��o.
			$localtreino = "Vila da Folha.";
			$nivel = "Rank D.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 1) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		//miss�o 6
		if ($i == 6){
			$subtreino[0] = "Miss�o ".$i.": Arte Eremita!";
			$recompensa = "300 Ryou.";
			$requerimento = "Procure nas proximidades da Montanha Myoboku, algu�m que possa te informar um pouco mais sobre a arte eremita, e ent�o, traga o seu novo conhecimento at� a Vila da Folha.";
			$itemprocurado = ", '', '-100/101'";	//deixar formata��o.
			$localtreino = "Vila da Folha.";
			$nivel = "Rank D.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 1) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		//miss�o 7
		if ($i == 7){
			$subtreino[0] = "Miss�o ".$i.": Cabe�a de Zabuza Momochi!";
			$recompensa = "350 Ryou.";
			$requerimento = "A Vila da Folha precisa que voc� procure e mate <b>Zabuza</b> e ent�o volte imediatamente at� a Vila da Folha para pegar sua recompensa.";
			$itemprocurado = "";	//deixar formata��o.
			$localtreino = "Vila da Folha.";
			$nivel = "Rank C.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 1) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		
		
		
		//miss�o 8
		if ($i == 8){
			$subtreino[0] = "Miss�o ".$i.": Perigo � Solta!";
			$recompensa = "500 Ryou.";
			$requerimento = "H� uma infesta��o de roedores espalhados pela Montanha Myoboku, ajude a acabar com essa praga. Voc� deve realizar esse processo 10 vezes em intervalos de 6 minutos para completar essa miss�o.";
			$itemprocurado = "";	//deixar formata��o.
			$localtreino = "Montanha Myoboku.";
			$nivel = "Rank D.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 2) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		





		//miss�o 9
		if ($i == 9){
			$subtreino[0] = "Miss�o ".$i.": Espadas Raiga!";
			$recompensa = "300 Ryou.";
			$requerimento = "Procure Nakami nas proximidades da Vila da Pedra, recolha informa��es sobre as Espadas Raiga que ela possui e ent�o leve as informa��es at� a Vila da Pedra para reconhecimento do Kage.";
			$itemprocurado = ", '', '124/-75'";	//deixar formata��o.
			$localtreino = "Vila da Pedra.";
			$nivel = "Rank D.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 3) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		
		//miss�o 10
		if ($i == 10){
			$subtreino[0] = "Miss�o ".$i.": Rasto de Hachibi!";
			$recompensa = "1000 Ryou, <font color=\"grey\">(x1)</font>M�scara do Ritual.";
			$requerimento = "Leve at� a Vila da Nuvem o item <b>Rastro de Hachibi</b>.";
			$itemprocurado = ", 'Rastro de Hachibi'";	//deixar formata��o.
			$localtreino = "Vila da Nuvem.";
			$nivel = "Rank B.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 6) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		
		//miss�o 11
		if ($i == 11){
			$subtreino[0] = "Miss�o ".$i.": Passando Conhecimento!";
			$recompensa = "400 Ryou.";
			$requerimento = "Ajude um dos estudantes da academia a aprender um novo jutsu. Voc� deve fazer isso 5 vezes em intervalos de 12 minutos.";
			$itemprocurado = "";	//deixar formata��o.
			$localtreino = "Vila da Nuvem.";
			$nivel = "Rank D.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 6) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}








		//miss�o 12
		if ($i == 12){
			$subtreino[0] = "Miss�o ".$i.": Compondo a Vila da Areia!";
			$recompensa = "5000 Ryou.";
			$requerimento = "A Vila da Areia est� precisando que Temari retorne at� a mesma. Encontre-a na proximidade da Vila da Folha. Para completar essa miss�o, tamb�m � necess�rio ajudar na miss�o de expedi��o � um campo de batalha da Vila da Areia, portanto, mantenha total suporte realizando essa miss�o 5 vezes em intervalos de 60 segundos.";
			$itemprocurado = ", '', '5/-8'";	//deixar formata��o.
			$localtreino = "Vila da Areia.";
			$nivel = "Rank B.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 5) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}




		//miss�o 13
		if ($i == 13){
			$subtreino[0] = "Miss�o ".$i.": Em Busca de Nibi!";
			$recompensa = "400 Ryou.";
			$requerimento = "Procure por <b>Nibi</b> pr�ximo � Vila da N�voa, mate-o e venha imediatamente at� a Vila.";
			$itemprocurado = ", '', '', 'Nibi'";	//deixar formata��o.
			$localtreino = "Vila da N�voa.";
			$nivel = "Rank B.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 4) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		//miss�o 14
		if ($i == 14){
			$subtreino[0] = "Miss�o ".$i.": Vingan�a do Som!";
			$recompensa = "400 Ryou.";
			$requerimento = "Mate <b>Jiroubou Selo 1</b> tr�s vezes seguidas e venha imediatamente at� a Vila da Pedra.";
			$itemprocurado = ", '', '', 'Jiroubou Selo 1'";	//deixar formata��o.
			$localtreino = "Vila da Pedra.";
			$nivel = "Rank C.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 3) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		
		//miss�o 15
		if ($i == 15){
			$subtreino[0] = "Miss�o ".$i.": Flauta Surpresa!";
			$recompensa = "1000 Ryou, Item: <b>Flauta de Tayuya</b>.";
			$requerimento = "Obter o item <b>Runa de Chakra</b>, procurar por Shinomori pr�ximo � Vila da Nuvem e trazer as informa��es disponibilizadas por ela at� a Vila da Folha.";
			$itemprocurado = ", 'Runa de Chakra', '171/171'";	//deixar formata��o.
			$localtreino = "Vila da Folha.";
			$nivel = "Rank B.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 1) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}





		//miss�o 16
		if ($i == 16){
			$subtreino[0] = "Miss�o ".$i.": Eliminando Pein #1!";
			$recompensa = "5000 Ryou.";
			$requerimento = "Derrotar <b>Ningendo</b>, um dos corpos de Pein e v� imediatamente at� a Vila da Areia.";
			$itemprocurado = ", '', '', 'Ningendo'";	//deixar formata��o.
			$localtreino = "Vila da Areia.";
			$nivel = "Rank A.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 5) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		
		
		
		
		
		
		//miss�o 17
		if ($i == 17){
			$subtreino[0] = "Miss�o ".$i.": Ajuda ao Kazekage!";
			$recompensa = "2000 Ryou.";
			$requerimento = "Ajude o Kazekage a organizar a fun��o de todos os jounins da vila. Voc� deve realizar essa opera��o 10 vezes em intervalos de 6 minutos.";
			$itemprocurado = "";	//deixar formata��o.
			$localtreino = "Vila da Areia.";
			$nivel = "Rank C.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 5) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		
		
		
		
		//miss�o 18
		if ($i == 18){
			$subtreino[0] = "Miss�o ".$i.": Cajado Enma!";
			$recompensa = "Item: <b>Cajado Enma</b>.";
			$requerimento = "Procure por Hikaru para adquirir informa��es sobre o <b>Cajado Enma</b> e retorne at� a Vila da Folha.";
			$itemprocurado = ", 'For�a In�til', '99/26'";	//deixar formata��o.
			$localtreino = "Vila da Folha.";
			$nivel = "Rank C.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 1) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		
		
		//miss�o 19
		if ($i == 19){
			$subtreino[0] = "Miss�o ".$i.": Ataque na Vila da Folha!";
			$recompensa = "Item: <b>Amuleto de Sapo</b>.";
			$requerimento = "A Vila da Folha precisa de ajuda, v� at� a Montanha Myoboku e traga Fukasaku e Shima at� a Vila da Folha.";
			$itemprocurado = "";	//deixar formata��o.
			$localtreino = "Vila da Folha.";
			$nivel = "Rank B.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 1) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}



	
	
	
	
	
	
	
		//miss�o 20
		if ($i == 20){
			$subtreino[0] = "Miss�o ".$i.": Eliminando Pein #2!";
			$recompensa = "7000 Ryou, Item: <b>Anel da Sorte</b>.";
			$requerimento = "Derrotar <b>Gakido</b>, um dos corpos de Pein e v� imediatamente at� a Vila da Folha.";
			$itemprocurado = ", '', '', 'Gakido'";	//deixar formata��o.
			$localtreino = "Vila da Folha.";
			$nivel = "Rank A.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 1) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
		
		
		
		
		
		
		
		
		
		//miss�o 21
		if ($i == 21){
			$subtreino[0] = "Miss�o ".$i.": Em Busca do Desaparecido!";
			$recompensa = "Item: <b>Protetor de Honra da N�voa</b>.";
			$requerimento = "Localize Mishigan, converse com ele sobre o seu desaparecimento da Vila da N�voa e ent�o volte at� a Vila para receber sua recompensa, traga consigo o item <b>Alma da N�voa</b>.";
			$itemprocurado = ", 'Alma da N�voa'";	//deixar formata��o.
			$localtreino = "Vila da N�voa.";
			$nivel = "Rank C.";
			$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
	if (mysql_num_rows($townquery) == 0) {$off = "2";$frase = "N�o Dispon�vel"; }
		$townrow = mysql_fetch_array($townquery);
	if ($townrow["id"] != 4) {$off = "2";$frase = "N�o Dispon�vel";}//vila da folha
			if ($quests[0] > $i){$porcentagem = 100; $frase = "Miss�o Conclu�da"; $off = 2;}
		}
		
	//porcentagem da pedra
	if ($porcentagem != 100){if ($subtreino[1] == 0){$porcentagem = 0;}else{
	$porcentagem = ceil(($subtreino[1] * 100)/$subtreino[2]);}}
	if ($porcentagem == 0){$pedra = "<img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem > 0) && ($porcentagem < 20)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 20) && ($porcentagem < 40)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 40) && ($porcentagem < 60)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 60) && ($porcentagem < 80)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif (($porcentagem >= 80) && ($porcentagem < 100)){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedravazia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";}
	elseif ($porcentagem == 100){$pedra = "<img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\"><img src=\"images/pedracheia.gif\" title=\"Porcentagem Conclu�da: ".$porcentagem."%\">";$off = "2";$frase = "Miss�o Conclu�da";}
	//fim porcentagem pedra.


	
		//tempo..
	include('funcoesinclusas.php');
	$retorno = tempojutsu($tempojutsuatual[0], $tempojutsuatual[1], $subtreino[3]);
	if (($retorno == "ok") || ($i < $quantidade)){$relogio = "relogio2";$relogiotitle = "Tempo de Espera Conclu�do"; $linkdotreino = "<a href=\"missoes.php?do=missao\">"; $linkdotreino2 = "</a>";
	if ($i < $quantidade){$linkdotreino = ""; $linkdotreino2 = "";}
	}else{$linkdotreino = "<a href=\"missoes.php?do=missao\">"; $linkdotreino2 = "</a>";
		$relogio = "relogio"; $relogiotitle = "Restam ".$retorno." Minutos de Espera";$off = "2";$frase = "N�o Dispon�vel"; }
	if ($subtreino[1] == $subtreino[2]){$linkdotreino = ""; $linkdotreino2 = ""; $relogio = "relogio2";$relogiotitle = "Miss�o Conclu�da";$off = "2";$frase = "Miss�o Conclu�da";
	}//fim tempo.
	
	
	if ($frase == ""){$frase = "Fazer Miss�o Agora";}
	
		//se n�o tiver o q treinar
	if (($subtreino[1] == 0) && ($subtreino[2] == 0)){
		$relogio = "relogio2"; $relogiotitle = "Sem Tempo de Espera para essa Miss�o";
		$off = "";$frase = "Completar Miss�o";
		$linkdotreino = "<a href=\"missoes.php?do=missao\">"; 
		$linkdotreino2 = "</a>";
	}
	
	if ($i < $quantidade){
			$linkdotreino = ""; $linkdotreino2 = "";
			$frase = "Miss�o Conclu�da";
			$relogiotitle = "Miss�o Conclu�da";
			$relogio = "relogio2";
			$off = 2;
	}
			
	$html .= "<table width=\"100%\"><tr bgcolor=\"#613003\"><td width=\"*\"><font color=\"white\">".$subtreino[0]."</font></td><td width=\"17\"><img src=\"images/".$relogio.".gif\" title=\"".$relogiotitle."\"></td><td width=\"17\">$linkdotreino<img src=\"images/treinar$off.gif\" title=\"$frase\" border=\"0\">$linkdotreino2</td><td width=\"84\">$pedra</td><td width=\"20\"><a href=\"javascript:mostrarquest('$i', '$recompensa', '$requerimento', '$localtreino', '$nivel', '$conclusao'$itemprocurado)\"><img src=\"images/setabaixo.gif\" title=\"Mostrar Dados\" border=\"0\"></a></td><td width=\"20\"><a href=\"javascript:escondertreino('$i')\"><img src=\"images/setacima.gif\" title=\"Esconder Dados\" border=\"0\"></a></td></tr></table><div id=\"elemento$i\"></div><br>";

}//fim for





















	
	//se n�o houver nada.
	if (($html == "") && ($conteudodois == "")){header('Location: ./index.php?conteudo=Voc� ainda n�o adquiriu nenhuma miss�o.');die(); }
	
	
	//para aparecer as falas dentro do pergaminho, caso n�o haja nada e caso seja uma mensagem vermelha.
	if(($conteudodois == "") && ($conteudo == "") && ($townrow['name'] == "")){$conteudodois = "<br>";}
	if(($conteudodois == "") && ($conteudo != "") && (mysql_num_rows($townquery) != 0)){$conteudodois = personagemgeral($conteudo, $townrow["id"],$townrow["kage"]); $conteudo = "";}
	elseif(($conteudodois == "") && ($conteudo == "") && ($townrow['name'] != "")){$conteudodois = personagemgeral('Ol� '.$userrow['charname'].'! Voc� est� na(o) '.$townrow['name'].', pretende completar alguma miss�o? Posso ajudar em alguma coisa? Use as op��es abaixo para completar miss�es.', $townrow["id"],$townrow["kage"]); $conteudo = "";}
	
	
	if ($conteudo != ""){$conteudo = "<center><font color=brown>".strip_tags($conteudo)."</font></center><br>";}
		
	
	$page = "<table width=\"100%\"><tr><td width=\"100%\" align=\"center\"><center><img src=\"images/missao.gif\" /></center></td></tr></table>
	$conteudo
	$conteudodois
	$html";
			 
			 display($page, "Miss�es", false, false, false);
	die();
	
	
	
	
}


?>