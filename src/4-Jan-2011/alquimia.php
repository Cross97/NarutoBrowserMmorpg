<?php // users.php :: Handles user account functions.


/*$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);*/



include('lib.php');
$link = opendb();

include('cookies.php');
$userrow = checkcookies();


//n�o pode se graduar
$townquery = doquery("SELECT * FROM {{table}} WHERE latitude='".$userrow["latitude"]."' AND longitude='".$userrow["longitude"]."' LIMIT 1", "towns");
if (mysql_num_rows($townquery) == 0) { display("H� um erro com sua conta, ou com os dados da cidade. Por favor tente novamente.","Error"); die();}
$townrow = mysql_fetch_array($townquery);
if (($townrow['id'] != 2) && ($townrow['id'] != 5)){header('Location: index.php?conteudo=Voc� n�o pode usar a alquimia aqui, uma tentativa de trapa�a foi detectada!');die();}		

	

if (isset($_GET["do"])) {
    
    $do = $_GET["do"];
    if ($do == "fundir") { fundir(); }
	}

function fundir() {
$frase = $_GET['frase'];
global $topvar;
$topvar = true;
    /* testando se est� logado */
		//include('cookies.php');
		//$userrow = checkcookies();
		global $userrow;

		if ($userrow == false) { display("Por favor fa�a o <a href=\"login.php?do=login\">log in</a> no jogo antes de executar essa a��o.","Erro",false,false,false);
		die(); }
		if ($userrow["currentaction"] != "In Town") {if ($userrow["currentaction"] == "Fighting"){header('Location: /narutorpg/index.php?do=fight&conteudo=Voc� s� pode acessar essa fun��o dentro de uma cidade!');die();}else{header('Location: /narutorpg/index.php?conteudo=Voc� s� pode acessar essa fun��o dentro de uma cidade!');die();} }
					if ($userrow["currentaction"] == "Fighting") {header('Location: /narutorpg/index.php?do=fight&conteudo=Voc� n�o pode acessar essa fun��o no meio de uma batalha!');die(); }
					
					if ($userrow["batalha_timer2"] == 5) {global $topvar;
$topvar = true; display("Voc� n�o pode fazer nenhum movimento enquanto estiver em um duelo. Clique <a href=\"users.php?do=resetarduelo\">aqui</a>, para resetar seu Duelo atual. ","Erro",false,false,false);die(); }

		
		$usuariologadonome = $userrow["charname"];
		
		
		
		
	//oque vai aparecer na p�gina:
	$tabelabapagina = "<form action=\"alquimia.php?do=fundir\" method=\"post\"><table>
	<tr bgcolor=\"#452202\"><td colspan=3><font color=white>Mochila</font></td></tr>
	<tr bgcolor=\"#613003\"><td><font color=white>*</font></td><td><font color=white>*</font></td><td><font color=white>Nome</font></td></tr>";
	for ($j = 1;$j < 5; $j++){
	//fundo da tabela
	$fundo = $j % 2;
	if ($fundo == 0) {$bgcolor = "#E4D094";}else{$bgcolor = "#FFF1C7";}
	//fim fundo tabela
	$mochilaseparar = explode(",",$userrow["bp".$j]);
	$img = "orb_img";
	if ($mochilaseparar[2] == 1) {$img = "icon_weapon";}
	if ($mochilaseparar[2] == 2) {$img = "icon_armor";}
	if ($mochilaseparar[2] == 3) {$img = "icon_shield";}
	if ($mochilaseparar[2] > 3) {$img = "orb";}
	if ($mochilaseparar[1] == "mp") {$img = "potion";}
	if ($mochilaseparar[1] == "hp") {$img = "potion";}
	if ($mochilaseparar[1] == "bp") {$img = "backpack_pequena";}
	if ($mochilaseparar[1] == "dia") {$img = "diamond";}
	if ($mochilaseparar[1] == "per") {$img = "parchment";}
	if ($mochilaseparar[1] == "hm") {$img = "potion";}
	if ($mochilaseparar[1] == "hmt") {$img = "potion";}
	if ($mochilaseparar[1] == "tp") {$img = "potion";}
	if ($mochilaseparar[1] == "bk") {$img = "book";}
	if ($mochilaseparar[3] == "X") {$dur = "INF";}else{$dur = $mochilaseparar[3];}
	$tabelabapagina .= "<tr bgcolor=\"$bgcolor\"><td><input type=\"checkbox\" name=\"bpnome".$j."\" value =\"".$mochilaseparar[0]."\"></td><td><img src=\"images/$img.gif\" title=\"Durabilidade: ".$dur."\"/></td><td>".$mochilaseparar[0]."</td></tr>";
	}
	$tabelabapagina .="<tr><td colspan=\"3\"><center><input type=\"submit\" name=\"submit\" value=\"Fundir Itens\" /> </center></td></tr></table></form>";	
	//fim do que vai aparecer na pagina
	

	
    if (isset($_POST["submit"])) {
        extract($_POST);
		
		
		//saber quantos itens foram selecionados para fundir.
		$qantos = 0;
		if ($bpnome1 != ""){$qantos += 1;}
		if ($bpnome2 != ""){$qantos += 1;}
		if ($bpnome3 != ""){$qantos += 1;}
		if ($bpnome4 != ""){$qantos += 1;}
		//fim
        
		
		$usuariologadonome = $userrow["charname"];
		
		
if ($qantos == 2){//se forem dois itens que est�o sendo fundidos...		

				
				// ESPADAS RAIGA
				   //item1 
				$certo = 0;    
			  if ($bpnome1 == "Espadas de Rai"){$numerobancop = 1; $certo += 1;}
			  elseif ($bpnome2 == "Espadas de Rai"){$numerobancop = 2;$certo += 1;}
			  elseif ($bpnome3 == "Espadas de Rai"){$numerobancop = 3;$certo += 1;}
			  elseif ($bpnome4 == "Espadas de Rai"){$numerobancop = 4;$certo += 1;}

			  //item 2
			  if ($bpnome1 == "Mem�ria de Konoha"){$numerobancos = 1;$certo += 1;}
			  elseif ($bpnome2== "Mem�ria de Konoha"){$numerobancos = 2;$certo += 1;}
			  elseif ($bpnome3 == "Mem�ria de Konoha"){$numerobancos = 3;$certo += 1;}
			  elseif ($bpnome4 == "Mem�ria de Konoha"){$numerobancos = 4;$certo += 1;}

			  
					if($certo == 2) {
				
				   //retirando o item 2 da backpack
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
				//colocando o item da fus�o
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancop='Espadas Raiga,34,1,X' WHERE charname='$usuariologadonome' LIMIT 1","users");


				//mostrar a resposta
				$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu Espadas de Rai e Mem�ria de Konoha e obteve Espadas Raiga!";
				}
				
			

						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						// PROTETOR DA AREIA
				   //item1     
				   $certo = 0;  
			  if ($bpnome1 == "Protetor Branco"){$numerobancop = 1;$certo += 1;}
			  elseif ($bpnome2 == "Protetor Branco"){$numerobancop = 2;$certo += 1;}
			  elseif ($bpnome3 == "Protetor Branco"){$numerobancop = 3;$certo += 1;}
			  elseif ($bpnome4 == "Protetor Branco"){$numerobancop = 4;$certo += 1;}
	
				  //item 2
			  if ($bpnome1 == "Alma da Areia"){$numerobancos = 1;$certo += 1;}
			  elseif ($bpnome2 == "Alma da Areia"){$numerobancos = 2;$certo += 1;}
			  elseif ($bpnome3 == "Alma da Areia"){$numerobancos = 3;$certo += 1;}
			  elseif ($bpnome4 == "Alma da Areia"){$numerobancos = 4;$certo += 1;}
			
			  
				if($certo == 2) {
					
									
				   //retirando o item 2 da backpack
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
				//colocando o item da fus�o
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancop='Protetor da Areia,36,3,X' WHERE charname='$usuariologadonome' LIMIT 1","users");
			
				//mostrar a resposta
				$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu Protetor Branco e Alma da Areia e obteve Protetor da Areia!";
				
				}
				
			
			
						
						
						
						
						
						
						
						
						
						
						
						// PROTETOR DA n�VOA
						$certo = 0; 
				   //item1     
			  if ($bpnome1  == "Protetor Branco"){$numerobancop = 1;$certo += 1;}
			  elseif ($bpnome2  == "Protetor Branco"){$numerobancop = 2;$certo += 1;}
			  elseif ($bpnome3  == "Protetor Branco"){$numerobancop = 3;$certo += 1;}
			  elseif ($bpnome4  == "Protetor Branco"){$numerobancop = 4;$certo += 1;}

			  //item 2
			   if ($bpnome1 == "Alma da N�voa"){$numerobancos = 1;$certo += 1;}
			  elseif ($bpnome2 == "Alma da N�voa"){$numerobancos = 2;$certo += 1;}
			  elseif ($bpnome3 == "Alma da N�voa"){$numerobancos = 3;$certo += 1;}
			  elseif ($bpnome4 == "Alma da N�voa"){$numerobancos = 4;$certo += 1;}
		
			  
					if($certo == 2) {
						
							   //retirando o item 2 da backpack
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
				//colocando o item da fus�o
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancop='Protetor da N�voa,37,3,X' WHERE charname='$usuariologadonome' LIMIT 1","users");
				
				//mostrar a resposta
				$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu Protetor Branco e Alma da N�voa e obteve Protetor da N�voa!";
				}
				
			
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
								// PROTETOR Do SOM
								$certo = 0; 
				   //item1     
			  if ($bpnome1 == "Protetor Branco"){$numerobancop = 1;$certo += 1;}
			  elseif ($bpnome2 == "Protetor Branco"){$numerobancop = 2;$certo += 1;}
			  elseif ($bpnome3 == "Protetor Branco"){$numerobancop = 3;$certo += 1;}
			  elseif ($bpnome4 == "Protetor Branco"){$numerobancop = 4;$certo += 1;}

			  //item 2
			   if ($bpnome1 == "Alma do Som"){$numerobancos = 1;$certo += 1;}
			  elseif ($bpnome2 == "Alma do Som"){$numerobancos = 2;$certo += 1;}
			  elseif ($bpnome3 == "Alma do Som"){$numerobancos = 3;$certo += 1;}
			  elseif ($bpnome4 == "Alma do Som"){$numerobancos = 4;$certo += 1;}

			  
					if($certo == 2) {
						
						 //retirando o item 2 da backpack
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
				//colocando o item da fus�o
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancop='Protetor do Som,38,3,X' WHERE charname='$usuariologadonome' LIMIT 1","users");
				
				//mostrar a resposta
				$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu Protetor Branco e Alma do Som e obteve Protetor do Som!";
				}
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
							// MASCARA OININ
							$certo = 0;  
				   //item1     
			  if ($bpnome1 == "M�scara ANBU"){$numerobancop = 1;$certo += 1;}
			  elseif ($bpnome2 == "M�scara ANBU"){$numerobancop = 2;$certo += 1;}
			 elseif ($bpnome3 == "M�scara ANBU"){$numerobancop = 3;$certo += 1;}
			  elseif ($bpnome4 == "M�scara ANBU"){$numerobancop = 4;$certo += 1;}

			  //item 2
			   if ($banco1 == "Chakra da Brisa"){$numerobancos = 1;$certo += 1;}
			  elseif ($banco2 == "Chakra da Brisa"){$numerobancos = 2;$certo += 1;}
			  elseif ($banco3 == "Chakra da Brisa"){$numerobancos = 3;$certo += 1;}
			  elseif ($banco4 == "Chakra da Brisa"){$numerobancos = 4;$certo += 1;}

			  
					if($certo == 2) {
						
							   //retirando o item 2 da backpack
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
				//colocando o item da fus�o
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancop='M�scara Oinin,41,3,X' WHERE charname='$usuariologadonome' LIMIT 1","users");
				
				 
				//mostrar a resposta
				$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu M�scara ANBU e Chakra da Brisa e obteve M�scara Oinin!";
				}
				
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 //BLUSA ESPIRITO DA NEVOA
					 $certo = 0;
				   //item1     
			  if ($bpnome1 == "Blusa Simples"){$numerobancop = 1;$certo += 1;}
			  elseif ($bpnome2 == "Blusa Simples"){$numerobancop = 2;$certo += 1;}
			  elseif ($bpnome3 == "Blusa Simples"){$numerobancop = 3;$certo += 1;}
			  elseif ($bpnome4 == "Blusa Simples"){$numerobancop = 4;$certo += 1;}

			  //item 2
			  if ($banco1 == "Esp�rito da N�voa"){$numerobancos = 1;$certo += 1;}
			  elseif ($banco2 == "Esp�rito da N�voa"){$numerobancos = 2;$certo += 1;}
			  elseif ($banco3 == "Esp�rito da N�voa"){$numerobancos = 3;$certo += 1;}
			  elseif ($banco4 == "Esp�rito da N�voa"){$numerobancos = 4;$certo += 1;}

			  
					if($certo == 2) {
						
						   //retirando o item 2 da backpack
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
				//colocando o item da fus�o
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancop='Blusa Esp�rito da N�voa,42,2,X' WHERE charname='$usuariologadonome' LIMIT 1","users");
				
				//mostrar a resposta
				$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu Blusa Simples e Esp�rito da N�voa e obteve Blusa Esp�rito da N�voa!";
				}
				
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
						 //PROTETOR DE HONRA DE KONOHA
						 $certo = 0; 
				   //item1     
			  if ($bpnome1 == "Protetor de Konoha"){$numerobancop = 1;$certo += 1;}
			  elseif ($bpnome2 == "Protetor de Konoha"){$numerobancop = 2;$certo += 1;}
			  elseif ($bpnome3 == "Protetor de Konoha"){$numerobancop = 3;$certo += 1;}
			  elseif ($bpnome4 == "Protetor de Konoha"){$numerobancop = 4;$certo += 1;}
			  
			  //item 2
			   if ($bpnome1 == "Destreza S�bita"){$numerobancos = 1;$certo += 1;}
			  elseif ($bpnome2 == "Destreza S�bita"){$numerobancos = 2;$certo += 1;}
			  elseif ($bpnome3 == "Destreza S�bita"){$numerobancos = 3;$certo += 1;}
			  elseif ($bpnome4 == "Destreza S�bita"){$numerobancos = 4;$certo += 1;}

			  
					if($certo == 2) {
						
						  //retirando o item 2 da backpack
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
				//colocando o item da fus�o
				$updatequery = doquery("UPDATE {{table}} SET bp$numerobancop='Protetor de Honra de Konoha,43,3,X' WHERE charname='$usuariologadonome' LIMIT 1","users");
						
						
				//mostrar a resposta
				$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu Protetor de Konoha e Destreza S�bita e obteve Protetor de Honra de Konoha!";
				}
					 
					 
					 
					 
					 
					 
					 
}//fim dos itens que s�o 2... $qantos = 2...
					 
					 
					 
						
				
				
				
				
				
			if ($oqueaconteceu == "") {$oqueaconteceu = "Infelizmente voc� n�o pode fundir esse(s) iten(s)...";}
        
		header("Location: /narutorpg/alquimia.php?do=fundir&frase=".$oqueaconteceu);die(); 
    }
	if ($frase != "") {$frase = "<center><font color=brown>".$frase."</font></center><br>";}
    $page = "<table width=\"100%\"><tr><td width=\"100%\" align=\"center\"><center><img src=\"images/alquimia.gif\" /></center></td></tr></table>
$frase	

<center><table>
<tr><td>Selecione os itens que voc� gostaria de fundir:</td></tr>

<tr><td>
<center>$tabelabapagina</center>
</td></tr>


</table></center>

";

    display($page, "Alquimia", false, false, false); 
    
}

?>