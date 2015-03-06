<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';


	
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
	
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
	
		$pagetitle 			= 'New User';
		$action 			= 'addform';
		$username 			= '';
		$password 			= '';
		$id 				= '';
		$button 			= 'Add';
		
		//build the list of roles
		$sql = "SELECT * FROM role";
		
		$result = mysqli_query($link, $sql);
		
		if (!$result)
		{
		$error = 'Error fetching list of roles.';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
		}
	
	while ($row = mysqli_fetch_array($result))
	{
		$roles[] = array(
		'id' => $row['id'],
		'description' => $row['description'],
		'selected' => FALSE);
	}
	
	include 'form.html.php';
	exit();
	
	}
	
	if (isset($_GET['addform']))
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
		
		$username = mysqli_real_escape_string($link, $_POST['username']);
		$password = mysqli_real_escape_string($link, $_POST['password']);
		
		$sql = "INSERT INTO users SET
				username = '$username',
				password = '$password'";
				
				if(!mysqli_query($link, $sql))
				{
				$error = 'Error adding submitted user';
				include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
				exit();
				}
				
			$userid = mysqli_insert_id($link);
			
			if ($_POST['password'] !='')
			{
			$password = mysqli_real_escape_string($link, $_POST['password']);
			$sql = "UPDATE users SET
			password = '$password'
			where id  = '$userid'";
			
			if (!mysqli_query($link, $sql)) 
				{
				$error = 'Error setting user password';
				include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
				exit();
			
				}
			}
	if (isset($_POST['roles']))
	{
	foreach ($_POST['roles'] as $role)
	{
	$roleid = mysqli_real_escape_string($link, $role);
	$sql = "INSERT INTO userrole SET 
			userid = '$userid',
			roleid = '$roleid'";
			
			if (!mysqli_query($link, $sql))
			{
			$error = 'Error assigning selected role to user.';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
			}
		}
	}
		header('Location: .');
		exit();
	}
	if(isset($_POST['action']) and $_POST['action'] == 'Edit')
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
		
		$id = mysqli_real_escape_string($link, $_POST['id']);
		
		$sql = "SELECT id, username, password FROM users where id = '$id'";
		$result = mysqli_query($link, $sql);
		if(!$result)
		{
			$error = 'Error fetching user details';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	$row = mysqli_fetch_array($result);

		$pagetitle = 'Edit User';
		$action = 'editform';
		$username = $row['username'];
		$password = $row['password'];
		$id = $row['id'];
		$button = 'Update';

		//get list of roles assigned to user
		
		$sql = "SELECT roleid FROM userrole WHERE userid = '$id'";
		
		$result = mysqli_query($link, $sql);
		
		if (!$result)
		{
			$error = 'Error fetching list of assigned roles';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		
		$selectedRoles = array();
		
		while ($row = mysqli_fetch_array($result))
		{
			$selectedRoles[] = $row['roleid'];
		}
		
		//build the list of roles
		$sql = "SELECT id, description FROM role";
		
		$result = mysqli_query($link, $sql);
		
		if(!$result)
		{
			$error = 'Error fetching list of roles.';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		
		
	while ($row = mysqli_fetch_array($result))
	{
	$roles[] = array(
		'id' => $row['id'],
		'description' => $row['description'],
		'selected' => in_array($row['id'], $selectedRoles));
	}
	
	include 'form.html.php';
	exit();
	
	}
	
	
	
	if (isset($_GET['editform']))
	{
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
	
	$id = mysqli_real_escape_string($link, $_POST['id']);
	$username = mysqli_real_escape_string($link, $_POST['username']);
	$password = mysqli_real_escape_string($link, $_POST['password']);
	
	$sql = "UPDATE users SET
			username = '$username',
			password = '$password'
			WHERE id = '$id'";
			
			if(!mysqli_query($link, $sql))
			{
			$error = 'Error updating submitted author.';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
			}
			
			if ($_POST['password'] !='')
			{
			$password = mysqli_real_escape_string($link, $_POST['password']);
			
			$sql = "UPDATE users SET
					password = '$password'
					WHERE id = '$id'";
					if (!mysqli_query($link, $sql))
					{
					$error = 'Error setting user password';
					include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
					exit();
					}
				}
				
			$sql = "DELETE FROM userrole WHERE userid = '$id'";
		if (!mysqli_query($link, $sql))
			{
			$error = 'Error removing obsolete user role entries';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
			}
			
			if(isset($_POST['roles']))
			{
			foreach ($_POST['roles'] as $role)
			{
			$roleid = mysqli_real_escape_string($link, $role);
			$sql = "INSERT INTO userrole SET
					userid = '$id',
					roleid = '$roleid'";
					
					if (!mysqli_query($link, $sql))
					{
					$error = 'Error assigning selected role to user.';
					include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
					exit();
					}
			}
		}
	header('Location: .');
	exit();
	}
	
	if (isset($_POST['action']) and $_POST['action'] == 'Delete')
	{
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
	
	$id = mysqli_real_escape_string($link, $_POST['id']);
	
	//Delete role assignment for this user
	
	$sql = "DELETE FROM userrole WHERE userid = '$id'";
	
	if(!mysqli_query($link, $sql))
	{
	
	$error = 'Error removing user from roles.';
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
	exit();
	
	}
	
	//Delete the user
	$sql = "DELETE FROM users WHERE id = '$id'";
	
	if(!mysqli_query($link, $sql))
	{
		$error = 'Error deleting user.';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	
	header('Location: .');
	exit();
	
	
	}
	
	
	
	
	//Display list of users
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
	$result = mysqli_query($link, 'SELECT id, username, password FROM users');
	
	if(!$result)
	{
		$error = 'Error fetching users from database';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	
	
	while ($row = mysqli_fetch_array($result))
	{
	$users[] = array('id' => $row['id'], 'username' => $row['username'], 'password' => $row['password']);
	}
	
	
	include 'users.html.php';
	
	
	?>