		<?php
			Header('Location: /svl/prospect_management?search');
			include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';
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

</div>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>
	
		