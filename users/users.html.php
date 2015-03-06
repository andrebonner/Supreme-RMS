<?php include_once $_SERVER['DOCUMENT_ROOT'] .
		'/includes/helpers.inc.php'; require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';	
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
		<h2>Manage Users</h2>
		<p><a href="?add">Add new user</a></p>
		<table border = "1" cellspacing = "1" cellpadding = "5">
		
		<tr> 
		<th> Users </a></th>
		<th> Option </th> </tr>
		
			<?php foreach ($users as $user): ?>
				
					<form action="" method="post">
						<div>
						<tr>
							<td> <?php htmlout($user['username']); ?>
							<input type="hidden" name="id" value="<?php
									echo $user['id']; ?>"/> </td>
									
							<td>	<input type="submit" name="action" value="Edit"/>
							<!--<input type="submit" name="action" value="Delete"/> -->
						</td>
						</tr>
						</div>
					</form>
				
			<?php endforeach; ?>
		</table>
</div>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>
