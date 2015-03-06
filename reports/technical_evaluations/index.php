<?php

include_once 	$_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
include 		$_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
require_once 	$_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

	if (!userIsLoggedIn())
	{
		include '../index.php';
		exit();
	}

	if (userHasRole('Site Administrator' or 'Content Administrator'))
	{
		$error = 'Only Site or Content Administrator may access this page';
		include '../accessdenied.html.php';
		exit();
	}


	


	
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/date_range_selection.html.php';
	exit();

	
	
	if(isset($_REQUEST['action']) and $_REQUEST['action'] == 'search')
	{
	
	}
		
			
	
	?>