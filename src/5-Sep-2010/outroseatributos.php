<?php // enche o hp.



include('lib.php');
$link = opendb();

include('cookies.php');
$userrow = checkcookies();

//status de recupera��o



if (isset($_GET["do"])) {
    
    $do = $_GET["do"];
    if ($do == "atributos") { atributos(); }
	}





function atributos() {
global $topvar;
$topvar = true;
    /* testando se est� logado */
		//include('cookies.php');
		//$userrow = checkcookies();
		global $userrow;



		if ($userrow == false) { display("Por favor fa�a o <a href=\"login.php?do=login\">log in</a> no jogo antes de executar essa a��o.","Erro",false,false,false);
		die(); }
		
		//chamando variaveis de atributo
		$agilidade = $userrow["agilidade"];
$determinacao = $userrow["determinacao"];
$sorte = $userrow["sorte"];
$precisao = $userrow["precisao"];
$inteligencia = $userrow["inteligencia"];
$pontoatributos = $userrow["pontoatributos"];

//outra
	$usuariologadonome = $userrow["charname"];
		
		
		if ($userrow["batalha_timer2"] == 5) {global $topvar;
$topvar = true; display("Voc� n�o pode fazer nenhum movimento enquanto estiver em um duelo. Clique <a href=\"users.php?do=resetarduelo\">aqui</a>, para resetar seu Duelo atual. ","Erro",false,false,false);die(); }

					if ($userrow["currentaction"] == "Fighting") {header('Location: /narutorpg/index.php?do=fight&conteudo=Voc� n�o pode acessar essa fun��o no meio de uma batalha!');die(); }
				
	
		
			
				
	
	
    if (isset($_POST["submit"])) {
        extract($_POST);
		if ($agilidadep == ""){$agilidadep = 0;}
		if ($sortep == ""){$sortep = 0;}
		if ($determinacaop == ""){$determinacaop = 0;}
		if ($precisaop == ""){$precisaop = 0;}
		if ($inteligenciap == ""){$inteligenciap = 0;}
		if (!is_numeric($agilidadep)) { display("A distrubui��o de agilidade deve ser um n�mero.","Erro",false,false,false);die(); }
		if (!is_numeric($sortep)) { display("A distrubui��o de sorte deve ser um n�mero.","Erro",false,false,false);die(); }
		if (!is_numeric($determinacaop)) { display("A determina��o de sorte deve ser um n�mero.","Erro",false,false,false);die(); }
		if (!is_numeric($precisaop)) { display("A precis�o de sorte deve ser um n�mero.","Erro",false,false,false);die(); }
		if (!is_numeric($inteligenciap)) { display("A intelig�ncia de sorte deve ser um n�mero.","Erro",false,false,false);die(); }
		$agilidadep = floor($agilidadep);
		$sortep = floor($sortep);
		$determinacaop = floor($determinacaop);
		$precisaop = floor($precisaop);
		$inteligenciap = floor($inteligenciap);
		
		
        $pontostotal = $agilidadep + $sortep + $determinacaop + $precisaop + $inteligenciap;

		/*if ($userrow["password"] != md5($oldpass)) { die("The old password you provided was incorrect."); }
        /*$realnewpass = md5($newpass1); */
		if ($pontostotal > $pontoatributos) { display("Voc� n�o pode distribuir mais pontos que voc� tem.","Erro",false,false,false);die(); }
		
			
		$pontosrestantes = $pontoatributos - $pontostotal;
			
$determinacao += $determinacaop;
$sorte += $sortep;
$precisao += $precisaop;
$inteligencia += $inteligenciap;
$agilidade += $agilidadep;
				
		$updatequery = doquery("UPDATE {{table}} SET agilidade='$agilidade' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET determinacao='$determinacao' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET precisao='$precisao' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET inteligencia='$inteligencia' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET sorte='$sorte' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET pontoatributos='$pontosrestantes' WHERE charname='$usuariologadonome' LIMIT 1","users");
		
        
				
        display("Seus pontos foram distribuidos corretamente.<br /><br />Voc� pode <a href=\"index.php\">clicar aqui</a> para continuar jogando ou <a href=\"outroseatributos.php?do=atributos\">distribuir mais pontos</a>.","Distribuir Pontos",false,false,false);
        die();
    }
    $page = "<table width=\"100%\"><tr><td width=\"100%\" align=\"center\"><center><img src=\"images/distribuir.gif\" /></center></td></tr></table>
	
	<b>Pontos para Distribuir</b>: $pontoatributos<br><br>
	<br>
	<b>Pontos j� Distribu�dos</b>:<br>
	Agilidade: $agilidade<br>
	Sorte: $sorte<br>
	Determina��o: $determinacao<br>
	Precis�o: $precisao<br>
	Intelig�ncia: $inteligencia<br><br><br><b>Distribuir Pontos</b>:<br>"
	.gettemplate("outroseatributos");
   $topnav = "<a href=\"index.php\"><img src=\"images/jogar.gif\" alt=\"Voltar a Jogar\" border=\"0\" /></a><a href=\"help.php\"><img src=\"images/button_help.gif\" alt=\"Ajuda\" border=\"0\" /></a>";
    display($page, "Distribuir Pontos", false, false, false); 
    
}
















?>