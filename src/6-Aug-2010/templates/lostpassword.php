<?php
$template = <<<THEVERYENDOFYOU
<form action="users.php?do=lostpassword" method="post">
<table width="80%">
<tr><td colspan="2">Se voc� perdeu sua senha, entre com seu e-mail abaixo e voc� receber� uma nova.</td></tr>
<tr><td width="20%">Endere�o de E-mail:</td><td><input type="text" name="email" size="30" maxlength="100" /></td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Enviar" /> <input type="reset" name="reset" value="Resetar" /></td></tr>
</table>
</form>
THEVERYENDOFYOU;
?>