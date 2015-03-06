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
		$pagetitle = 'New Trade Style';
		$action = 'addform';
		$name = '';
		$id = '';
		$status_id = '';
		$code = '';
		$button = 'Add Trade Style';

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
				$statuses[] = array('id' => $row['id'], 'status' => $row['status'],
				'desc' => $row['desc'] );
			}
	
		include 'form.html.php';
		exit();
}

if (isset($_GET['addform']))
{
	

	$name = mysqli_real_escape_string($link, $_POST['name']);
	$code = mysqli_real_escape_string($link, $_POST['code']);
	$status_id = mysqli_real_escape_string($link, $_POST['status_id']);
	
	$sql = "INSERT INTO trade_style SET
			name='$name',
			code ='$code',
			status_id = '$status_id' ";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error adding trade_style.' . mysqli_error($link);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit')
{
	

	$id = mysqli_real_escape_string($link, $_POST['id']);
	$sql = "SELECT id, name, code, status_id FROM trade_style WHERE id='$id'";
	$result = mysqli_query($link, $sql);
	
	if (!$result)
	{
		$error = 'Error fetching business trade style details.' . mysqli_error($link);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	$row = mysqli_fetch_array($result);

		$pagetitle = 'Edit Trade Style';
		$action = 'editform';
		$name = $row['name'];
		$id = $row['id'];
		$code = $row['code'];
		$status_id = $row['status_id'];
		$button = 'Update Trade Style';

	
	
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
	$code = mysqli_real_escape_string($link, $_POST['code']);
	$status_id = mysqli_real_escape_string($link, $_POST['status_id']);
	
	$sql = "UPDATE trade_style SET
			name='$name',
			code ='$code',
			status_id = '$status_id'
			WHERE id='$id'";
			
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error updating business trade style.' . 	mysqli_error($link);
				
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{
	
	$id = mysqli_real_escape_string($link, $_POST['id']);


	// Delete trade_style
	$sql = "DELETE FROM trade_style WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error deleting trade_style.' .  	mysqli_error($link);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

// Display all business trade_style

$result = mysqli_query($link, 'SELECT trade_style.id, trade_style.name, trade_style.code, 
status_id, statustype.status FROM trade_style INNER JOIN statustype ON status_id = statustype.id');


if (!$result)
{
	$error = 'Error fetching trade_style from database!' . mysqli_error($link);
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
	exit();
}

while ($row = mysqli_fetch_array($result))
{
	$trade_styles[] = array('id' => $row['id'], 'name' => $row['name'], 
	'code' => $row['code'], 'status' => $row['status']);
}

include 'trade_styles.html.php';
?>
