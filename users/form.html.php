<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';	
?>

	<div id="header">
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php'; ?>
			
	</div>
	<div id="mainwrapper">
	<div id="col1">
	
	<?php 
	if (userHasRole('Content Administrator'))
{
	include $_SERVER['DOCUMENT_ROOT'].'/svl/ca_menu.html.php';

}


if (userHasRole('Site Administrator'))
{
	include $_SERVER['DOCUMENT_ROOT'].'/svl/sa_menu.html.php';

}
?>
</div>
<div id="col2">		
		<h2> <?php htmlout ($pagetitle); ?> </h2>
		<form action ="?<?php htmlout($action); ?>" method = "post">
		
		<table>
		
		<div>
		<tr>
				<td> <label for="username">Username </label></td> 
				<td> <input type="text" name="username" id="username" value="<?php htmlout($username); ?>"/> </td>
			
		</tr>
		
		
			</div>
		
		<div>
		<tr>
		<td>	<label for="password">Set Password </label></td>
		<td>		<input type="password" name="password"
						id="password" value="<?php htmlout($password); ?>"/> </td>
			
		</tr>
		
		</div>
		</table>
		
		
		<br/>
		<fieldset>
		<legend> Roles: </legend>
		<?php for ($i = 0; $i < count($roles); $i++): ?>
		<div>
		<label for = "role" <?php echo $i; ?>">
		<input type = "checkbox" name = "roles[]"
		id = "role<?php echo $i; ?>"
		value = "<?php htmlout($roles[$i]['id']); ?>" <?php
		if ($roles[$i]['selected'])
		{
		echo ' checked = "checked"';
		}
		
		?> />
		
		<?php htmlout($roles[$i]['id']); ?> </label>:
		<?php htmlout($roles[$i]['description']); ?>
		</div>
		<?php endfor; ?>
		</fieldset>
		<br />
		<div>
			<input type = "hidden" name = "id" value = "<?php htmlout ($id); ?> "/>
			<input type = "submit" value = "<?php htmlout($button); ?> "/>
		</div>
		
</form>	
	</div>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>
