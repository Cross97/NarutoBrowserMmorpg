<?php
$template = <<<THEVERYENDOFYOU
<form action="login.php?do=login" method="post">
<center><table bgcolor="#452202"><tr ><td><font color="white"><center>Informativo</center></font></td></tr><tr><td bgcolor="#E4D094"><font color="red"><center>O jogo est� desativado at� a vers�o <b>3.0</b> e haver� infelizmente, um reset nas contas, devido ao bug, que alterou os stats de todos os personagens do jogo.</center></font></td></tr>
<tr><td bgcolor="#FFF1C7"><center>N�o h� previs�o de lan�amento do jogo, mas estou trabalhando �rduamente para termin�-lo, sendo otimista, acho que ainda vai demorar uns meses, e tamb�m ser� testado para evitar novos bugs.</center></td></tr></center>
</table><br><br>
<table width="100%">
<tr><td width="30%">Nome de Usu�rio:</td><td><input type="text" size="30" name="username" /></td></tr>
<tr><td>Senha:</td><td><input type="password" size="30" name="password" /></td></tr>
<tr><td>Lembrar-me?</td><td><input type="checkbox" name="rememberme" value="yes" /> Sim</td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Entrar" /></td></tr>
<tr><td colspan="2">Marcando a op��o "Lembrar-me" sua informa��o ser� guardada num cookie e voc� n�o ter� que fazer login da pr�xima vez que voc� entrar no jogo.<br /><br />Quer jogar? Voc� precisa <a href="users.php?do=register">registrar seu pr�prio personagem.</a><br /><br />Voc� tamb�m pode <a href="users.php?do=changepassword">mudar sua senha</a>, ou <a href="users.php?do=lostpassword">requerer uma nova senha</a> se voc� perdeu a sua.
<br><br>
Caso voc� tenha se registrado e n�o tenha recebido o e-mail de confirma��o, voc� pode <a href="ativarconta.php">ativar sua conta</a> agora mesmo.
</td></tr>
</table>
</form>
THEVERYENDOFYOU;
?>