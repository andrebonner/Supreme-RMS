<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/XHTML1-strict.dtd">

<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">
<head>
<title>Log in</title>
<meta http-equiv ="content-type"
		content = "text/html; charset=utf-8"/>
<style type="text/css">
<!--
body {
	background-color:#ffffff;
	margin: 0px;
	color: black;
	text-align:center;
	font-family: Tahoma, Arial;
	font-size:10pt;
	color:black;
	background-image: url(images/svl-logo.jpg);
	background-attachment: fixed;
	background-repeat: no-repeat;
	background-position: center center;
}
#loginform-container {
	width:900px;
	height:445px;
	position:absolute;
	text-align:center;
	left:50%;
	top:50%;
	margin: -222px 0 0 -450px;
	/*margin:0px 0 0 0px;*/
	background-attachment: scroll;
	/*background-image: url(/i/login-bg.jpg);*/
	background-repeat: no-repeat;
}
#loginform {
	width:300px;
	height:170px;
	position:absolute;
	left:50%;
	top:13%;
	margin:-65px 0 0 -150px;
	border: 1px solid #03F;
}
#kaivoto {
	width:330px;
	height:40px;
	position:absolute;
	left:292px;
	top:404px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8pt;
	color: #FFFF00;	/*margin:-20px 0 0 -165x;*/
}
#loginform-container #loginform #login #btnLogin {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9pt;
	color: #FFFF00;
	background-color: #781B48;
	border: 2px outset #1B4F89;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<?php if (isset($loginError)): ?>
<p> <?php echo htmlout($loginError); ?> </p>
<?php endif; ?>

<div id="loginform">
  <h1> Login  </h1>
  <form action="" method="POST" name="login" id="login" style="margin:0px">
    <table width="240" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td width="60">USERNAME</td>
        <td><input type="text" name="username" id="username" autocomplete="off" /></td>
      </tr>
      <tr>
        <td width="60">PASSWORD</td>
        <td><input type="password" name="password" id="password" /></td>
      </tr>
      <tr>
        <td width="60">&nbsp;</td>
		<td><input type="hidden" name="action" value="login"/> </td>
        <td><input type="submit" value="Log in" /></td>
      </tr>
    </table>
  </form>
</div>

</body>
</html>

