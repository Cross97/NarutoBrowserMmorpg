<?php
global $conteudouser;
$template = <<<THEVERYENDOFYOU
<table width="100%"><tr><td width="100%" align="center"><center><img src="images/login.gif" /></center></td></tr></table>$conteudouser
<center><table bgcolor="#452202"><tr ><td><font color="white"><center>Informativo</center></font></td></tr><tr><td bgcolor="#E4D094"><font color="red"><center>O jogo est� desativado at� a vers�o <b>3.0</b> e haver� infelizmente, um reset nas contas, devido ao bug, que alterou os stats de todos os personagens do jogo.</center></font></td></tr>
<tr><td bgcolor="#FFF1C7"><center>N�o h� previs�o de lan�amento do jogo, mas estou trabalhando �rduamente para termin�-lo, sendo otimista, acho que ainda vai demorar uns meses, e tamb�m ser� testado para evitar novos bugs.</center></td></tr></center>
</table><br><br><form action="login.php?do=login" method="post" id="formback"><fieldset id="field2"><legend>Fazer Login</legend>
<table width="100%">
<tr><td width="30%">Nome da Conta:</td><td><input type="password" size="30" name="username" id="nomeform"/><a href="javascript: mostrarpass('nomeform');"><img src="layoutnovo/dropmenu/b4.gif" title="Mostrar/Ocultar Conta" border="0"></a></td></tr>
<tr><td>Senha:</td><td><input type="password" size="30" name="password" id="senhaform"/><a href="javascript: mostrarpass('senhaform');"><img src="layoutnovo/dropmenu/b4.gif" title="Mostrar/Ocultar Senha" border="0"></a></td></tr>
<tr><td>Lembrar-me?</td><td><input type="checkbox" name="rememberme" value="yes" /> Sim</td></tr>
<tr><td colspan="2"><div class="buttons"><button type="submit" class="positive" name="submit"><img src="layoutnovo/dropmenu/b1.gif"> Entrar</button><button type="reset" class="negative" name="reset"><img src="layoutnovo/dropmenu/b3.gif"> Resetar</button></div></td></tr>
<tr><td colspan="2">Marcando a op��o "Lembrar-me" sua informa��o ser� guardada em um cookie e voc� n�o ter� que fazer login da pr�xima vez que voc� entrar no jogo.
</td></tr>
</table></fieldset></center>
<br />Quer jogar? Voc� precisa <a href="users.php?do=register">registrar seu pr�prio personagem.</a><br /><br />Voc� tamb�m pode <a href="users.php?do=changepassword">mudar sua senha</a>, ou <a href="users.php?do=lostpassword">requerer uma nova senha</a> se voc� perdeu a sua.
<br><br>
Caso voc� tenha se registrado e n�o tenha recebido o e-mail de confirma��o, voc� pode <a href="ativarconta.php">ativar sua conta</a> agora mesmo.
</form>
THEVERYENDOFYOU;
?>