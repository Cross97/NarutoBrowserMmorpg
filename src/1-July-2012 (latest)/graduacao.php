<?php // users.php :: Handles user account functions.


/*$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);*/



include('lib.php');
$link = opendb();

include('cookies.php');
$userrow = checkcookies();

include('funcoesinclusas.php');
		
	
//n�o pode se graduar
$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) == 0) { display("H� um erro com sua conta, ou com os dados da cidade. Por favor tente novamente.","Error"); die();}
$townrow = mysql_fetch_array($townquery);
if (($townrow['id'] != 1) && ($townrow['id'] != 3)){header('Location: index.php?conteudo=Voc� n�o pode se graduar aqui, uma tentativa de trapa�a foi detectada!');die();}
	

if (isset($_GET["do"])) {
    
    $do = $_GET["do"];
    if ($do == "graduar") { graduar(); }
	elseif ($do == "graduacao") { graduacao(); }
	}


function graduar() {
global $topvar;
$topvar = true;
    /* testando se est� logado */
		//include('cookies.php');
		//$userrow = checkcookies();
		global $userrow;

		if ($userrow == false) { display("Por favor fa�a o <a href=\"login.php?do=login\">log in</a> no jogo antes de executar essa a��o.","Erro",false,false,false);
		die(); }
		if ($userrow["currentaction"] != "In Town") {if ($userrow["currentaction"] == "Fighting"){header('Location: ./index.php?do=fight&conteudo=Voc� s� pode acessar essa fun��o dentro de uma cidade!');die();}else{header('Location: ./index.php?conteudo=Voc� s� pode acessar essa fun��o dentro de uma cidade!');die();} }
					if ($userrow["currentaction"] == "Fighting") {header('Location: ./index.php?do=fight&conteudo=Voc� n�o pode acessar essa fun��o no meio de uma batalha!');die();}		
					if ($userrow["batalha_timer2"] == 5) {global $topvar;
$topvar = true; display("Voc� n�o pode fazer nenhum movimento enquanto estiver em um duelo. Clique <a href=\"users.php?do=resetarduelo\">aqui</a>, para resetar seu Duelo atual. ","Erro",false,false,false);die(); }

		//dados do personagem
		$usuariologadonome = $userrow["charname"];
		$usuariologadodinheiro = $userrow["gold"];
		$graduacao = $userrow["graduacao"];
		$missao2 = explode(",", $userrow["missao"]);
		$missao = $missao2[0];
		



//graduar genin
if ($graduacao == "Estudante da Academia") {

if ($missao < 7) {
	$fala = personagemgeral('Voc� precisa completar 7 miss�es ninjas para graduar-se um Genin.', $townrow['id'], $townrow['kage']);
	graduacao($fala);
	die();	
}

$graduacaoaberta = "Parab�ns! Agora voc� � um <b>Genin</b>!<br>
Voc� ganhou:<br>
<ul>
<li />20 Pontos de Distribui��o.
<li />20 Pontos de Natureza.
<li />10 Pontos de Vida.
<li />10 Pontos de Chakra.
</ul>";

$userrow["pontoatributos"] += 20;
$userrow["maxhp"] += 10;
$userrow["currenthp"] += 10;
$userrow["maxmp"] += 10;
$userrow["maxnp"] += 20;
$userrow["currentnp"] += 20;
$userrow["currentmp"] += 10;

$updatequery = doquery("UPDATE {{table}} SET pontoatributos='".$userrow["pontoatributos"]."', maxhp='".$userrow["maxhp"]."', currenthp='".$userrow["currenthp"]."', maxmp='".$userrow["maxmp"]."', currentmp='".$userrow["currentmp"]."', graduacao='Genin', currentnp='".$userrow["currentnp"]."', maxnp='".$userrow["maxnp"]."'  WHERE charname='$usuariologadonome' LIMIT 1","users");

}
//fim graduar genin












//graduar chuunin
if ($graduacao == "Genin") {


$foi = 0;
for ($i == 1; $i < 5; $i++){$bp[$i] = explode(",", $userrow["bp".$i]);}
if ($userrow["slot1name"] == "Esperan�a do Chuunin") {$foi = 1;}
elseif ($userrow["slot2name"] == "Esperan�a do Chuunin") {$foi = 2;}
elseif ($userrow["slot3name"] == "Esperan�a do Chuunin") {$foi = 3;}
elseif ($bp[1][0] == "Esperan�a do Chuunin"){$foi = 4;}
elseif ($bp[2][0] == "Esperan�a do Chuunin"){$foi = 5;}
elseif ($bp[3][0] == "Esperan�a do Chuunin"){$foi = 6;}
elseif ($bp[4][0] == "Esperan�a do Chuunin"){$foi = 7;}


//stop zone
if($foi == 0) {	$fala = personagemgeral('Voc� precisa trazer o item Esperan�a do Chuunin para graduar-se um Chuunin.', $townrow['id'], $townrow['kage']);
	graduacao($fala);
	die();
}
if($foi <= 3) {$fala = personagemgeral('Primeiro coloque o item <b>Esperan�a do Chuunin</b> na sua mochila.', $townrow['id'], $townrow['kage']);
	graduacao($fala);
	die();
}
if ($missao < 10){
	$fala = personagemgeral('Voc� precisa completar 10 miss�es ninjas para graduar-se um Chuunin.', $townrow['id'], $townrow['kage']);
	graduacao($fala);
	die();
	}
//fim da stop zone


$graduacaoaberta = "Parab�ns! Agora voc� � um <b>Chuunin</b>!<br>
Voc� ganhou:<br>
<ul>
<li />30 Pontos de Distribui��o.
<li />30 de For�a.
<li />30 de Destreza.
</ul>";

$userrow["pontoatributos"] += 30;
$userrow["strength"] += 30;
$userrow["dexterity"] += 30;
$userrow["attackpower"] += 30;
$userrow["defensepower"] += 30;


$updatequery = doquery("UPDATE {{table}} SET pontoatributos='".$userrow["pontoatributos"]."', strength='".$userrow["strength"]."', dexterity='".$userrow["dexterity"]."', graduacao='Chuunin', defensepower='".$userrow["defensepower"]."', attackpower='".$userrow["attackpower"]."' WHERE charname='$usuariologadonome' LIMIT 1","users");


//tirando o item
	if ($foi <= 3){
		$updatequery = doquery("UPDATE {{table}} SET slot".$foi."name='None',slot".$foi."id='0' WHERE charname='$usuariologadonome' LIMIT 1","users");

	}else{
		$updatequery = doquery("UPDATE {{table}} SET bp".($foi - 3)."='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
	}


}
//fim graduar chuunin












//graduar jounin
if ($graduacao == "Chuunin") {


$foi = 0;
for ($i == 1; $i < 5; $i++){$bp[$i] = explode(",", $userrow["bp".$i]);}
if ($userrow["slot1name"] == "For�a In�til") {$foi = 1;}
elseif ($userrow["slot2name"] == "For�a In�til") {$foi = 2;}
elseif ($userrow["slot3name"] == "For�a In�til") {$foi = 3;}
elseif ($bp[1][0] == "For�a In�til"){$foi = 4;}
elseif ($bp[2][0] == "For�a In�til"){$foi = 5;}
elseif ($bp[3][0] == "For�a In�til"){$foi = 6;}
elseif ($bp[4][0] == "For�a In�til"){$foi = 7;}


//zona stop
if($foi == 0) {$fala = personagemgeral('Voc� ainda n�o possui o item <b>For�a In�til</b> para graduar-se um Jounin.', $townrow['id'], $townrow['kage']);
	graduacao($fala);
	die();
}
if($foi <= 3) {$fala = personagemgeral('Primeiro coloque o item <b>For�a In�til</b> na sua mochila.', $townrow['id'], $townrow['kage']);
	graduacao($fala);
	die();
}
if($userrow['level'] < 30) {$fala = personagemgeral('Voc� precisa ter level 30 para graduar-se um Jounin.', $townrow['id'], $townrow['kage']);
	graduacao($fala);
	die();
}
if($missao < 20) {$fala = personagemgeral('Voc� precisa completar 20 miss�es ninjas para graduar-se um Jounin.', $townrow['id'], $townrow['kage']);
	graduacao($fala);
	die();
}

//fim zona stop.


$graduacaoaberta = "Parab�ns! Agora voc� � um <b>Jounin</b>!<br>
Voc� ganhou:<br>
<ul>
<li />100 Pontos de Distribui��o.
<li />20 Pontos de Natureza.
<li />20 de For�a.
<li />20 de Destreza.
<li />5% de B�nus de Experi�ncia.
<li />5% de B�nus de Ryou.
<li />Voc� ganhou o Item: <font color=red>Vit�ria do Jounin</font>.
</ul>";

$userrow["pontoatributos"] += 100;
$userrow["goldbonus"] += 5;
$userrow["expbonus"] += 5;
$userrow["maxnp"] += 20;
$userrow["dexterity"] += 20;
$userrow["defensepower"] += 20;
$userrow["currentnp"] += 20;
$userrow["attackpower"] += 25; //5 de for�a j� � do item que retira.
$userrow["strength"] += 20;



$updatequery = doquery("UPDATE {{table}} SET pontoatributos='".$userrow["pontoatributos"]."', goldbonus='".$userrow["goldbonus"]."', expbonus='".$userrow["expbonus"]."', graduacao='Jounin', maxnp='".$userrow["maxnp"]."', currentnp='".$userrow["currentnp"]."',attackpower='".$userrow["attackpower"]."', defensepower='".$userrow["defensepower"]."', strength='".$userrow["strength"]."', dexterity='".$userrow["dexterity"]."', bp".($foi - 3)."='Vit�ria do Jounin,43,4,X'  WHERE charname='$usuariologadonome' LIMIT 1","users");


}
//fim graduar jounin















  
		
	if ($graduacaoaberta == ""){$graduacaoaberta = "Desculpe ".$userrow['charname'].", mas n�o h� gradua��es dispon�veis no momento ou voc� n�o tem os requerimentos para graduar-se.";}
	
	
	//conteudo finalda pag
	$fala = personagemgeral($graduacaoaberta, $townrow['id'], $townrow['kage']);
	graduacao($fala);
	die();
    
}

















function graduacao($fala) {
global $topvar;
$topvar = true;
    /* testando se est� logado */
		//include('cookies.php');
		//$userrow = checkcookies();
		global $userrow;

		if ($userrow == false) { display("Por favor fa�a o <a href=\"login.php?do=login\">log in</a> no jogo antes de executar essa a��o.","Erro",false,false,false);
		die(); }
		if ($userrow["currentaction"] != "In Town") {if ($userrow["currentaction"] == "Fighting"){header('Location: ./index.php?do=fight&conteudo=Voc� s� pode acessar essa fun��o dentro de uma cidade!');die();}else{header('Location: ./index.php?conteudo=Voc� s� pode acessar essa fun��o dentro de uma cidade!');die();} }
					if ($userrow["currentaction"] == "Fighting") {header('Location: ./index.php?do=fight&conteudo=Voc� n�o pode acessar essa fun��o no meio de uma batalha!');die(); }					
					if ($userrow["batalha_timer2"] == 5) {global $topvar;
$topvar = true; display("Voc� n�o pode fazer nenhum movimento enquanto estiver em um duelo. Clique <a href=\"users.php?do=resetarduelo\">aqui</a>, para resetar seu Duelo atual. ","Erro",false,false,false);die(); }

		//dados do personagem
		$usuariologadonome = $userrow["charname"];
		$usuariologadodinheiro = $userrow["gold"];
		$graduacao = $userrow["graduacao"];
		$missao = $userrow["missao"];


//cidade para imagem do kage
$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) == 0) { display("H� um erro com sua conta, ou com os dados da cidade. Por favor tente novamente.","Error"); die();}
    $townrow = mysql_fetch_array($townquery);

if ($graduacao == "Estudante da Academia"){$prox = "Genin";}
elseif ($graduacao == "Genin"){$prox = "Chuunin";}
elseif ($graduacao == "Chuunin"){$prox = "Jounin";}

if ($fala == ""){$fala = personagemgeral('Ol� '.$userrow['charname'].'! A pr�xima gradua��o dispon�vel para voc� � a gradua��o de '.$prox.', caso voc� possua os requerimentos, voc� pode se graduar abaixo agora mesmo. As gradua��es te dar�o b�nus para que voc� se torne um shinobi ainda mais completo.', $townrow['id'], $townrow['kage']);}



$page = "<table width=\"100%\"><tr><td width=\"100%\" align=\"center\"><center><img src=\"images/graduacao.gif\" /></center></td></tr></table>
$fala
";


for ($i = 1; $i < 5; $i++){
	if ($i == 1){$nomeelemento = "Gradua��o Inicial: Estudante da Academia."; $requerimento = "Nenhum."; $bonus = "Nenhum."; $itemprocurado = ""; $off = "2"; $linkdotreino = ""; $linkdotreino2 = ""; $frase = "Conclu�do";}
	
	elseif ($i == 2){$nomeelemento = "Gradua��o 1: Genin."; $requerimento = "Ser um Estudante da Academia, completar 7 miss�es ninjas."; $bonus = "20 Pontos de Distribui��o, 20 Pontos de Natureza, 10 Pontos de Vida, 10 Pontos de Chakra."; $itemprocurado = ""; 
		if ($graduacao == "Estudante da Academia"){$off = ""; $linkdotreino = "<a href=\"graduacao.php?do=graduar\">"; $linkdotreino2 = "</a>"; $frase = "Graduar-se";}
		else{$off = "2"; $linkdotreino = ""; $linkdotreino2 = ""; $frase = "Conclu�do";}
	
	}
	
	elseif ($i == 3){$nomeelemento = "Gradua��o 2: Chuunin."; $requerimento = "Ser um Genin, obter o item <b>Esperan�a do Chuunin</b>, completar 10 miss�es ninjas."; $bonus = "30 de For�a, 30 de Destreza, 30 Pontos de Distribui��o."; $itemprocurado = ", 'Esperan�a do Chuunin'";
			if ($graduacao == "Genin"){$off = ""; $linkdotreino = "<a href=\"graduacao.php?do=graduar\">"; $linkdotreino2 = "</a>"; $frase = "Graduar-se";}
		    elseif(($graduacao == "Jounin") || ($graduacao == "Chuunin")){$off = "2"; $linkdotreino = ""; $linkdotreino2 = ""; $frase = "Conclu�do";}
			else{$off = "2"; $linkdotreino = ""; $linkdotreino2 = ""; $frase = "Indispon�vel";}
	}
	
	
	elseif ($i == 4){$nomeelemento = "Gradua��o 3: Jounin."; $requerimento = "Ser um Chuunin, obter o item <b>For�a In�til</b>, completar 20 miss�es ninjas, possuir level 30+."; $bonus = "100 Pontos de Distribui��o, 20 Pontos de Natureza, 20 de For�a, 20 de Destreza, 5% de B�nus de Experi�ncia, 5% de B�nus de Ryou, Item: <b>Vit�ria do Jounin</b>."; $itemprocurado = ", 'For�a In�til'";
			if ($graduacao == "Chuunin"){$off = ""; $linkdotreino = "<a href=\"graduacao.php?do=graduar\">"; $linkdotreino2 = "</a>"; $frase = "Graduar-se";}
		    elseif($graduacao == "Jounin"){$off = "2"; $linkdotreino = ""; $linkdotreino2 = ""; $frase = "Conclu�do";}
			else{$off = "2"; $linkdotreino = ""; $linkdotreino2 = ""; $frase = "Indispon�vel";}
	}
	
	
	$page .= "<table width=\"100%\"><tr bgcolor=\"#613003\"><td width=\"*\"><font color=\"white\">$nomeelemento</font></td><td width=\"17\">$linkdotreino<img src=\"images/treinar$off.gif\" title=\"$frase\" border=\"0\">$linkdotreino2</td><td width=\"20\"><a href=\"javascript:mostrargraduacao('elemento$i', '$requerimento', '$bonus'$itemprocurado)\"><img src=\"images/setabaixo.gif\" title=\"Mostrar Dados\" border=\"0\"></a></td><td width=\"20\"><a href=\"javascript:escondertreino('$i')\"><img src=\"images/setacima.gif\" title=\"Esconder Dados\" border=\"0\"></a></td></tr></table><div id=\"elemento$i\"></div><br>";
}

   $topnav = "<a href=\"index.php\"><img src=\"images/jogar.gif\" alt=\"Voltar a Jogar\" border=\"0\" /></a><a href=\"help.php\"><img src=\"images/button_help.gif\" alt=\"Ajuda\" border=\"0\" /></a>";
    display($page, "Gradua��o", false, false, false); 



}




?>