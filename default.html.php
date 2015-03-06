

<?php
			Header('Location: /svl/prospect_management?search');
			include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';
		?>
	
	
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->


<div id="header-wrap">
	<div id="header-container">
		<div id="header">
			<h1>Supreme RMS</h1>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php'; ?>
			<ul>
				<li><a href="#">Sign Out</a></li>
			</ul>
		</div>
	</div>
</div>



<div id="ie6-container-wrap">
	<div id="container">
		
		<div id="controls">
			
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





		Accordion Content goes here
		</div>
		
		
		
		
		
		<div id="content">
			Page Content goes here
		</div>           
	</div>
</div>



<div id="footer-wrap">
	<div id="footer-container">
		<div id="footer">
			
			<p>Copyright</p>
		</div>
	</div>
</div>
</body>
</html>