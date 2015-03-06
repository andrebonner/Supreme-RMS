<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		"http://www.w3.org/TR/xhtml1/DTD/XHTML1-strict.dtd">
	
		<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">
		<head>
		<title> Supreme RMS </title>
		
		<meta http-equiv ="content-type" content = "text/html; charset=utf-8"/>
		
			<script src="jquery-1.7.1.min.js" type="text/javascript"></script>
			<script src="jquery.maskedinput.js" type="text/javascript"></script>
			
		
		
		<link href="
		<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>css/main.css" rel="stylesheet" type="text/css" />
		
		
		<!-- Flexigrid CSS-->
		<link href="
		<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>css/flexigrid.css" rel="stylesheet" type="text/css" />
		
		<link rel="stylesheet" href="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/development-bundle/themes/base/jquery.ui.all.css">
	
		<!--Jquery CSS library -->
		<link type="text/css" href="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />	
	
		
		<link href="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>css/tabs.css" rel="stylesheet" type="text/css" />

		<link href="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>css/calendar.css" rel="stylesheet" type="text/css" />




		<style type="text/css">
		.searchTable { background-color:#FFFFE0;border-collapse:collapse; }
		.searchTable th { background-color:#BDB76B;color:white; }
		.searchTable td, .searchTable th { padding:5px;border:1px solid #BDB76B; }
		</style>	
		
		
		<!--JQUERY library -->
		<script type="text/javascript" src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/js/jquery-1.7.1.min.js"></script>

		
		<!-- Accordion for drop down menu -->
		<script type="text/javascript" src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/js/ddaccordion.js"></script>
		
		
		<!-- Flexigrid -->
		<script type="text/javascript" src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/js/flexigrid.js"></script>
		
	
		
		
		<!-- JQUERY UI library pack -->
		<script type="text/javascript" src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/js/jquery-ui-1.8.18.custom.min.js"></script>	
	
		<!-- Definittions for the masked inputs - phone, trn,etc -->
		<script type="text/javascript" src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/js/jquery.maskedinput.js"></script>	
	
	
	
		<script src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/development-bundle/ui/jquery.ui.core.js"></script>
	
		<script src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/development-bundle/ui/jquery.ui.widget.js"></script>
	
		<script src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/development-bundle/ui/jquery.ui.accordion.js"></script>
	
		<script src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>
	
	
	
	
	
	
		
		 <script language="JavaScript">
						
				$(function() {
				$("#flex1").flexigrid(
				{
				url: 'index.php',
				dataType: 'json',
				colModel : [
				{display: 'ID', name : 'id', width : 40, sortable : true, align: 'left'},
				{display: 'First Name', name : 'name', width : 150, sortable : true, align: 'left'},
				{display: 'Surname', name : 'parish_id', width : 150, sortable : true, align: 'left'},
				{display: 'Position', name : 'status_id', width : 250, sortable : true, align: 'left'}
				],
				buttons : [
				{name: 'Edit', bclass: 'edit', onpress : doCommand},
				{name: 'Delete', bclass: 'delete', onpress : doCommand},
				{separator: true}
				],
				searchitems : [
				{display: 'First Name', name : 'first_name'},
				{display: 'Surname', name : 'surname', isdefault: true},
				{display: 'Position', name : 'position'}
				],
				sortname: "id",
				sortorder: "asc",
				usepager: true,
				title: "Staff",
				useRp: true,
				rp: 10,
				showTableToggleBtn: false,
				resizable: false,
				width: 700,
				height: 370,
				singleSelect: true
				}
				);
				});
		
		
	</script>	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
</head>

<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';	
	include 		$_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
?>



	
	
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


<body>
<table id = "flex1">


</table>
</body>
</html>

			