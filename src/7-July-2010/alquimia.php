<?php // users.php :: Handles user account functions.


/*$controlquery = doquery("SELECT * FROM {{table}} WHERE id='1' LIMIT 1", "control");
$controlrow = mysql_fetch_array($controlquery);*/



include('lib.php');
$link = opendb();

include('cookies.php');
$userrow = checkcookies();


		

	

if (isset($_GET["do"])) {
    
    $do = $_GET["do"];
    if ($do == "fundir") { fundir(); }
	}

function fundir() {
global $topvar;
$topvar = true;
    /* testando se est� logado */
		//include('cookies.php');
		//$userrow = checkcookies();
		global $userrow;

		if ($userrow == false) { display("Por favor fa�a o <a href=\"login.php?do=login\">log in</a> no jogo antes de executar essa a��o.","Erro",false,false,false);
		die(); }
		if ($userrow["currentaction"] != "In Town") {display("Voc� s� pode acessar essa fun��o quando estiver em uma cidade! Clique <a href=\"index.php\">aqui</a> para voltar ao jogo.","Erro",false,false,false);die(); }
					if ($userrow["currentaction"] == "Fighting") {display("Voc� n�o pode acessar essa fun��o no meio de uma batalha!","Erro",false,false,false);die(); }
					
					if ($userrow["batalha_timer2"] == 5) {global $topvar;
$topvar = true; display("Voc� n�o pode fazer nenhum movimento enquanto estiver em um duelo. Clique <a href=\"users.php?do=resetarduelo\">aqui</a>, para resetar seu Duelo atual. ","Erro",false,false,false);die(); }

		
		$usuariologadonome = $userrow["charname"];
		
		
		$banco1 = $userrow["banconome1"];
		$banco2 = $userrow["banconome2"];
		$banco3 = $userrow["banconome3"];
		$banco4 = $userrow["banconome4"];
		$banco5 = $userrow["banconome5"];
		$banco6 = $userrow["banconome6"];
		
		$banco1id = $userrow["bancoid1"];
		$banco2id = $userrow["bancoid2"];
		$banco3id = $userrow["bancoid3"];
		$banco4id = $userrow["bancoid4"];
		$banco5id = $userrow["bancoid5"];
		$banco6id = $userrow["bancoid6"];

	
    if (isset($_POST["submit"])) {
        extract($_POST);
        
		
		$usuariologadonome = $userrow["charname"];
		// ESPADAS RAIGA
		   //item1     
	  if ($banco1 == "Espadas de Rai"){$numerobancop = 1;}
	  if ($banco2 == "Espadas de Rai"){$numerobancop = 2;}
	  if ($banco3 == "Espadas de Rai"){$numerobancop = 3;}
	  if ($banco4 == "Espadas de Rai"){$numerobancop = 4;}
	  if ($banco5 == "Espadas de Rai"){$numerobancop = 5;}
	  if ($banco6 == "Espadas de Rai"){$numerobancop = 6;}
	  //item 2
	   if ($banco1 == "Mem�ria de Konoha"){$numerobancos = 1;}
	  if ($banco2 == "Mem�ria de Konoha"){$numerobancos = 2;}
	  if ($banco3 == "Mem�ria de Konoha"){$numerobancos = 3;}
	  if ($banco4 == "Mem�ria de Konoha"){$numerobancos = 4;}
	  if ($banco5 == "Mem�ria de Konoha"){$numerobancos = 5;}
	  if ($banco6 == "Mem�ria de Konoha"){$numerobancos = 6;}
	  
	  		if($Combobox1 == "Espadas de Rai") {if ($Combobox2 == "Mem�ria de Konoha") {
		
	  	   //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid".$numerobancos."='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome".$numerobancos."='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='34' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Espadas Raiga' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Espadas de Rai</font> e <font color=red>Mem�ria de Konoha</font> e obteve <font color=red>Espadas Raiga</font>!";
		}}
		
	
	if($Combobox1 == "Mem�ria de Konoha") {if ($Combobox2 == "Espadas de Rai") {
		
	  	  //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='34' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Espadas Raiga' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Espadas de Rai</font> e <font color=red>Mem�ria de Konoha</font> e obteve <font color=red>Espadas Raiga</font>!";
		}}
		     //ACABOU ESPADAS RAIGA   
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				// PROTETOR DA AREIA
		   //item1     
	  if ($banco1 == "Protetor Branco"){$numerobancop = 1;}
	  if ($banco2 == "Protetor Branco"){$numerobancop = 2;}
	  if ($banco3 == "Protetor Branco"){$numerobancop = 3;}
	  if ($banco4 == "Protetor Branco"){$numerobancop = 4;}
	  if ($banco5 == "Protetor Branco"){$numerobancop = 5;}
	  if ($banco6 == "Protetor Branco"){$numerobancop = 6;}
	  //item 2
	   if ($banco1 == "Alma da Areia"){$numerobancos = 1;}
	  if ($banco2 == "Alma da Areia"){$numerobancos = 2;}
	  if ($banco3 == "Alma da Areia"){$numerobancos = 3;}
	  if ($banco4 == "Alma da Areia"){$numerobancos = 4;}
	  if ($banco5 == "Alma da Areia"){$numerobancos = 5;}
	  if ($banco6 == "Alma da Areia"){$numerobancos = 6;}
	  
	  		if($Combobox1 == "Protetor Branco") {if ($Combobox2 == "Alma da Areia") {
		
	  	   //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid".$numerobancos."='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome".$numerobancos."='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='36' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Protetor da Areia' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Protetor Branco</font> e <font color=red>Alma da Areia</font> e obteve <font color=red>Protetor da Areia</font>!";
		}}
		
	
	if($Combobox1 == "Alma da Areia") {if ($Combobox2 == "Protetor Branco") {
		
	  	  //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='36' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Protetor da Areia' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Protetor Branco</font> e <font color=red>Alma da Areia</font> e obteve <font color=red>Protetor da Areia</font>!";
		}}
		     //PROTETOR DA AREIA   
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				// PROTETOR DA n�VOA
		   //item1     
	  if ($banco1 == "Protetor Branco"){$numerobancop = 1;}
	  if ($banco2 == "Protetor Branco"){$numerobancop = 2;}
	  if ($banco3 == "Protetor Branco"){$numerobancop = 3;}
	  if ($banco4 == "Protetor Branco"){$numerobancop = 4;}
	  if ($banco5 == "Protetor Branco"){$numerobancop = 5;}
	  if ($banco6 == "Protetor Branco"){$numerobancop = 6;}
	  //item 2
	   if ($banco1 == "Alma da N�voa"){$numerobancos = 1;}
	  if ($banco2 == "Alma da N�voa"){$numerobancos = 2;}
	  if ($banco3 == "Alma da N�voa"){$numerobancos = 3;}
	  if ($banco4 == "Alma da N�voa"){$numerobancos = 4;}
	  if ($banco5 == "Alma da N�voa"){$numerobancos = 5;}
	  if ($banco6 == "Alma da N�voa"){$numerobancos = 6;}
	  
	  		if($Combobox1 == "Protetor Branco") {if ($Combobox2 == "Alma da N�voa") {
		
	  	   //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid".$numerobancos."='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome".$numerobancos."='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='37' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Protetor da N�voa' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Protetor Branco</font> e <font color=red>Alma da N�voa</font> e obteve <font color=red>Protetor da N�voa</font>!";
		}}
		
	
	if($Combobox1 == "Alma da N�voa") {if ($Combobox2 == "Protetor Branco") {
		
	  	  //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='37' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Protetor da N�voa' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Protetor Branco</font> e <font color=red>Alma da N�voa</font> e obteve <font color=red>Protetor da N�voa</font>!";
		}}
		     //PROTETOR DA N�VOA  
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
						// PROTETOR Do SOM
		   //item1     
	  if ($banco1 == "Protetor Branco"){$numerobancop = 1;}
	  if ($banco2 == "Protetor Branco"){$numerobancop = 2;}
	  if ($banco3 == "Protetor Branco"){$numerobancop = 3;}
	  if ($banco4 == "Protetor Branco"){$numerobancop = 4;}
	  if ($banco5 == "Protetor Branco"){$numerobancop = 5;}
	  if ($banco6 == "Protetor Branco"){$numerobancop = 6;}
	  //item 2
	   if ($banco1 == "Alma do Som"){$numerobancos = 1;}
	  if ($banco2 == "Alma do Som"){$numerobancos = 2;}
	  if ($banco3 == "Alma do Som"){$numerobancos = 3;}
	  if ($banco4 == "Alma do Som"){$numerobancos = 4;}
	  if ($banco5 == "Alma do Som"){$numerobancos = 5;}
	  if ($banco6 == "Alma do Som"){$numerobancos = 6;}
	  
	  		if($Combobox1 == "Protetor Branco") {if ($Combobox2 == "Alma do Som") {
		
	  	   //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid".$numerobancos."='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome".$numerobancos."='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='38' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Protetor do Som' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Protetor Branco</font> e <font color=red>Alma do Som</font> e obteve <font color=red>Protetor do Som</font>!";
		}}
		
	
	if($Combobox1 == "Alma do Som") {if ($Combobox2 == "Protetor Branco") {
		
	  	  //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='38' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Protetor do Som' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Protetor Branco</font> e <font color=red>Alma do Som</font> e obteve <font color=red>Protetor do Som</font>!";
		}}
		     //PROTETOR DO SOM 
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
					// MASCARA OININ
		   //item1     
	  if ($banco1 == "M�scara ANBU"){$numerobancop = 1;}
	  if ($banco2 == "M�scara ANBU"){$numerobancop = 2;}
	  if ($banco3 == "M�scara ANBU"){$numerobancop = 3;}
	  if ($banco4 == "M�scara ANBU"){$numerobancop = 4;}
	  if ($banco5 == "M�scara ANBU"){$numerobancop = 5;}
	  if ($banco6 == "M�scara ANBU"){$numerobancop = 6;}
	  //item 2
	   if ($banco1 == "Chakra da Brisa"){$numerobancos = 1;}
	  if ($banco2 == "Chakra da Brisa"){$numerobancos = 2;}
	  if ($banco3 == "Chakra da Brisa"){$numerobancos = 3;}
	  if ($banco4 == "Chakra da Brisa"){$numerobancos = 4;}
	  if ($banco5 == "Chakra da Brisa"){$numerobancos = 5;}
	  if ($banco6 == "Chakra da Brisa"){$numerobancos = 6;}
	  
	  		if($Combobox1 == "M�scara ANBU") {if ($Combobox2 == "Chakra da Brisa") {
		
	  	   //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid".$numerobancos."='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome".$numerobancos."='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='41' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='M�scara Oinin' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>M�scara ANBU</font> e <font color=red>Chakra da Brisa</font> e obteve <font color=red>M�scara Oinin</font>!";
		}}
		
	
	if($Combobox1 == "Chakra da Brisa") {if ($Combobox2 == "M�scara ANBU") {
		
	  	  //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='41' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='M�scara Oinin' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>M�scara ANBU</font> e <font color=red>Chakra da Brisa</font> e obteve <font color=red>M�scara Oinin</font>!";
		}}
		     //MASCARA OININ
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 //BLUSA ESPIRITO DA NEVOA
		   //item1     
	  if ($banco1 == "Blusa Simples"){$numerobancop = 1;}
	  if ($banco2 == "Blusa Simples"){$numerobancop = 2;}
	  if ($banco3 == "Blusa Simples"){$numerobancop = 3;}
	  if ($banco4 == "Blusa Simples"){$numerobancop = 4;}
	  if ($banco5 == "Blusa Simples"){$numerobancop = 5;}
	  if ($banco6 == "Blusa Simples"){$numerobancop = 6;}
	  //item 2
	   if ($banco1 == "Esp�rito da N�voa"){$numerobancos = 1;}
	  if ($banco2 == "Esp�rito da N�voa"){$numerobancos = 2;}
	  if ($banco3 == "Esp�rito da N�voa"){$numerobancos = 3;}
	  if ($banco4 == "Esp�rito da N�voa"){$numerobancos = 4;}
	  if ($banco5 == "Esp�rito da N�voa"){$numerobancos = 5;}
	  if ($banco6 == "Esp�rito da N�voa"){$numerobancos = 6;}
	  
	  		if($Combobox1 == "Blusa Simples") {if ($Combobox2 == "Esp�rito da N�voa") {
		
	  	   //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid".$numerobancos."='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome".$numerobancos."='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='42' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Blusa Esp�rito da N�voa' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Blusa Simples</font> e <font color=red>Esp�rito da N�voa</font> e obteve <font color=red>Blusa Esp�rito da N�voa</font>!";
		}}
		
	
	if($Combobox1 == "Esp�rito da N�voa") {if ($Combobox2 == "Blusa Simples") {
		
	  	  //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='42' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Blusa Esp�rito da N�voa' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Blusa Simples</font> e <font color=red>Esp�rito da N�voa</font> e obteve <font color=red>Blusa Esp�rito da N�voa</font>!";
		}}
		     //BLUSA ESPIRITO DA NEVOA
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 	 //PROTETOR DE HONRA DE KONOHA
		   //item1     
	  if ($banco1 == "Protetor de Konoha"){$numerobancop = 1;}
	  if ($banco2 == "Protetor de Konoha"){$numerobancop = 2;}
	  if ($banco3 == "Protetor de Konoha"){$numerobancop = 3;}
	  if ($banco4 == "Protetor de Konoha"){$numerobancop = 4;}
	  if ($banco5 == "Protetor de Konoha"){$numerobancop = 5;}
	  if ($banco6 == "Protetor de Konoha"){$numerobancop = 6;}
	  //item 2
	   if ($banco1 == "Destreza S�bita"){$numerobancos = 1;}
	  if ($banco2 == "Destreza S�bita"){$numerobancos = 2;}
	  if ($banco3 == "Destreza S�bita"){$numerobancos = 3;}
	  if ($banco4 == "Destreza S�bita"){$numerobancos = 4;}
	  if ($banco5 == "Destreza S�bita"){$numerobancos = 5;}
	  if ($banco6 == "Destreza S�bita"){$numerobancos = 6;}
	  
	  		if($Combobox1 == "Protetor de Konoha") {if ($Combobox2 == "Destreza S�bita") {
		
	  	   //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid".$numerobancos."='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome".$numerobancos."='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='43' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Protetor de Honra de Konoha' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Protetor de Konoha</font> e <font color=red>Destreza S�bita</font> e obteve <font color=red>Protetor de Honra de Konoha</font>!";
		}}
		
	
	if($Combobox1 == "Destreza S�bita") {if ($Combobox2 == "Protetor de Konoha") {
		
	  	  //retirando o item 2 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancos='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancos='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//retirando o item 1 do banco
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='0' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='None' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//colocando o item da fus�o
		$updatequery = doquery("UPDATE {{table}} SET bancoid$numerobancop='43' WHERE charname='$usuariologadonome' LIMIT 1","users");
		$updatequery = doquery("UPDATE {{table}} SET banconome$numerobancop='Protetor de Honra de Konoha' WHERE charname='$usuariologadonome' LIMIT 1","users");
		//mostrar a resposta
		$oqueaconteceu = "Parab�ns! Sua fus�o ocorreu com sucesso! Voc� fundiu <font color=red>Protetor de Konoha</font> e <font color=red>Destreza S�bita</font> e obteve <font color=red>Protetor de Honra de Konoha</font>!";
		}}
		     //PROTETOR DE HONRA DE KONOHA
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
				
				
				
				
				
				
			if ($oqueaconteceu == "") {$oqueaconteceu = "Infelizmente voc� n�o pode fundir esses itens...";}
        display("$oqueaconteceu.<br /><br />Voc� pode <a href=\"index.php\">clicar aqui</a> para continuar jogando ou <a href=\"alquimia.php?do=fundir\">fundir mais itens</a>.","Alquimia",false,false,false);
        die();
    }
    $page = "<table width=\"100%\"><tr><td width=\"100%\" align=\"center\"><center><img src=\"images/alquimia.gif\" /></center></td></tr></table>
	<b><font color=brown>Banco de Trocas:</font></b><br><b>Arma</b>: $banco1<br><b>Colete</b>: $banco2<br><b>Bandana</b>: $banco3<br><b>Slot 1</b>: $banco4<br><b>Slot 2</b>: $banco5<br><b>Slot 3</b>: $banco6<br><br>
	

<form action=\"alquimia.php?do=fundir\" method=\"post\">
<table>
<tr><td colspan=\"2\">Escolha a combina��o de Itens (Para combinar itens,<br> os mesmos devem estar no Banco de Trocas):<br></td></tr>

<tr><td>Item 1: <select name=\"Combobox1\" size=\"1\" id=\"Combobox1\">
<option selected value=\"0\">Escolha</option>
<option value=\"$banco1\">$banco1</option>
<option value=\"$banco2\">$banco2</option>
<option value=\"$banco3\">$banco3</option>
<option value=\"$banco4\">$banco4</option>
<option value=\"$banco5\">$banco5</option>
<option value=\"$banco6\">$banco6</option>
</select></td></tr>

<tr>
<td>Item 2: <select name=\"Combobox2\" size=\"1\" id=\"Combobox2\">
<option selected value=\"0\">Escolha</option>
<option value=\"$banco1\">$banco1</option>
<option value=\"$banco2\">$banco2</option>
<option value=\"$banco3\">$banco3</option>
<option value=\"$banco4\">$banco4</option>
<option value=\"$banco5\">$banco5</option>
<option value=\"$banco6\">$banco6</option>
</select></td>

</tr>


<tr><td colspan=\"2\"><input type=\"submit\" name=\"submit\" value=\"Fundir Itens\" /> </tr>
</table>
</form>
";
   $topnav = "<a href=\"index.php\"><img src=\"images/jogar.gif\" alt=\"Voltar a Jogar\" border=\"0\" /></a><a href=\"help.php\"><img src=\"images/button_help.gif\" alt=\"Ajuda\" border=\"0\" /></a>";
    display($page, "Alquimia", false, false, false); 
    
}

?>