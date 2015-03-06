<?php include_once $_SERVER['DOCUMENT_ROOT'] .
		'/includes/helpers.inc.php'; require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';	
?>

	<div id="header">
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php'; ?>
			<h1> SVL Customer Service Management System </h1>
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
		<h2> Service Provider</h2>
		<p><a href="?add">New service provider</a></p>
			
	<table border = "1" cellspacing = "1" cellpadding = "5">
	
	<tr> <th> Service Provider </a></th>
	<th> Status </th>
	<th> Option </th> </tr>
		
			<?php foreach ($security_providers as $security_provider): ?>
				<tr>
					<form action="" method="post">
						<div>
						
				<td>	<?php htmlout($security_provider['name']); ?> 
							
							<input type="hidden" name="id" value="<?php
									echo $security_provider['id']; ?>"/>
					</td>
					
				<td>	 <?php htmlout($security_provider['status']); ?> </td> 
					<td>
							<input type="submit" name="action" value="Edit"/>
							<input type="submit" name="action" value="Delete"/>
					</td>
							
						</div>
					</form>
				</tr>
			<?php endforeach; ?>
		</table>
		</div>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>