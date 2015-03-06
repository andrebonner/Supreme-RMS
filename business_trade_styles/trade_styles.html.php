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
		<h2>Manage Trade Styles</h2>
		<p><a href="?add">Add New Trade Style</a></p>
		
		
		
	<table border = "1" cellspacing = "1" cellpadding = "5">
	
	<tr> <th> Trade Style  </th>
	<th> Code  </th>
	<th> Status </th>
	<th> Option </th> </tr>
		
			<?php foreach ($trade_styles as $trade_style): ?>
			
					<form action="" method="post">
						<div>
					
					<tr> <td>	
					<?php htmlout($trade_style['name']); ?> 
							
							<input type="hidden" name="id" value="<?php
									echo $trade_style['id']; ?>"/>
					</td>
						<td> <?php htmlout($trade_style['code']); ?>  </td>
						<td> <?php htmlout($trade_style['status']); ?>  </td>
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
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>