<?php // enche o hp.



include('lib.php');
$link = opendb();

include('cookies.php');
$userrow = checkcookies();




if (isset($_GET["do"])) {
    
    $do = $_GET["do"];
    if ($do == "jutsu") { jutsu(); }
	elseif ($do == "aprendendo2") { aprendendo2(); }
	elseif ($do == "chamar") { chamar(); }
	}





function jutsu() {
global $userrow;
global $topvar;
$topvar = true;
if ($userrow == false) { display("Por favor fa�a o <a href=\"login.php?do=login\">log in</a> no jogo antes de executar essa a��o.","Erro",false,false,false);
		die(); }
				if ($userrow["currentaction"] == "Fighting") {display("Voc� n�o pode acessar essa fun��o no meio de uma batalha!","Erro",false,false,false);die(); }
			if ($userrow["batalha_timer2"] == 5) {global $topvar;
$topvar = true; display("Voc� n�o pode fazer nenhum movimento enquanto estiver em um duelo. Clique <a href=\"users.php?do=resetarduelo\">aqui</a>, para resetar seu Duelo atual. ","Erro",false,false,false);die(); }




$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) == 0) { display("H� um erro com sua conta, ou com os dados da cidade. Por favor tente novamente.","Error"); die();}
    $townrow = mysql_fetch_array($townquery);
	
if ($townrow["id"] != 2) {display("Voc� n�o pode usar essa fun��o fora da Montanha Myoboku.","Error"); die();}


 $page = "<table width=\"100%\"><tr><td width=\"100%\" align=\"center\"><center><img src=\"images/senjutsu.gif\" /></center></td></tr></table>
 
 <table><tr><td>
 <img src=\"layoutnovo/avatares/kages/2.png\" align=\"left\"><b>Fukasaku diz:</b><br>
 Ol� pequeno ninja, voc� veio at� mim � procura do Senjutsu? O Senjutsu � um tipo de jutsu que precisa de 15 horas de treinamento para ser aperfei�oado, treinando �rduamente. Ele o dar� 40 de for�a e 40 de destreza para enfrentar o inimigo. Se mesmo assim voc� ainda n�o desistiu, podemos <a href=\"senjutsu.php?do=aprendendo2\">come�ar ou continuar agora mesmo</a> o treinamento.<br>


<br><a href=\"index.php\">Voltar � pagina de jogo</a>.
</td></tr></table>
";
   $topnav = "<a href=\"index.php\"><img src=\"images/jogar.gif\" alt=\"Voltar a Jogar\" border=\"0\" /></a><a href=\"help.php\"><img src=\"images/button_help.gif\" alt=\"Ajuda\" border=\"0\" /></a>";
    display($page, "Senjutsu", false, false, false); 

}
















function aprendendo2(){

global $topvar;
global $userrow;
$topvar = true;
    /* testando se est� logado */
		//include('cookies.php');
		//$userrow = checkcookies();
	
		if ($userrow == false) { display("Por favor fa�a o <a href=\"login.php?do=login\">log in</a> no jogo antes de executar essa a��o.","Erro",false,false,false);
		die(); }
				if ($userrow["currentaction"] == "Fighting") {display("Voc� n�o pode acessar essa fun��o no meio de uma batalha!","Erro",false,false,false);die(); }
				if ($userrow["batalha_timer2"] == 5) {global $topvar;
$topvar = true; display("Voc� n�o pode fazer nenhum movimento enquanto estiver em um duelo. Clique <a href=\"users.php?do=resetarduelo\">aqui</a>, para resetar seu Duelo atual. ","Erro",false,false,false);die(); }


$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) == 0) { display("H� um erro com sua conta, ou com os dados da cidade. Por favor tente novamente.","Error"); die();}
    $townrow = mysql_fetch_array($townquery);
	
if ($townrow["id"] != 2) {display("Voc� n�o pode usar essa fun��o fora da Montanha Myoboku.","Error"); die();}

if ($userrow["graduacao"] == "Estudante da Academia") {display("Voc� n�o pode fazer esse treinamento se n�o for ao menos um Genin.","Error"); die();}



		$usuariologadoid = $userrow["id"];
		$usuariologadonome = $userrow["charname"];
		$usuriologadodinaheiro = $userrow["gold"];
		$tempopacabar = $userrow["senjutsutimer"];
		$tempoacabar2 = $tempopacabar % 60; 
		$tempopacabarminutos = floor(($userrow["senjutsutimer"] % 3600)/60);
		$tempopacabarhoras = floor($tempopacabar/3600);
		$jutsudebuscaswitch = $userrow["senjutsuswitch"];
			/*fim do teste */
			
			
			
			
//acabou o jutsu aqui.			
if ($tempopacabar == 0) {


$jutsufinal = "<font color=red>Usu�rio de Senjutsu</font><br>";
$updatequery = doquery("UPDATE {{table}} SET senjutsuhtml='$jutsufinal' WHERE charname='$usuariologadonome' LIMIT 1","users");
$updatequery = doquery("UPDATE {{table}} SET imagem='senjutsu.png' WHERE charname='$usuariologadonome' LIMIT 1","users");


if ($jutsudebuscaswitch == 0) {$updatequery = doquery("UPDATE {{table}} SET senjutsuswitch='5' WHERE charname='$usuariologadonome' LIMIT 1","users");
$userrow["strength"] += 40;
$userrow["dexterity"] += 40;
$updatequery = doquery("UPDATE {{table}} SET strength='".$userrow["strength"]."' WHERE charname='$usuariologadonome' LIMIT 1","users");
$updatequery = doquery("UPDATE {{table}} SET dexterity='".$userrow["dexterity"]."' WHERE charname='$usuariologadonome' LIMIT 1","users");
}
elseif ($jutsudebuscaswitch == 1) {$updatequery = doquery("UPDATE {{table}} SET senjutsuswitch='5' WHERE charname='$usuariologadonome' LIMIT 1","users");
$userrow["strength"] += 40;
$userrow["dexterity"] += 40;
$updatequery = doquery("UPDATE {{table}} SET strength='".$userrow["strength"]."' WHERE charname='$usuariologadonome' LIMIT 1","users");
$updatequery = doquery("UPDATE {{table}} SET dexterity='".$userrow["dexterity"]."' WHERE charname='$usuariologadonome' LIMIT 1","users");
}


$page = "<table width=\"100%\"><tr><td width=\"100%\" align=\"center\"><center><img src=\"images/senjutsu.gif\" /></center></td></tr></table>
 
 <table><tr><td>
 <img src=\"layoutnovo/avatares/kages/2.png\" align=\"left\"><br><b>Fukasaku diz:</b><br>
 Parab�ns! Voc� aprendeu e desenvolveu o Senjutsu com grande destreza!<br>Jamais pensei que voc� fosse capaz de aperfei�o�-lo, seu senjutsu ficar� ativado sempre. Sua for�a aumentou em 40 e sua destreza tamb�m aumentou em 40.

<br><br><a href=\"index.php\">Voltar � pagina de jogo</a>.
</td></tr></table>


";
   $topnav = "<a href=\"index.php\"><img src=\"images/jogar.gif\" alt=\"Voltar a Jogar\" border=\"0\" /></a><a href=\"help.php\"><img src=\"images/button_help.gif\" alt=\"Ajuda\" border=\"0\" /></a>";
    display($page, "Senjutsu", false, false, false); 

die();
}

	
			
			
			
			
			
			
			
			
			
			
			//intermediario



sleep(8);
 
$userrow["senjutsutimer"] -= 10;
if ($userrow["senjutsutimer"] < 1) {$userrow["senjutsutimer"] = 0;}



$updatequery = doquery("UPDATE {{table}} SET senjutsutimer='".$userrow["senjutsutimer"]."' WHERE charname='$usuariologadonome' LIMIT 1","users");
$updatequery = doquery("UPDATE {{table}} SET senjutsuswitch='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
$updatequery = doquery("UPDATE {{table}} SET imagem='senjutsu.png' WHERE charname='$usuariologadonome' LIMIT 1","users");
	
	
     $page = "<table width=\"100%\"><tr><td width=\"100%\" align=\"center\"><center><img src=\"images/senjutsu.gif\" /></center></td></tr></table>
 
 <table><tr><td>
 <img src=\"layoutnovo/avatares/kages/2.png\" align=\"left\"><br><b>Fukasaku diz:</b><br>
 Ainda faltam $tempopacabarhoras hora(s), $tempopacabarminutos minuto(s) e $tempoacabar2 segundos para acabar o treinamento.

<br><br><a href=\"index.php\">Voltar � pagina de jogo</a>.
</td></tr></table>

<meta HTTP-EQUIV='refresh' CONTENT='1;URL=senjutsu.php?do=aprendendo2'>

";
   $topnav = "<a href=\"index.php\"><img src=\"images/jogar.gif\" alt=\"Voltar a Jogar\" border=\"0\" /></a><a href=\"help.php\"><img src=\"images/button_help.gif\" alt=\"Ajuda\" border=\"0\" /></a>";
    display($page, "Senjutsu", false, false, false); 


die();

	    
}










function chamar() {
global $userrow;
global $topvar;
$topvar = true;
if ($userrow == false) { display("Por favor fa�a o <a href=\"login.php?do=login\">log in</a> no jogo antes de executar essa a��o.","Erro",false,false,false);
		die(); }
				if ($userrow["currentaction"] == "Fighting") {display("Voc� n�o pode acessar essa fun��o no meio de uma batalha!","Erro",false,false,false);die(); }
			if ($userrow["batalha_timer2"] == 5) {global $topvar;
$topvar = true; display("Voc� n�o pode fazer nenhum movimento enquanto estiver em um duelo. Clique <a href=\"users.php?do=resetarduelo\">aqui</a>, para resetar seu Duelo atual. ","Erro",false,false,false);die(); }

$usuariologadonome = $userrow["charname"];


$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) == 0) { display("H� um erro com sua conta, ou com os dados da cidade. Por favor tente novamente.","Error"); die();}
    $townrow = mysql_fetch_array($townquery);
	
if ($townrow["id"] != 2) {display("Voc� n�o pode usar essa fun��o fora da Montanha Myoboku.","Error"); die();}


	$updatequery = doquery("UPDATE {{table}} SET avatar='16' WHERE charname='$usuariologadonome' LIMIT 1","users");


 $page = "<table width=\"100%\"><tr><td width=\"100%\" align=\"center\"><center><img src=\"images/grupar.gif\" /></center></td></tr></table>
 
 <table><tr><td>
 <img src=\"layoutnovo/avatares/kages/2.png\" align=\"left\"><br><br><b>Fukasaku diz:</b><br>
 Est� precisando de mim? Voc� quer que eu entre no seu grupo? N�o h� problema, Shima e eu iremos com voc� em sua jornada. Agora fazemos parte do seu grupo!


<br><a href=\"index.php\">Voltar � pagina de jogo</a>.
</td></tr></table>
";
   $topnav = "<a href=\"index.php\"><img src=\"images/jogar.gif\" alt=\"Voltar a Jogar\" border=\"0\" /></a><a href=\"help.php\"><img src=\"images/button_help.gif\" alt=\"Ajuda\" border=\"0\" /></a>";
    display($page, "Chamar", false, false, false); 

}






?>