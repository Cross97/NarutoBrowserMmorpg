<?php // users.php :: Handles user account functions.


/*$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);*/



include('lib.php');
$link = opendb();

include('cookies.php');
$userrow = checkcookies();


		

	

if (isset($_GET["do"])) {
    
    $do = $_GET["do"];
    if ($do == "falar") { falar(); }
	}

function falar() {
global $topvar;
$topvar = true;
    /* testando se est� logado */
		//include('cookies.php');
		//$userrow = checkcookies();
		global $userrow;

		if ($userrow == false) { display("Por favor fa�a o <a href=\"login.php?do=login\">log in</a> no jogo antes de executar essa a��o.","Erro",false,false,false);
		die(); }
		if ($userrow["currentaction"] != "In Town") {display("Voc� s� pode acessar essa fun��o quando estiver em uma cidade! Clique <a href=\"index.php\">aqui</a> para voltar ao jogo.","Erro",false,false,false);die(); }
					if ($userrow["currentaction"] == "Fighting") {header('Location: /narutorpg/index.php?do=fight&conteudo=Voc� n�o pode acessar essa fun��o no meio de uma batalha!');die(); }					
					if ($userrow["batalha_timer2"] == 5) {global $topvar;
$topvar = true; display("Voc� n�o pode fazer nenhum movimento enquanto estiver em um duelo. Clique <a href=\"users.php?do=resetarduelo\">aqui</a>, para resetar seu Duelo atual. ","Erro",false,false,false);die(); }

		//dados do personagem
		$usuariologadonome = $userrow["charname"];
		$usuariologadodinheiro = $userrow["gold"];
		
		
		$missao = $userrow["missao"];
		$longitude = $userrow["longitude"];
		$latitude = $userrow["latitude"];
		$missaoswitch = $userrow["missaoswitch"];
		$missaotimer = $userrow["missaotimer"];
		//outro � missaoswitch
		//missaotimer � o de tempo com padr�o 600
$missao2 = $missao + 1;
//fim dos dados


$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) == 0) { display("H� um erro com sua conta, ou com os dados da cidade. Por favor tente novamente.","Error"); die();}
    $townrow = mysql_fetch_array($townquery);










//meio da missao 6
if ($missao2 == 6) {


	
if ($townrow["id"] != 4) {display("<center><img src=\"images/fala.gif\"></center><center><table width=\"450\"><tr><td><b>Voc� n�o pode usar essa fun��o fora do P�is da �gua.</td></tr></table></center>","Error"); die();}
//acaba aquidisplay("Voc� n�o pode usar essa fun��o fora do Pa�s do Fogo.","Error"); die();}






$updatequery = doquery("UPDATE {{table}} SET missaoswitch='1' WHERE charname='$usuariologadonome' LIMIT 1","users");


$falaaberta = "
<b>Mizukuri diz</b>:<br>
Ol� forasteiro, voc� est� procurando informa��o sobre Alquimia?<br>
Posso te contar o que eu sei sobre o assunto...<br>
O processo de Alquimia, foi usado na primeira grande guerra ninja, com objetivo de criar espadas de elemento Raiton, esse processo foi completado com sucesso, apesar da grande dificuldade... Durante o processo de Alquimia, voc� trabalha os compostos de dois materiais distintos e as junta em um s� material...<br>
Bem... isso � tudo que eu sei...
";
}//fim 












//alde� de konoha
if ($townrow["id"] == 1) {


	




$falaaberta = "
<b>Chouji diz</b>:<br>
Tome cuidado amigo, � medida que voc� se afasta mais do Pa�s do Fogo, inimigos mais fortes vir�o...<br>
Seja bem cauteloso...<br><br>
<b>Ino diz:</b><br>
Voc� n�o quer comprar flores?<br><br>
<b>Shizune diz:</b><br>
Voc� parece bem cansado...<br>
Descanse um pouco... Voc� vai se sentir melhor...<br><br>
<b>Kiba diz:</b><br>
A cara 5 quadrados para fora da cidade, em qualquer dire��o, o n�vel dos monstros sobe em 1...<br><br>
<b>Gai-sensei diz:</b><br>
Meu pupilo, o tempo para recuperar HP e Chakra dentro da cidade, � diferente do tempo pra recuperar fora dela...<br>
Na cidade, voc� demora 3 segundos pra encher 1 HP e fora das cidades, voc� demora 10 segundos...<br><br>
<b>Tenten diz:</b><br>
Na p�gina de ajuda, voc� pode conferir as tabelas de monstros, itens e tudo mais!<br><br>
<b>Neji diz:</b><br>
Cuidado para n�o morrer!<br>
Se voc� morrer voc� perde metade do seu Ryou que est� com voc�!";
}//fim 















//meio da missao 9
if ($missao2 == 9) {


	
if ($townrow["id"] != 2) {display("<center><img src=\"images/fala.gif\"></center><center><table width=\"450\"><tr><td><b>Voc� n�o pode usar essa fun��o fora da Montanha Myoboku.</td></tr></table></center>","Error"); die();}
//acaba aquidisplay("Voc� n�o pode usar essa fun��o fora do Pa�s do Fogo.","Error"); die();}






$updatequery = doquery("UPDATE {{table}} SET missaoswitch='1' WHERE charname='$usuariologadonome' LIMIT 1","users");


$falaaberta = "
<b>Velho Sapo Anci�o diz</b>:<br>
Ol� meu jovem...<br>
Percebo que voc� quer ter informa��es sobre as Espadas Raiga...<br>
Hhmm...<br>
Tente n�o brincar com isso... As Espadas Raiga n�o s�o para brincadeira...<br>
Vou direto ao assunto...<br>
Um grande shinobi do Pa�s do Vento, conseguiu controlar as Espadas Raiga...<br>
Fazendo a alquimia de dois itens muito importantes... Um deles era uma Espada...<br>
Essa informa��o � tudo que fiquei sabendo na �poca...
";
}//fim 









//alde� do vento
if ($townrow["id"] == 5) {


	




$falaaberta = "
<b>Temari diz</b>:<br>
A akatsuki est� agindo...<br>
Melhor tomar cuidado...
";
}//fim 













  
	if ($falaaberta == ""){$falafinal = "Nenhum alde�o quis te dar aten��o nesse pa�s...";}

	

	
    $page = "<table width=\"100%\"><tr><td width=\"100%\" align=\"center\"><center><img src=\"images/fala.gif\" /></center></td></tr></table>
	$falaaberta
	$falafinal<br><br>
	Voc� pode <a href=\"index.php\">retornar � tela principal</a>.
	
";
   $topnav = "<a href=\"index.php\"><img src=\"images/jogar.gif\" alt=\"Voltar a Jogar\" border=\"0\" /></a><a href=\"help.php\"><img src=\"images/button_help.gif\" alt=\"Ajuda\" border=\"0\" /></a>";
    display($page, "Procurar Informa��es", false, false, false); 
    
}














?>