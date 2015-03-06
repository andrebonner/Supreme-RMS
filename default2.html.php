<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/XHTML1-strict.dtd">
	
<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">
	<head>
		<title> SVL Prospect Management </title>
		<meta http-equiv ="content-type" content = "text/html; charset=utf-8"/>
	<link href="css/main.css" rel="stylesheet" type="text/css" />
		
			
	</head>
	
	<body >
	
	
	<table class="layout"  >
	<tr>
		<td colspan="2" height="20%">
			<h1> SVL Customer Service Management System </h1>
		</td>
		</tr>
	<tr>
	<td valign="top" width="20%">
	
	<?php 
	if (userHasRole('Content Administrator'))
{
	include 'ca_menu.html.php';

}


if (userHasRole('Site Administrator'))
{
	include 'sa_menu.html.php';

}
?>
</td>
	<td width="80%"></td>
</tr>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>
	
		