<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/XHTML1-strict.dtd">
	
<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">
	<head>
		<title> SVL Prospect Management </title>
		<meta http-equiv ="content-type" content = "text/html; charset=utf-8"/>
		<link href="../css/main.css" rel="stylesheet" type="text/css" />
		
			
	</head>
	
	<body >
	<table border="0" cellpadding="0" width="100%" height="100%">
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
		include '../ca_menu.html.php';

		}


		if (userHasRole('Site Administrator'))
		{
		include '../sa_menu.html.php';

		}

	?>
	</td>
	<td width="80%">		
		<h2> SVL Prospect Management </h2>
		<form action = "" method = "get">
		<table border="0" cellspacing="5">
		<tr>
		<td colspan="3">
		<p> View prospect satisfying the following criteria : </p>
		</td>
		</tr>
		
		<tr>
		<td>
		<div>
		<label for = "bus_name"> Business Name: </label><br/>
		<select name = "bus_name" id = "bus_name">
		<option value =""> Any business </option>
		<?php foreach ($bus_names as $bus_name): ?>
		<option value ="<?php htmlout($bus_name['id']); ?> "> 
		<?php htmlout($bus_name['bus_name']); ?>
		</option>
		<?php endforeach; ?>
		</select>
		</div>
		</td>
		
		<td>
		<div>
		<label for = "prim_contact_fname"> By Primary Contact First name: </label><br/>
		<select name = "prim_contact_fname" id = "prim_contact_fname">
		<option value = ""> Any Contact </option>
		<?php foreach ($prim_contact_fnames as $prim_contact_fname): ?>
		<option value ="<?php htmlout($prim_contact_fname['id']); ?> "> 
		<?php htmlout($prim_contact_fname['prim_contact_fname']); ?> 
		</option>
		<?php endforeach; ?>
		</select>
		
		
		</div>
		</td>
		<td>
		<div>
		<label for = "street_addr"> Containing street address: </label><br/>
		<input type = "street_addr" name = "street_addr" id = "street_addr" />
		</div>
		</td>
		</tr>
		<tr>
		<td colspan="3">
		<div>
		<input type = "hidden" name = "action" value = "search"/>
		<input type = "submit" value = "Search" />
		</div>
		</td>
		</tr>
		</table>
		</form>
		
		