<?php
$template = <<<THEVERYENDOFYOU
<font color=red>Galera, infelizmente, na transi��o do RPG 1.0 para o 2.0, as contas tiveram que ser deletadas... Bem... quem estava jogando antes, vai ganhar algo de acordo com o level que tinha, s� falar com o Oyatsumi ou o Devilolz dentro do jogo. Obrigado e desculpe-nos qualquer coisa.</font><br><br>
<form action="login.php?do=login" method="post">
<table width="75%">
<tr><td width="30%">Nome de Usu�rio:</td><td><input type="text" size="30" name="username" /></td></tr>
<tr><td>Senha:</td><td><input type="password" size="30" name="password" /></td></tr>
<tr><td>Lembrar-me?</td><td><input type="checkbox" name="rememberme" value="yes" /> Sim</td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Entrar" /></td></tr>
<tr><td colspan="2">Marcando a op��o "Lembrar-me" sua informa��o ser� guardada num cookie e voc� n�o ter� que fazer login da pr�xima vez que voc� entrar no jogo.<br /><br />Quer jogar? Voc� precisa <a href="users.php?do=register">registrar seu pr�prio personagem.</a><br /><br />Voc� tamb�m pode <a href="users.php?do=changepassword">mudar sua senha</a>, ou <a href="users.php?do=lostpassword">requerer uma nova senha</a> se voc� perdeu a sua.</td></tr>
</table>
</form>
THEVERYENDOFYOU;
?>