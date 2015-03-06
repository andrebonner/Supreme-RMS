<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login- Supreme RMS</title>

 <style type="text/css">
         form {
            
             position: absolute;
             left: 50%;
             top: 50%;
           
             /* Set margins to offset 50% of the w/h */
             margin: -200px 0 0 -200px;
         }
     </style>





</head>

<body>
<?php if (isset($loginError)): ?>
<p> <?php echo htmlout($loginError); ?> </p>
<?php endif; ?>




<div align="center"> 


  <form action="" method="POST" name="login" id="login" >
  

<fieldset>
<legend>Supreme RMS - Login</legend>
  
   <table cellspacing = 2 cellpadding = 2>
  
<tr>  
<td>Username</td> <td> <input type="text" name="username" id="username" autocomplete="off"  
title="Username" value="" size="30" maxlength="2048" /> </td>

</tr>

<tr>
<td>
Password:</td> <td><input type="password" name="password" id="password" 
 title="Password" value="" size="30" maxlength="2048" />
</td>
 </tr>

<br />



		<td><input type="submit" name="action" value="login"/> </td>
     
</fieldset>
</form>




</div>






</body>
</html>
