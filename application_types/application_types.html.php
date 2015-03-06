<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.inc.php'; require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';	
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
		<h2>Application Types</h2>
		
		
		
		<p><a href="?add">Add New Application Type</a></p>
		
		
		
	<table border = "1" cellspacing = "1" cellpadding = "5">
	
	<tr> <th> Application Type </a></th>
	<th> Status </th>
	<th> Option </th> </tr>
		
		
			<?php foreach ($application_types as $application_type): ?>
				<tr> 
					<form action="" method="post">
						<div>
						
				<td>	
				<?php htmlout($application_type['name']); ?> 
							
							<input type="hidden" name="id" value="<?php
									echo $application_type['id']; ?>"/>
					</td>
				
				
				
			<!--<td> <a href ="?action=Edit&id= <?php htmlout($prospect['id']); ?> ">
			<?php htmlout($prospect['street_addr']); ?></a> </td>
			-->

			
						<td>	 <?php htmlout($application_type['status']); ?> </a>  </td> 
		
					<td>
							<input type="submit" name="action" value="Edit"/>
						<!--	<input type="submit" name="action" value="Delete"/> -->
					</td>
						</div>
					</form>
				</tr>
			<?php endforeach; ?>
			</table>
		</div>
		
		</table>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>