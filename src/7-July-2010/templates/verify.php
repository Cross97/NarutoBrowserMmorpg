<?php
$template = <<<THEVERYENDOFYOU
<form action="users.php?do=verify" method="post">
<table width="80%">
<tr><td colspan="2">Obrigado por registrar seu personagem. Por favor entre com o seu nome de usu�rio, email e c�digo de verifica��o que foi enviado por e-mail para desbloquear seu personagem.</td></tr>
<tr><td width="20%">Nome de Usu�rio:</td><td><input type="text" name="username" size="30" maxlength="30" /></td></tr>
<tr><td>E-mail:</td><td><input type="text" name="email" size="30" maxlength="100" /></td></tr>
<tr><td>C�digo de Verifica��o:</td><td><input type="text" name="verify" size="10" maxlength="8" /><br /><br /><br /></td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Enviar" /> <input type="reset" name="reset" value="Resetar" /></td></tr>
</table>
</form>
THEVERYENDOFYOU;
?>