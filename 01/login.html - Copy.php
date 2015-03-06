<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Box HTML Code - www.PSDGraphics.com</title>

<link href="login-box.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php if (isset($loginError)): ?>
<p> <?php echo htmlout($loginError); ?> </p>
<?php endif; ?>

<div style="padding: 100px 0 0 250px;">


<div id="login-box">

<H3>Login</H3>

  <form action="" method="POST" name="login" id="login" style="margin:0px">
  


<div id="login-box-name" style="margin-top:20px;">Username:</div><div id="login-box-field" style="margin-top:20px;"><input type="text" name="username" id="username" autocomplete="off"  class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
<div id="login-box-name">Password:</div><div id="login-box-field"><input type="password" name="password" id="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
<br />

<br />
<br />
<input type  = "image"  name = "Log in"  border = "0" img src="images/login-btn.png" width="103" height="42" style="margin-left:90px;"  >

		<td><input type="hidden" name="action" value="login"/> </td>
     

</form>


</div>

</div>













</body>
</html>
