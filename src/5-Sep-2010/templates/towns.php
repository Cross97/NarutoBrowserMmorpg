<?php
$template = <<<THEVERYENDOFYOU
<table width="100%">
<tr><td align="center"><center><img src="images/town_{{id}}.gif" alt="Bem-vindo � {{name}}" title="Bem-vindo � {{name}}" /></center>
{{indexconteudo}}
<center><table width="450"><tr><td><img src="layoutnovo/avatares/kages/{{id}}.png" align="left"><br><b>{{kage}} diz:</b><br>
Bem vindo(a) ao meu pa�s. Aqui voc� pode completar miss�es, descansar, descansar em uma pousada para recuperar totalmente seu HP, Chakra e Pontos de Viagem... Voc� tamb�m pode completar as miss�es do meu pa�s. Sinta-se a vontade... Para ficar mais forte, voc� pode comprar Armas, Coletes e Bandanas... Para viajar para outros pa�ses, voc� pode comprar Mapas, ou descobrir sua localiza��o sozinho...</td></tr></table></center>

</td></tr>
<tr><td>
<b>Op��es da Cidade:</b><br /><br>
Fun��es de Compras:<br>
<ul>
<li /><a href="index.php?do=buy">Comprar Arma/Colete/Bandana</a>
<li /><a href="index.php?do=maps">Comprar Mapas</a>
</ul>
Fun��es de Recuperar HP, Chakra e Pontos de Viagem:<br>
<ul>
<li /><a href="encherhp.php">Sentar e descansar</a>
<li /><a href="index.php?do=inn">Descansar numa Pousada</a>
</ul>
Fun��es de Banco e Correio:<br>
<ul>
<li /><a href="users.php?do=banco">Acessar meu Banco</a>
<li /><a href="users.php?do=doaritem">Enviar Item</a>
<li /><a href="users.php?do=doardinheiro">Enviar Ryou</a>
</ul>
Outras Fun��es:<br>
<ul>
<li /><a href="alquimia.php?do=fundir">Alquimia de Itens</a>
<li /><a href="missoes.php?do=missao">Completar Miss�es</a>
<li /><a href="graduacao.php?do=graduacao">Graduar-se</a>
<li /><a href="fala.php?do=falar">Recolher Informa��es</a>
{{outros}}
</ul>
</td></tr>
<tr><td><center>
{{news}}
<br />
<table width="95%">
<tr><td width="50%">
{{whosonline}}
</td><td>
{{babblebox}}
</td></tr>
</table>
</td></tr>
</table>
THEVERYENDOFYOU;
?>