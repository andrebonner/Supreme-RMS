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
	$pagetitle = 'New Registration Type';
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
	
	$sql = "INSERT INTO bus_reg_type SET
			name='$name',
			status_id = '$status_id' ";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error adding business registration type to database' . mysqli_error($link);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit')
{
	

	$id = mysqli_real_escape_string($link, $_POST['id']);
	$sql = "SELECT id, name, status_id FROM bus_reg_type WHERE id='$id'";
	$result = mysqli_query($link, $sql);
	if (!$result)
	{
		$error = 'Error fetching business registration types from database.' . mysqli_error($link);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	$row = mysqli_fetch_array($result);

	$pagetitle = 'Edit Registration Type';
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
	
	$sql = "UPDATE bus_reg_type SET
			name='$name',
			status_id = '$status_id'
			
			WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error updating business registration type.' . 	mysqli_error($link);
				
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
	$sql = "DELETE FROM  bus_reg_type WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error deleting business registration type from database.';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

// Display all application type

$result = mysqli_query($link, 'SELECT bus_reg_type.id, bus_reg_type.name, 
status_id, status FROM bus_reg_type INNER JOIN statustype ON status_id = statustype.id');


if (!$result)
{
	$error = 'Error fetching business registration types from database!' . mysqli_error($link);
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
	exit();
}

while ($row = mysqli_fetch_array($result))
{
	$bus_reg_types[] = array('id' => $row['id'], 'name' => $row['name'], 'status' => $row['status']);
}

include 'bus_reg_types.html.php';
?>
