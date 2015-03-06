<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
	
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
	

if (!userIsLoggedIn())
{
	include 'login.html.php';
	exit();
}

include 'default.html.php';
?>
