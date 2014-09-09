<?php // heal.php :: Handles stuff from the Quick Spells menu. (Healing spells only... other spells are handled in fight.php.)

function healspells($id) {
    
    global $userrow;
    
    $userspells = explode(",",$userrow["spells"]);
    $spellquery = doquery("SELECT * FROM {{table}} WHERE id='$id' LIMIT 1", "spells");
    $spellrow = mysql_fetch_array($spellquery);
    
    // All the various ways to error out.
    $spell = false;
    foreach ($userspells as $a => $b) {
        if ($b == $id) { $spell = true; }
    }
    if ($spell != true) { display("Voc� ainda n�o aprendeu esse Jutsu. Por favor volte e tente novamente.", "Error"); die(); }
    if ($spellrow["type"] != 1) { display("Esse n�o � um Jutsu medicinal. Por favor volte e tente novamente.", "Error"); die(); }
    if ($userrow["currentmp"] < $spellrow["mp"]) { display("Voc� n�o tem Chakra suficiente para usar esse Jutsu. Por favor volte e tente novamente.", "Error"); die(); }
    if ($userrow["currentaction"] == "Fighting") { display("Voc� n�o pode usar Jutsus os Jutsus da Lista R�pida de Jutsus durante uma batalha. Por favor volte e selecione o Jutsu Medicinal que voc� gostaria de usar pela sele��o de Jutsus na janela principal de luta para continuar.", "Error"); die(); }
    if ($userrow["currenthp"] == $userrow["maxhp"]) { display("Seus Pontos de Vida j� est�o cheios. Voc� n�o precisa de um Jutsu Medicinal agora.", "Error"); die(); }
    
    $newhp = $userrow["currenthp"] + $spellrow["attribute"];
    if ($userrow["maxhp"] < $newhp) { $spellrow["attribute"] = $userrow["maxhp"] - $userrow["currenthp"]; $newhp = $userrow["currenthp"] + $spellrow["attribute"]; }
    $newmp = $userrow["currentmp"] - $spellrow["mp"];
    
    $updatequery = doquery("UPDATE {{table}} SET currenthp='$newhp', currentmp='$newmp' WHERE id='".$userrow["id"]."' LIMIT 1", "users");
    
    display("Voc� usou o Jutsu: ".$spellrow["name"]." e ganhou ".$spellrow["attribute"]." Pontos de Vida. Voc� pode continuar <a href=\"index.php\">explorando</a>.", "Jutsu Medicinal");
    die();
    
}

?>