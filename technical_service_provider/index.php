<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

if (!userIsLoggedIn())
{
	include '../login.html.php';
	exit();
}


if (!userHasRole('Site Administrator'))
{
	$error = 'Only Site Administrator may access this page';
	include '../accessdenied.html.php';
	exit();
}



if (isset($_GET['add']))
{
	$pagetitle = 'New Service Provider';
	$action = 'addform';
	$name = '';
	$id = '';
	$status_id = '';
	$button = 'Add';

	//Build list of statuses
		$sql = "SELECT * FROM statustype";
		$result = mysqli_query($link, $sql);
		
		if (!$result)
		{
			$error = 'Error fetching list of statuses' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		while ($row = mysqli_fetch_array($result))
		{
			$statuses[] = array('id' => $row['id'], 'status' => $row['status'], 'desc' => $row['desc'] );
		}
	
		
	
	
	
	
	
	
	
	include 'form.html.php';
	exit();
}

if (isset($_GET['addform']))
{
	

	$name = mysqli_real_escape_string($link, $_POST['name']);
	$status_id = mysqli_real_escape_string($link, $_POST['status_id']);
	
	$sql = "INSERT INTO tech_eval_serv_providers SET
			name='$name',
			status_id = '$status_id' ";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error adding technical service provider to database' . mysqli_error($link);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit')
{
	

	$id = mysqli_real_escape_string($link, $_POST['id']);
	$sql = "SELECT id, name, status_id FROM tech_eval_serv_providers WHERE id='$id'";
	$result = mysqli_query($link, $sql);
	if (!$result)
	{
		$error = 'Error fetching service provider from database.' . mysqli_error($link);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	$row = mysqli_fetch_array($result);

	$pagetitle = 'Edit Service Provider';
	$action = 'editform';
	$name = $row['name'];
	$id = $row['id'];
	$status_id = $row['status_id'];
	$button = 'Update';

	
	
	//Build list of statuses
		$sql = "SELECT * FROM statustype";
		$result = mysqli_query($link, $sql);
		
		if (!$result)
		{
			$error = 'Error fetching list of statuses' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		while ($row = mysqli_fetch_array($result))
		{
			$statuses[] = array('id' => $row['id'], 'status' => $row['status'], 'desc' => $row['desc'] );
		}
	
	
	
	
	
	
	
	
	
	include 'form.html.php';
	exit();
}

if (isset($_GET['editform']))
{

	$id = mysqli_real_escape_string($link, $_POST['id']);
	$name = mysqli_real_escape_string($link, $_POST['name']);
	$status_id = mysqli_real_escape_string($link, $_POST['status_id']);
	
	$sql = "UPDATE tech_eval_serv_providers SET
			name='$name',
			status_id = '$status_id'
			
			WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error updating service provider.' . 	mysqli_error($link);
				
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{
	
	$id = mysqli_real_escape_string($link, $_POST['id']);


	// Delete technical service provider
	$sql = "DELETE FROM  tech_eval_serv_providers WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error deleting technical service provider from database.';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

// Display all technical service provider

$result = mysqli_query($link, 'SELECT tech_eval_serv_providers.id, tech_eval_serv_providers.name, 
status_id, status FROM tech_eval_serv_providers INNER JOIN statustype ON status_id = statustype.id');


if (!$result)
{
	$error = 'Error fetching technical service providers from database!' . mysqli_error($link);
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
	exit();
}

while ($row = mysqli_fetch_array($result))
{
	$technical_providers[] = array('id' => $row['id'], 'name' => $row['name'], 'status' => $row['status']);
}

include 'technical_providers.html.php';
?>
