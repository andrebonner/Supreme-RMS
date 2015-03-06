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
		$pagetitle = 'SVL - New BDO';
		$action = 'addform';
		$name = '';
		$id = '';
		$status_id = '';
		$button = 'Add BDO';

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
	$status_id = mysqli_real_escape_string($link, $_POST['status_id']);
	
	$sql = "INSERT INTO bdo_officers SET
			name='$name',
			status_id = '$status_id' ";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error adding BDO.' . mysqli_error($link);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit')
{
	

	$id = mysqli_real_escape_string($link, $_POST['id']);
	$sql = "SELECT id, name, status_id FROM bdo_officers WHERE id='$id'";
	$result = mysqli_query($link, $sql);
	
	if (!$result)
	{
		$error = 'Error fetching bdo details.' . mysqli_error($link);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	$row = mysqli_fetch_array($result);

		$pagetitle = 'Edit BDO';
		$action = 'editform';
		$name = $row['name'];
		$id = $row['id'];
		$status_id = $row['status_id'];
		$button = 'Update BDO';

	
	
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
	
	$sql = "UPDATE bdo_officers SET
			name='$name',
			status_id = '$status_id'
			
			WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error updating BDO.' . 	mysqli_error($link);
				
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{
	
	$id = mysqli_real_escape_string($link, $_POST['id']);


	// Delete bdo
	$sql = "DELETE FROM bdo_officers WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error deleting BDO.';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

// Display all BDO

$result = mysqli_query($link, 'SELECT bdo_officers.id, bdo_officers.name, status_id, status FROM bdo_officers INNER JOIN statustype ON status_id = statustype.id');
if (!$result)
{
	$error = 'Error fetching Business Development Officers from database!' . mysqli_error($link);
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
	exit();
}

while ($row = mysqli_fetch_array($result))
{
	$bdo_officers[] = array('id' => $row['id'], 'name' => $row['name'], 'status' => $row['status']);
}

include 'bdo_officers.html.php';
?>
