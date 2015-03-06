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


//Build list of agent no
	$result = mysqli_query($link, 'SELECT id, agentno FROM prospect_mgmt');
		
	if (!$result)
	{
		$error = 'Error fetching agent number from database!';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	
	while ($row = mysqli_fetch_array($result))
		{
			$agentnumbers[] = array('id' => $row['id'], 'agentno' => $row['agentno']);
		}


	
	if (isset($_GET['add']))
	{
		$pagetitle 				= 'New Relocation Request	';
		$action 				= 'addform					';
		$id 					= 							'';
		$agentno 				= 							'';
		$relocation_date 		= 							'';
		$relocate_to	 		= 							'';
		$sub_to_serv_prov_date	=							'';
		$completion_date		=							'';
		$note					=							'';
		$button 				= 'Add						';
	
	
	//build list of agent number
	$result = mysqli_query($link, 'SELECT id, agentno FROM prospect_mgmt');
		
	if (!$result)
	{
		$error = 'Error fetching agent number from database!';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	
	while ($row = mysqli_fetch_array($result))
		{
			$agentnumbers[] = array('id' => $row['id'], 'agentno' => $row['agentno']);
		}
		
	
	//build list of relocation types
	$result = mysqli_query($link, 'SELECT id, name FROM relocation_type');
		
	if (!$result)
	{
		$error = 'Error fetching relocation type from database!';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	
	while ($row = mysqli_fetch_array($result))
		{
			$relocation_types[] = array('id' => $row['id'], 'name' => $row['name']);
		}
		
	
		
	
	
		include 'form.html.php';
		exit();
	}


	if (isset($_GET['addform']))
	{
	
	$agentno 				= mysqli_real_escape_string($link, $_POST['agentno']);
	$relocation_type 		= mysqli_real_escape_string($link, $_POST['relocation_type']);
	$relocate_to 			= mysqli_real_escape_string($link, $_POST['relocate_to']);

	
	
		
	$sql = "INSERT INTO relocation_mgmt SET 
				agentno 				= '$agentno					',
				relocation_type			= '$relocation_type			',
				relocate_to			= '$relocate_to			' ";
			
			if (!mysqli_query($link, $sql))
			{
			$error = 'Error adding relocation request to database '. mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
			}
			
		$prospect_id = mysqli_insert_id($link);
		
		
	
		
	header('Location: .');
	exit();
	}
	
	
	
	

	if (isset($_REQUEST['action']) and $_REQUEST['action'] == 'Edit' )
	
	{
	
		$id = mysqli_real_escape_string ($link, $_REQUEST['id']);
	
		$sql = "SELECT 	* FROM relocation_mgmt where id = '$id'";
		$result = mysqli_query($link, $sql);
		
	if (!$result)
		{
			$error = 'Error fetching relocation details' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	
		$row = mysqli_fetch_array($result);
		
		$pagetitle = 'Edit Relocation details';
		$action = 'editform';
		$id 								= $row['id'];
		$agentno		 					= $row['agentno'];
		$relocate_to						= Trim($row['relocate_to']);
		$button ='Update Details';

		
		//build list of agent number
	$result = mysqli_query($link, 'SELECT id, agentno FROM prospect_mgmt');
		
	if (!$result)
	{
		$error = 'Error fetching agent number from database!';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	
	while ($row = mysqli_fetch_array($result))
		{
			$agentnumbers[] = array('id' => $row['id'], 'agentno' => $row['agentno']);
		}
		
			
	include 'form.html.php';

	exit();
	}
	

	if(isset($_GET['editform']))
	{
	
	$id = mysqli_real_escape_string ($link, $_POST['id']);
	$corporate_name = mysqli_real_escape_string($link, $_POST['corporate_name']);
	$bus_name = mysqli_real_escape_string($link, $_POST['bus_name']);
	$street_addr = mysqli_real_escape_string($link, $_POST['street_addr']);
	$bdo_officer_id 					= mysqli_real_escape_string($link, $_POST['bdo_officer_id']);

	
			
	$sql = "UPDATE prospect_mgmt SET
			corporate_name 		= '$corporate_name		',
			bus_name 			= '$bus_name			',
			street_addr			= '$street_addr			',
			parish_id			= '$parish_id			',
			city_id 			= '$city_id				',
			zipcode_id 			= '$zipcode_id			',
			country_id 			= '$country_id			',
			bdo_officer_id 					= '$bdo_officer_id					'
			WHERE id = '$id' ";
			
			
		if (!mysqli_query($link, $sql))
		{
			$error = 'Error updating applicant details '. mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		
		$sql = "DELETE FROM prospect_trade_style WHERE prospect_id  = '$id'";
		
		if (!mysqli_query($link, $sql))
		{
			$error = 'Error removing applicant business trade style';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	
		
	
	header('Location: .');
	exit();
	
	}
	

	
	//Display search form 
	
	$result = mysqli_query($link, 'SELECT prospect_mgmt.id, bus_name FROM prospect_mgmt 
									INNER JOIN relocation_mgmt on prospect_mgmt.agentno 
									= relocation_mgmt.agentno');
		
		if (!$result)
		{
			$error = 'Error fetching business names from database!';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	
	while ($row = mysqli_fetch_array($result))
		{
			$bus_names[] = array('id' => $row['id'], 'bus_name' => $row['bus_name']);
		}
	
	
	$result = mysqli_query($link, 'SELECT id, agentno FROM prospect_mgmt');
		
	if (!$result)
	{
		$error = 'Error fetching agent number from database!';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	
	while ($row = mysqli_fetch_array($result))
		{
			$agentnumbers[] = array('id' => $row['id'], 'agentno' => $row['agentno']);
		}
	
	
	
	
	
	$result = mysqli_query($link, 'SELECT prospect_mgmt.id, prim_contact_fname FROM prospect_mgmt 
								INNER JOIN relocation_mgmt on prospect_mgmt.agentno 
									= relocation_mgmt.agentno
									WHERE prim_contact_fname IS NOT NULL');
	
	if (!$result)
	{
		$error = 'Error fetching contact names from database!';
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	
		
	while ($row = mysqli_fetch_array($result))
	{
		$prim_contact_fnames[] = array('id' => $row['id'], 'prim_contact_fname' => $row['prim_contact_fname']);
	}

		
	
	include 'search_criteria.html.php';
	

	
	
	if(isset($_REQUEST['action']) and $_REQUEST['action'] == 'search')
	{
	//the basic SELECT statement
	
	$select = 'SELECT 	prospect_mgmt.id, 
						relocation_mgmt.id,
						bus_name, 
						relocation_mgmt.agentno,
						relocation_type,
						relocation_date,
						relocate_to,
						note,
						prim_contact_fname, 
						prim_contact_lname, 
						street_addr, 
						parish.name,
						prospect_mgmt.parish_id,
						bus_phone,
						cities.name,
						city_id ';
						
	$from = ' FROM prospect_mgmt 	INNER JOIN relocation_mgmt on prospect_mgmt.agentno = relocation_mgmt.agentno
									INNER JOIN parish ON prospect_mgmt.parish_id = parish.id
									INNER JOIN cities ON prospect_mgmt.city_id = cities.id ';
	
		
	$where = ' WHERE TRUE ';
	
	
	
	
	$bus_name = mysqli_real_escape_string($link, $_GET['bus_name']);
	
	if ($bus_name != '')  // business name is selected 
	{
		$where .= " AND prospect_mgmt.id = '$bus_name' ";
	}
	
	
	$agentno = mysqli_real_escape_string($link, $_GET['agentno']);
	
	if ($agentno != '')  // agent number is selected 
	{
		$where .= " AND prospect_mgmt.id  = '$agentno' ";
	}
	
	
	
	
	$prim_contact_fname = mysqli_real_escape_string($link, $_GET['prim_contact_fname']);
	
	if ($prim_contact_fname != '')  // a primary contact first name is selected 
	{
	$where .= " AND prospect_mgmt.id  = '$prim_contact_fname' ";
	
	}
	
	$street_addr = mysqli_real_escape_string($link, $_GET['street_addr']);
	if ($street_addr != '' ) // street address entered  
	{
	$where .= " AND street_addr LIKE  '%$street_addr%' ";
	}
	

	$result = mysqli_query($link, $select . $from . $where);
	
	if (!$result)
	{
		$error = 'Error fetching prospect details from database!' . mysqli_error($link);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	
	while ($row = mysqli_fetch_array($result))
	{
		$relocations[] = array('id' => $row['id'], 
			'agentno' 						=> $row['agentno'], 
			'bus_name'						=> $row['bus_name'],
			'street_addr'					=> $row['street_addr'],
			'relocation_type'				=> $row['relocation_type'],
			'relocation_date'				=> $row['relocation_date'],
			'relocate_to' 					=> $row['relocate_to'],
			'note' 							=> 	$row['note']
			);
	}
}
	include 'prospect.html.php';
	
	exit();
	
	
			
	
	?>