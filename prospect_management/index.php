<?php

		include_once 	$_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
		include 		$_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
		require_once 	$_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
		require_once 	$_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
		
		//Check if user is already logged in, if not open login form
		if (!userIsLoggedIn())
		{
			include '../index.php';
			exit();
		}
		
		//Check user permission and role assignment
		if (userHasRole('Site Administrator' or 'Content Administrator'))
		{
			$error = 'Only Site or Content Administrator may access this page';
			include '../accessdenied.html.php';
			exit();
		}

	//AJAX code for parish selection -> town selection -> postal code selection
	if (isset($_REQUEST['ajax']) && $_REQUEST['ajax']==true)
	{
		if (isset($_REQUEST['town']))
		{
			$parish_id = $_REQUEST['parish'];
			if(isset($_REQUEST['id']))	$id = $_REQUEST['id'];
			//Build the list of postal code for business address
					$sql = "SELECT * FROM postal_codes WHERE status_id = 1 AND parish_id = $parish_id ORDER BY post_office";
					$result = mysqli_query($link, $sql);
					
					if (!$result)
					{
						$error = 'Error fetching postal codes  ';
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}?>
                    <select name = "<?php echo $id;?>" id = "<?php echo $id;?>" style="width: 200px"
					 tabindex=4 >
					<option value ="0"> Select Post Office </option>
					<?php while ($row = mysqli_fetch_array($result)){?>
						
					<option value = "<?php echo $row[0]; ?>" >		 
					
					<?php echo $row[1]; ?>  </option>
                    <?php }?>
					 </select>
		<?php
				
		}else if(isset($_REQUEST['parish'])) {
			$parish_id = $_REQUEST['parish'];
			if(isset($_REQUEST['id']))	$id = $_REQUEST['id'];
			//Build list of cities or town for business address
						$sql = "SELECT * FROM cities WHERE parish_id = '$parish_id' ORDER BY name";
						$result = mysqli_query($link, $sql);
						
						if (!$result)
						{
						$error = 'Error fetching cities or town ';
							include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
							exit();
						}
						?>
						 <select name = "<?php echo $id;?>" id = "<?php echo $id;?>" style="width: 200px"
                         <?php 
						if(isset($_REQUEST['post'])){
							$met = 'getOwnerPost';
					   	} else {
							$met = 'getTown';
						}?> tabindex=4 onchange="<?php echo $met;?>(<?php echo $parish_id;?>)">
					<option value ="0"> Select City </option>
					<?php while ($row = mysqli_fetch_array($result)){ ?>
							
					<option value = "<?php echo $row[0]; ?>" >		 
					
					<?php echo $row[1]; ?>  </option>
                    <?php }?>
					 </select>
<?php
		}
		
		if(isset($_REQUEST['grid']) && $_REQUEST['grid']=='prospect_mgmt'){
			
			$table = $_REQUEST['grid']; // table to pull data from
			
			$page = 1; // the current page
			$sortname = 'id'; // sort column
			$sortorder = 'asc'; // sort order
			$qtype = ''; // search column
			$query = ''; // search string
			$rp=5; //records per page
						
			// get posted data
			if(isset($_REQUEST['page'])){
				$page = mysql_real_escape_string($_REQUEST['page']);
			}
			if(isset($_REQUEST['sortname'])){
				$sortname = mysql_real_escape_string($_REQUEST['sortname']);
			}
			if(isset($_REQUEST['sortorder'])){
				$sortorder = mysql_real_escape_string($_REQUEST['sortorder']);
			}
			if(isset($_REQUEST['qtype'])){
				$qtype = mysql_real_escape_string($_REQUEST['qtype']);
			}
			if(isset($_REQUEST['query'])){
				$query = mysql_real_escape_string($_REQUEST['query']);
			}
			if(isset($_REQUEST['rp'])){
				$rp = mysql_real_escape_string($_REQUEST['rp']);
			}
			
			$where = 'where'; // where clause
			// setup sort and search SQL using posted data
			$sortSql = "order by $sortname $sortorder";
			if(isset($_REQUEST['action']) and $_REQUEST['action'] == 'search')
			{
			
			// User has selected business name 
					$bus_name = mysqli_real_escape_string($link, $_GET['bus_name']);
					
					if ($bus_name != '')  
					{
						$where .= " AND prospect_mgmt.id  = '$bus_name' ";
					}
					
					// User has selected agent number 
					$agentno = mysqli_real_escape_string($link, $_GET['agentno']);
					if ($agentno != '')  // agent number is selected 
					{
						$where .= " AND prospect_mgmt.id  = '$agentno' ";
					}
					
					// User has entered contact first name
					$prim_contact_fname = mysqli_real_escape_string($link, $_GET['prim_contact_fname']);
					if ($prim_contact_fname != '')  // a primary contact first name is selected 
					{
						$where .= " AND prospect_mgmt.id  = '$prim_contact_fname' ";
					}
			

					// User has entered contact street address			
					$street_addr = mysqli_real_escape_string($link, $_GET['street_addr']);
					if ($street_addr != '' ) // street address entered  
					{
						$where .= " AND street_addr LIKE  '%$street_addr%' ";
					}
	
					
	
					// User has selected status 
					$status_id = mysqli_real_escape_string($link, $_GET['status_id']);
					if ($status_id != '')   
					{
						$where .= " AND statustype.id   = '$status_id' ";
					}
	
					
					// User has selected service provider 
					$tech_eval_serv_prov_id = mysqli_real_escape_string($link, $_GET['tech_eval_serv_prov_id']);
					if ($tech_eval_serv_prov_id != '')   
					{
						$where .= " AND tech_eval_serv_providers.id   = '$tech_eval_serv_prov_id' ";
					}
			}
			$searchSql = ($qtype != '' && $query != '') ? "where $qtype = '$query'" : "$where TRUE";
			//get total count of records
			$sql = "select count(*) 
			from $table
			$searchSql";
			$result = mysqli_query($link, $sql);
			//echo $sql;
			$row = mysqli_fetch_array($result);
			$total = $row[0];
			// Setup paging SQL
			$pageStart = ($page-1)*$rp;
			$limitSql = "limit $pageStart, $rp";
			// Return JSON data
			$data['page'] = $page;
			$data['total'] = $total;
			$data['rows'] = array();
		
			$sql = "select prospect_mgmt.id, 
						bus_name, 
						agentno,
						prim_contact_fname, 
						prim_contact_lname, 
						street_addr, 
						parish.name,
						prospect_mgmt.parish_id,
						bus_phone,
						cities.name,
						prospect_mgmt.tech_eval_serv_prov_id,
						prospect_mgmt.status_id,
						city_id  from $table 
						inner join parish on prospect_mgmt.parish_id = parish.id
						inner join cities on prospect_mgmt.city_id = cities.id
						inner join statustype on prospect_mgmt.status_id = statustype.id 
						inner join tech_eval_serv_providers on 
						prospect_mgmt.tech_eval_serv_prov_id  = tech_eval_serv_providers.id
												
			$searchSql
			$sortSql
			$limitSql";
			$results = mysqli_query($link,$sql);
			//echo $sql;
			//exit;
			
			while($row = mysqli_fetch_assoc($results)){
				$data['rows'][] = array('id' =>$row['id'],
				'cell'=>array('id' =>$row['id'],
				'bus_name' =>$row['bus_name'],
				'street_addr' =>$row['street_addr'],
				'parish.name' =>$row['name'],
				'prim_contact_fname' =>$row['prim_contact_fname'].' '.$row['prim_contact_lname'],
				'bus_phone' =>$row['bus_phone'])
				);
			}

			echo json_encode($data);

		}
		exit;
	}
 
	if (isset($_GET['add']))
	{
		$pagetitle 						= 'New Applicant	';
		$action 						= 'addform			';
		$id 							= 					'';
		$corporate_name 				= 					'';
		$bus_name 						= 					'';
		$street_addr 					= 					'';
		$parish_id 						= 					'';
		$city_id 						= 					'';
		$zipcode_id 					=					'';
		$country_id 					=					'1';
		$prim_contact_fname 			=					'';
		$prim_contact_lname 			=					'';
		$sec_contact_fname 				=					'';
		$sec_contact_lname 				=					'';
		$bus_phone 							= 					'';
		$alt_phone 							= 					'';
		$home_addr							= 					'';
		$owner_parish						= 					'';
		$owner_town							= 					'';
		$owner_zipcode						= 					'';
		$home_phone							= 					'';
		$mobile_phone						= 					'';
		$faxno	 							= 					'';
		$email 								= 					'';
		$trn 								=					'';
		$multiple_agent 					=   				'';
		$multiple_terminal 					=   				'';
		$bus_anal_bdo 						=					'';
	 	$bus_anal_comp_date 				=					'';
	 	$bus_anal_result_id					=					'';
	 	$bus_anal_note 						=					'';
	 	$pck_sub_to_pros_date 				=					'';
	 	$pck_recd_by_pros_date 				=					'';
	 	$contract_sub_to_pros_date 			=					'';
	 	$contract_ret_date 					=					'';
	 	$sec_chk_req_date 					=					'';
	 	$sec_chk_comp_date 					=					'';
	 	$sec_chk_serv_prov_id 				=					'';
	 	$bnk_grant_recd_date 				=					'';
	 	$bnk_acc_req_date 					=					'';
	 	$bnk_accno 							=					'';
	 	$tech_eval_sub_to_serv_prov_date 	=					'';
	 	$tech_eval_serv_prov_id 			=					'';
	 	$tech_eval_result_id 				=					'';
	 	$tech_eval_note 					=					'';
	 	$tech_eval_recd_date 				=					'';
	 	$agent_config_date 					=					'';	
	 	$terminal_install_date				=					'';
		$bdo_officer_id 					= 					'';
		$csr_officer_id 					= 					'';
		$trade_style_id						= 					'';
		$bus_reg_type_id					=					'';
		$application_type_id 				=					'';
		$mon_openingtime					=					'';
		$tue_openingtime					=					'';
		$wed_openingtime					=					'';
		$thu_openingtime					=					'';
		$fri_openingtime					=					'';
		$sat_openingtime					=					'';
		$sun_openingtime					=					'';
		$mon_closingtime					=					'';
		$tue_closingtime					=					'';
		$wed_closingtime					=					'';
		$thu_closingtime					=					'';
		$fri_closingtime					=					'';
		$sat_closingtime					=					'';
		$sun_closingtime					=					'';
		$status_id							=					'';
		$application_date					=					'';
		$button 							= 'Add';
	
				
	
	
	
					//build list of state or parishes for business address
						$sql = "SELECT * FROM parish WHERE status_id = 1  ";
						$result = mysqli_query($link, $sql);
						if (!$result)
						{
							$error = 'Error fetching state or parishes ';
							include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
							exit();
						}
						
						while ($row = mysqli_fetch_array($result))
						{
							$parishes[] = array('id' => $row['id'], 'name' => $row['name']);
						}
	
	
					//build list of state or parishes for owner address
						$sql = "SELECT * FROM parish WHERE status_id = 1  ";
						$result = mysqli_query($link, $sql);
						if (!$result)
						{
							$error = 'Error fetching state or parishes ';
							include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
							exit();
						}
						
						while ($row = mysqli_fetch_array($result))
						{
							$owner_parishes[] = array('id' => $row['id'], 'name' => $row['name']);
						}
					
		
						//Build list of cities or town for business address
						$sql = "SELECT * FROM cities WHERE status_id = 1 ORDER BY name";
						$result = mysqli_query($link, $sql);
						
						if (!$result)
						{
						$error = 'Error fetching cities or town ';
							include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
							exit();
						}
						while ($row = mysqli_fetch_array($result))
						{
							$cities[] = array('id' => $row['id'], 'name' => $row['name']);
						}
		
		
					//Build list of cities or town for owner address
					$sql = "SELECT * FROM cities WHERE status_id = 1 ORDER BY name";
					$result = mysqli_query($link, $sql);
					
					if (!$result)
					{
						$error = 'Error fetching cities or town ';
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
					while ($row = mysqli_fetch_array($result))
					{
						$owner_cities[] = array('id' => $row['id'], 'name' => $row['name']);
					}
					
		
		
					//BUILD LIST OF POSTAL CODE FOR BUSINESS ADDRESS
					$sql = "SELECT * FROM postal_codes WHERE status_id = 1 ORDER BY post_office";
					$result = mysqli_query($link, $sql);
					
					if (!$result)
					{
						$error = 'Error fetching postal codes  ';
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
					while ($row = mysqli_fetch_array($result))
					{
						$zipcodes[] = array(	'id' => $row['id'], 
												'postal_code' => $row['postal_code'],
												'parish_id' => $row['parish_id'],
												'post_office' => $row['post_office'],
												'zone' => $row['zone']);
					}	
					
					
					
					//BUILD LIST OF POSTAL CODE FOR OWNER ADDRESS
					$sql = "SELECT * FROM postal_codes WHERE status_id = 1 ORDER BY post_office";
					$result = mysqli_query($link, $sql);
					
					if (!$result)
					{
						$error = 'Error fetching postal codes  ';
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
					while ($row = mysqli_fetch_array($result))
					{
						$owner_zipcodes[] = array(	'id' => $row['id'], 
												'postal_code' => $row['postal_code'],
												'parish_id' => $row['parish_id'],
												'post_office' => $row['post_office'],
												'zone' => $row['zone']);
					}	
					
					
					
					
					
					
					
					
					//Build list of countries
						$sql = "SELECT * FROM countries WHERE status_id = 1 ORDER BY id";
						$result = mysqli_query($link, $sql);
						
						if (!$result)
						{
							$error = 'Error fetching list of countries' . mysqli_error($link);
							include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
							exit();
						}
						while ($row = mysqli_fetch_array($result))
						{
							$countries[] = array('id' => $row['id'], 'name' => $row['name']);
						}
						
						
						//Build list of application types
							$sql = "SELECT * FROM application_type WHERE status_id = 1 ";
							$result = mysqli_query($link, $sql) ;
							
							if (!$result)
							{
								$error = 'Error fetching list of application type ' . mysqli_error($link);
								include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
								exit();
							}
							while ($row = mysqli_fetch_array($result))
							{
								$application_types[] = array('id' => $row['id'], 'name' => $row['name']);
							}
											
						//Build the list of business trade styles
							$sql = "SELECT * FROM trade_style WHERE status_id = 1 ";
							$result = mysqli_query($link, $sql);
							if (!$result)
							{
								$error = 'Error fetching list of business trade style' . mysqli_error($link);
								include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
								exit();
							}
						
							while ($row = mysqli_fetch_array($result))
							{
								$trade_styles[]= array('id' => $row['id'], 'name' => $row['name']);
							}
							
						
						
						//Build the list of BDO officer
							$sql = "SELECT * FROM bdo_officers WHERE status_id = 1 ";
							$result = mysqli_query($link, $sql);
							
							if (!$result)
							{
								$error = 'Error fetching list of BDOs'. mysqli_error($link);
								include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
								exit();
							}
							while ($row = mysqli_fetch_array($result))
							{
								$bdo_officers[] = array('id' => $row['id'], 'name' => $row['name']);
							}
												
							
							//Build the list of CSR officer
								$sql = "SELECT * FROM csr_officers WHERE status_id = 1 ";
								$result = mysqli_query($link, $sql);
								
								if (!$result)
								{
									$error = 'Error fetching list of Customer Service Representative' . mysqli_error($link);
									include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
									exit();
								}
								while ($row = mysqli_fetch_array($result))
								{
									$csr_officers[] = array('id' => $row['id'], 'name' => $row['name']);
								}
							
							//Build the list of business analysis result
							$sql = "SELECT * FROM bus_anal_result WHERE status_id = 1  ORDER BY name ";
							$result = mysqli_query($link, $sql);
							
							if (!$result)
							{
								$error = 'Error fetching list of business analysis results' . mysqli_error($link);
								include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
								exit();
							}
							while ($row = mysqli_fetch_array($result))
							{
								$bus_anal_results[] = array('id' => $row['id'], 'name' => $row['name']);
							}
	
	
	//Build the list of security check service providers
		$sql = "SELECT * FROM security_chk_serv_providers WHERE status_id = 1 ORDER BY name";
		$result = mysqli_query($link, $sql);
		
		if (!$result)
		{
			$error = 'Error fetching list of security check service provider' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		while ($row = mysqli_fetch_array($result))
		{
			$sec_chk_serv_providers[] = array('id' => $row['id'], 'name' => $row['name']);
		}
	
	
	//Build the list of technical evaluation service provider
		$sql = "SELECT * FROM tech_eval_serv_providers WHERE status_id = 1 ORDER BY name";
		$result = mysqli_query($link, $sql);
		
		if (!$result)
		{
			$error = 'Error fetching list of technical evaluation service providers' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		while ($row = mysqli_fetch_array($result))
		{
			$tech_eval_serv_providers[] = array('id' => $row['id'], 'name' => $row['name']);
		}
	
	
	
	
	//Build the list of technical evaluation results
		$sql = "SELECT * FROM tech_eval_result WHERE status_id = 1 ";
		$result = mysqli_query($link, $sql);
		if (!$result)
		{
			$error = 'Error fetching list of business trade style' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	
		while ($row = mysqli_fetch_array($result))
		{
			$tech_eval_results[]= array('id' => $row['id'], 'name' => $row['name']);
		}
		
				
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
	
	//Build the list of business registration types
		$sql = "SELECT * FROM bus_reg_type WHERE status_id = 1 ";
		$result = mysqli_query($link, $sql);
		if (!$result)
		{
			$error = 'Error fetching list of business registration types' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	
		while ($row = mysqli_fetch_array($result))
		{
			$bus_reg_types[]= array('id' => $row['id'], 'name' => $row['name'], 'status_id' => $row['status_id']);
		}
	
			
		include 'form.html.php';
		exit();
	}


	if (isset($_GET['addform']))
	{
	
	$corporate_name 			= mysqli_real_escape_string($link, $_REQUEST['corporate_name']);
	$bus_name 					= mysqli_real_escape_string($link, $_REQUEST['bus_name']);
	$street_addr 				= mysqli_real_escape_string($link, $_REQUEST['street_addr']);
	$parish_id 					= mysqli_real_escape_string($link, $_REQUEST['parish_id']);
	$city_id 					= mysqli_real_escape_string($link, $_REQUEST['city_id']);
	$zipcode_id 				= mysqli_real_escape_string($link, $_REQUEST['zipcode_id']);
	$prim_contact_fname 		= mysqli_real_escape_string($link, $_REQUEST['prim_contact_fname']);
	$prim_contact_lname 		= mysqli_real_escape_string($link, $_REQUEST['prim_contact_lname']);
	$sec_contact_fname 			= mysqli_real_escape_string($link, $_REQUEST['sec_contact_fname']);
	$sec_contact_lname 			= mysqli_real_escape_string($link, $_REQUEST['sec_contact_lname']);
	$csr_officer_id 			= mysqli_real_escape_string($link, $_REQUEST['csr_officer_id']);
	$bus_phone 					= mysqli_real_escape_string($link, $_REQUEST['bus_phone']);
	$alt_phone 					= mysqli_real_escape_string($link, $_REQUEST['alt_phone']);
	$faxno	 					= mysqli_real_escape_string($link, $_REQUEST['faxno']);
	$email 						= mysqli_real_escape_string($link, $_REQUEST['email']);
	$home_addr					= mysqli_real_escape_string($link, $_REQUEST['home_addr']);
	$owner_parish				= mysqli_real_escape_string($link, $_REQUEST['owner_parish']);
	$owner_town					= mysqli_real_escape_string($link, $_REQUEST['owner_town']);
	$owner_zipcode				= mysqli_real_escape_string($link, $_REQUEST['owner_zipcode']);
	$home_phone					= mysqli_real_escape_string($link, $_REQUEST['home_phone']);
	$mobile_phone				= mysqli_real_escape_string($link, $_REQUEST['mobile_phone']);
	
	
	$trn 						= mysqli_real_escape_string($link, $_REQUEST['trn']);
	$application_type_id		= mysqli_real_escape_string($link, $_REQUEST['application_type_id']);
	
	if(isset($_REQUEST['multiple_agent'])){ 
		$multiple_agent 	=   '1';

		
	}else {		$multiple_agent 	=   '0';}
	
	
	if(isset($_REQUEST['multiple_terminal'])){ 
		$multiple_terminal 	=   '1';

		
	}else {		$multiple_terminal 	=   '0';}
	
	
	$bdo_officer_id 			= mysqli_real_escape_string($link, $_REQUEST['bdo_officer_id']);
	$bus_anal_bdo 				= mysqli_real_escape_string($link, $_REQUEST['bus_anal_bdo']);
	
	$application_date = 	mysqli_real_escape_string($link, ($_REQUEST['application_date'] != '') ? $_REQUEST['application_date'] : '0000-00-00');		
	//$application_date = 	date("Y-m-d H:i:s", strtotime($application_date));
	
	
		
	$bus_anal_result_id 		= mysqli_real_escape_string($link, $_REQUEST['bus_anal_result_id']);
	$bus_anal_note 				= mysqli_real_escape_string($link, $_REQUEST['bus_anal_note']);
	
	
	$pck_sub_to_pros_date 		= mysqli_real_escape_string($link, $_REQUEST['pck_sub_to_pros_date']);
	$pck_sub_to_pros_date 		= date('Y-m-d', strtotime(str_replace('-', '/', $pck_sub_to_pros_date)));
	
	
	$bus_anal_comp_date 		= mysqli_real_escape_string($link, $_REQUEST['bus_anal_comp_date']);
$bus_anal_comp_date			= date('Y-m-d H:m:s', strtotime(str_replace('-', '/', $bus_anal_comp_date)));
	
	
	$pck_recd_by_pros_date 		= mysqli_real_escape_string($link, $_REQUEST['pck_recd_by_pros_date']);
	$pck_recd_by_pros_date 		= date('Y-m-d', strtotime(str_replace('-', '/', $pck_recd_by_pros_date )));
	
	$contract_sub_to_pros_date 	= mysqli_real_escape_string($link, $_REQUEST['contract_sub_to_pros_date']);
	$contract_sub_to_pros_date 	= date('Y-m-d', strtotime(str_replace('-', '/', $contract_sub_to_pros_date )));
	
	
	$contract_ret_date 			= mysqli_real_escape_string($link, $_REQUEST['contract_ret_date']);
	$contract_ret_date 	= date('Y-m-d', strtotime(str_replace('-', '/', $contract_ret_date )));
	
	$sec_chk_req_date 			= mysqli_real_escape_string($link, $_REQUEST['sec_chk_req_date']);
	$sec_chk_req_date 	= date('Y-m-d', strtotime(str_replace('-', '/', $sec_chk_req_date )));
	
	$sec_chk_comp_date 			= mysqli_real_escape_string($link, $_REQUEST['sec_chk_comp_date']);
	$sec_chk_comp_date 	= date('Y-m-d', strtotime(str_replace('-', '/', $sec_chk_comp_date )));
	
	$sec_chk_serv_prov_id 		= mysqli_real_escape_string($link, $_REQUEST['sec_chk_serv_prov_id']);
	
	$bnk_grant_recd_date 		= mysqli_real_escape_string($link, $_REQUEST['bnk_grant_recd_date']);
	$bnk_grant_recd_date 	= date('Y-m-d', strtotime(str_replace('-', '/', $bnk_grant_recd_date )));
	
	$bnk_acc_req_date 			= mysqli_real_escape_string($link, $_REQUEST['bnk_acc_req_date']);
	$bnk_acc_req_date 	= date('Y-m-d', strtotime(str_replace('-', '/', $bnk_acc_req_date )));
	
	$bnk_accno 					= mysqli_real_escape_string($link, $_REQUEST['bnk_accno']);
	
	$tech_eval_sub_to_serv_prov_date 	= mysqli_real_escape_string($link, $_REQUEST['tech_eval_sub_to_serv_prov_date']);
	$tech_eval_sub_to_serv_prov_date 	= date('Y-m-d', strtotime(str_replace('-', '/', $tech_eval_sub_to_serv_prov_date )));
	
	$tech_eval_serv_prov_id 			= mysqli_real_escape_string($link, $_REQUEST['tech_eval_serv_prov_id']);
	$tech_eval_result_id 					= mysqli_real_escape_string($link, $_REQUEST['tech_eval_result_id']);
	$tech_eval_note 					= mysqli_real_escape_string($link, $_REQUEST['tech_eval_note']);
	
	$tech_eval_recd_date 				= mysqli_real_escape_string($link, $_REQUEST['tech_eval_recd_date']);
	$tech_eval_recd_date 	= date('Y-m-d', strtotime(str_replace('-', '/', $tech_eval_recd_date )));
	
	$agent_config_date 					= mysqli_real_escape_string($link, $_REQUEST['agent_config_date']);
	$agent_config_date 	= date('Y-m-d', strtotime(str_replace('-', '/', $agent_config_date )));
	
	$terminal_install_date 				= mysqli_real_escape_string($link, $_REQUEST['terminal_install_date']);
	$terminal_install_date 	= date('Y-m-d', strtotime(str_replace('-', '/', $terminal_install_date )));
	
	$mon_openingtime 	= mysqli_real_escape_string($link, $_REQUEST['mon_openingtime']);
	$tue_openingtime	= mysqli_real_escape_string($link, $_REQUEST['tue_openingtime']);			
	$wed_openingtime	=mysqli_real_escape_string($link, $_REQUEST['wed_openingtime']);			
	$thu_openingtime	=mysqli_real_escape_string($link, $_REQUEST['thu_openingtime']);			
	$fri_openingtime	=mysqli_real_escape_string($link, $_REQUEST['fri_openingtime']);			
	$sat_openingtime	=mysqli_real_escape_string($link, $_REQUEST['sat_openingtime']);				
	$sun_openingtime	=mysqli_real_escape_string($link, $_REQUEST['sun_openingtime']);			
	$mon_closingtime	=mysqli_real_escape_string($link, $_REQUEST['mon_closingtime']);	
	$tue_closingtime	=mysqli_real_escape_string($link, $_REQUEST['tue_closingtime']);
	$wed_closingtime	=mysqli_real_escape_string($link, $_REQUEST['wed_closingtime']);			
	$thu_closingtime	=mysqli_real_escape_string($link, $_REQUEST['thu_closingtime']);				
	$fri_closingtime	=mysqli_real_escape_string($link, $_REQUEST['fri_closingtime']);			
	$sat_closingtime	=mysqli_real_escape_string($link, $_REQUEST['sat_closingtime']);		
	$sun_closingtime	=mysqli_real_escape_string($link, $_REQUEST['sun_closingtime']);								
	$status_id			=mysqli_real_escape_string($link, $_REQUEST['status_id']);		
	
	
	$sql = "INSERT INTO prospect_mgmt SET 
				corporate_name 							= '$corporate_name					',
				bus_name 								= '$bus_name						',
				street_addr								= '$street_addr						',
				parish_id								= '$parish_id						',
				city_id									= '$city_id							',
				zipcode_id								= '$zipcode_id						',
				prim_contact_fname 						= '$prim_contact_fname				',
				prim_contact_lname 						= '$prim_contact_lname				',
				sec_contact_fname 						= '$sec_contact_fname				',
				sec_contact_lname 						= '$sec_contact_lname				',
				bus_phone								= '$bus_phone						',
				alt_phone 								= '$alt_phone						',
				faxno									= '$faxno							',
				email 									= '$email							',
				trn				    					= '$trn								',
				home_addr					= '$home_addr',
				owner_parish				= '$owner_parish',
				owner_town					= '$owner_town',
				owner_zipcode				= '$owner_zipcode',
				home_phone					= '$home_phone',
				mobile_phone				= '$mobile_phone',
				
				
				
				
				
				
				application_type_id						= '$application_type_id				',
				multiple_agent							= '$multiple_agent					',
				multiple_terminal						= '$multiple_terminal				',
				bus_anal_bdo							= '$bus_anal_bdo					', 	
				bus_anal_comp_date						= '$bus_anal_comp_date				', 
				bus_anal_note 							= '$bus_anal_note					', 
				bus_anal_result_id 						= '$bus_anal_result_id 				',
				pck_sub_to_pros_date 					= '$pck_sub_to_pros_date			',
				pck_recd_by_pros_date 					= '$pck_recd_by_pros_date			',
				contract_sub_to_pros_date				= '$contract_sub_to_pros_date		',
				contract_ret_date 						= '$contract_ret_date 				',
				sec_chk_serv_prov_id 					= '$sec_chk_serv_prov_id 			',
				sec_chk_req_date 						= '$sec_chk_req_date 				',	
				sec_chk_comp_date 						= '$sec_chk_comp_date 				',	
				bnk_accno 								= '$bnk_accno 						',
				bnk_grant_recd_date 					= '$bnk_grant_recd_date 			',	
				bnk_acc_req_date						= '$bnk_acc_req_date				',	
				tech_eval_sub_to_serv_prov_date 		= '$tech_eval_sub_to_serv_prov_date ',
				tech_eval_recd_date 					= '$tech_eval_recd_date 			',
				tech_eval_note							= '$tech_eval_note					',
				agent_config_date 						= '$agent_config_date 				',
				terminal_install_date					= '$terminal_install_date			',
				csr_officer_id 							= '$csr_officer_id					',
				mon_openingtime 						= '$mon_openingtime	',
				tue_openingtime							='$tue_openingtime	',				
				wed_openingtime							='$wed_openingtime	',				
				thu_openingtime							='$thu_openingtime	',				
				fri_openingtime							='$fri_openingtime	',				
				sat_openingtime							='$sat_openingtime	',				
				sun_openingtime							='$sun_openingtime	',				
				mon_closingtime							='$mon_closingtime	',		
				tue_closingtime							='$tue_closingtime	',
				wed_closingtime							='$wed_closingtime	',				
				thu_closingtime							='$thu_closingtime	',				
				fri_closingtime							='$fri_closingtime	',				
				sat_closingtime							='$sat_closingtime	',			
				sun_closingtime							='$sun_closingtime	',									
				status_id								= '$status_id',
				application_date 						= '$application_date ',
				
				
				
				bdo_officer_id 							= '$bdo_officer_id' ";
			
			if (!mysqli_query($link, $sql))
			{
			$error = 'Error adding applicant to database '. mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
			}
		
	
	setjMessage('Record Add');	
	header('Location: .');
	exit();
	}
	
	
	
	

	if (isset($_REQUEST['action']) and $_REQUEST['action'] == 'Edit' )
	
	{
	
		$id = mysqli_real_escape_string ($link, $_REQUEST['id']);
	
		$sql = "SELECT 	* FROM prospect_mgmt where id = '$id'";
		$result = mysqli_query($link, $sql);
		
	if (!$result)
		{
			$error = 'Error fetching prospect details' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	
		$row = mysqli_fetch_array($result);
		
		$pagetitle = 'Edit';
		$action = 'editform';
		$id 								= $row['id'];
		$corporate_name 					= $row['corporate_name'];
		$bus_name 							= $row['bus_name'];
		$street_addr 						= $row['street_addr'];
		$parish_id 							= $row['parish_id'];
		$city_id 							= $row['city_id'];
		$zipcode_id 						= $row['zipcode_id'];
		$country_id 						= $row['country_id'];
		$prim_contact_fname 				= $row['prim_contact_fname'];
		$prim_contact_lname 				= $row['prim_contact_lname'];
		$sec_contact_fname 					= $row['sec_contact_fname']; 	
		$sec_contact_lname 					= $row['sec_contact_lname'];
		$csr_officer_id 					= $row['csr_officer_id'];
		$bus_phone 							= $row['bus_phone'];
		$alt_phone 							= $row['alt_phone'];
		$faxno								= $row['faxno'];
		$email 								= $row['email'];
		$trn 								= $row['trn'];
		$home_addr							= $row['home_addr'];
		$owner_parish						= $row['owner_parish'];
		$owner_town							= $row['owner_town'];
		$owner_zipcode						= $row['owner_zipcode'];
		$home_phone							= $row['home_phone'];
		$mobile_phone						= $row['mobile_phone'];
		$bus_reg_type_id					= $row['bus_reg_type_id'];	
				
		
		
		
		
		$application_type_id				= $row['application_type_id'];
		$trade_style_id							= $row['trade_style_id'];
		$multiple_agent 					= $row['multiple_agent'];
		$multiple_terminal 					= $row['multiple_terminal'];
		$bdo_officer_id 					= $row['bdo_officer_id'];
		$csr_officer_id 					= $row['csr_officer_id'];
		$bus_anal_bdo 						= $row['bus_anal_bdo'];
	 	$bus_anal_comp_date 				=($row['bus_anal_comp_date'] == '0000-00-00') ? '' : $row['bus_anal_comp_date'];
	 	$bus_anal_result_id					= $row['bus_anal_result_id'];
	 	$bus_anal_note 						= $row['bus_anal_note'];
	 	$pck_sub_to_pros_date 				= ($row['pck_sub_to_pros_date'] == '0000-00-00') ? '' : $row['pck_sub_to_pros_date'];
	 	$pck_recd_by_pros_date 				= $row['pck_recd_by_pros_date'];
	 	$contract_sub_to_pros_date	 		=  ($row['contract_sub_to_pros_date'] == '0000-00-00') ? '' : $row['pck_sub_to_pros_date'];
	 	$contract_ret_date 					= ($row['contract_ret_date']  == '0000-00-00') ? '' : $row['contract_ret_date'];
	 	$sec_chk_req_date 					=  ($row['sec_chk_req_date'] == '0000-00-00') ? '' : $row['sec_chk_req_date'] ;
	 	$sec_chk_comp_date 					= ( $row['sec_chk_comp_date'] == '0000-00-00') ? '' : $row['sec_chk_comp_date'];
	 	$sec_chk_serv_prov_id 				= $row['sec_chk_serv_prov_id'];
	 	$bnk_grant_recd_date 				= ($row['bnk_grant_recd_date'] == '0000-00-00') ? '' : $row['bnk_grant_recd_date'];
	 	$bnk_acc_req_date 					=  ($row['bnk_acc_req_date'] == '0000-00-00') ? '' : $row['bnk_acc_req_date'];
	 	$bnk_accno 							= $row['bnk_accno'];
	 	$tech_eval_sub_to_serv_prov_date 	=  ($row['tech_eval_sub_to_serv_prov_date'] == '0000-00-00') ? '' : $row['tech_eval_sub_to_serv_prov_date'] ;
	 	$tech_eval_serv_prov_id 			= $row['tech_eval_serv_prov_id'];
	 	$tech_eval_result_id				= $row['tech_eval_result_id'];
	 	$tech_eval_note 					= $row['tech_eval_note'] ;
	 	$tech_eval_recd_date 				=  ($row['tech_eval_recd_date'] == '0000-00-00') ? '' : $row['tech_eval_recd_date'];
	 	$agent_config_date 					=  ($row['agent_config_date']== '0000-00-00') ? '' : $row['agent_config_date'];
	 	$terminal_install_date				=  ($row['terminal_install_date'] == '0000-00-00') ? '' : $$row['terminal_install_date'];
		$mon_openingtime 						= $row['mon_openingtime'];
		$tue_openingtime							=$row['tue_openingtime'];				
		$wed_openingtime							=$row['wed_openingtime'];				
		$thu_openingtime							=$row['thu_openingtime'];			
		$fri_openingtime							=$row['fri_openingtime'];				
		$sat_openingtime							=$row['sat_openingtime'];			
		$sun_openingtime							=$row['sun_openingtime'];			
		$mon_closingtime							=$row['mon_closingtime'];	
		$tue_closingtime							=$row['tue_closingtime'];
		$wed_closingtime							=$row['wed_closingtime'];			
		$thu_closingtime							=$row['thu_closingtime'];			
		$fri_closingtime							=$row['fri_closingtime'];			
		$sat_closingtime							=$row['sat_closingtime'];		
		$sun_closingtime							=$row['sun_closingtime'];	
		$application_date 							= ($row['application_date']  == '0000-00-00') ? '' : $row['application_date'];
		$status_id									=$row['status_id'];
		$button ='Update';

		
		
		
	
						//build list of state or parishes for business address
						$sql = "SELECT id, name, status_id FROM parish WHERE status_id = 1 ";
						$result = mysqli_query($link, $sql);
						
						if (!$result)
						{
							$error = 'Error fetching state or parishes '. mysqli_error($link);
							include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
							exit();
						}
						while ($row = mysqli_fetch_array($result))
						{
							$parishes[] = array('id' => $row['id'], 'name' => $row['name'], 
												'status_id' => $row['status_id']);
						}
						
	
	
						//build list of state or parishes for owner address
						$sql = "SELECT * FROM parish WHERE status_id = 1  ";
						$result = mysqli_query($link, $sql);
						if (!$result)
						{
							$error = 'Error fetching state or parishes ';
							include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
							exit();
						}
						
						while ($row = mysqli_fetch_array($result))
						{
							$owner_parishes[] = array('id' => $row['id'], 'name' => $row['name']);
						}
					
						//build list of city or town
						$sql = "SELECT id, name FROM cities WHERE parish_id = $parish_id";
						$result = mysqli_query($link, $sql);
						
						if (!$result)
						{
							$error = 'Error fetching cities or town '. mysqli_error($link);;
							include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
							exit();
						}
						while ($row = mysqli_fetch_array($result))
						{
							$cities[] = array('id' => $row['id'], 'name' => $row['name']);
						}
												
						
						//Build list of cities or town for owner address
						$sql = "SELECT * FROM cities WHERE status_id = 1 AND parish_id = $parish_id ORDER BY name";
						$result = mysqli_query($link, $sql);
						
						if (!$result)
						{
							$error = 'Error fetching cities or town ';
							include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
							exit();
						}
						while ($row = mysqli_fetch_array($result))
						{
							$owner_cities[] = array('id' => $row['id'], 'name' => $row['name']);
						}
					
						
						
						
						
						
						//build list of Post offices/postal codes
						
						$sql = "SELECT id, postal_code, parish_id, post_office, zone FROM postal_codes WHERE parish_id = $parish_id";
						$result = mysqli_query($link, $sql);
						
						if (!$result)
						{
							$error = 'Error fetching postal codes  ' . mysqli_error($link);;
							include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
							exit();
						}
						while ($row = mysqli_fetch_array($result))
						{
							$zipcodes[] = array(	'id' => $row['id'], 
													'postal_code' => $row['postal_code'],
													'parish_id' => $row['parish_id'],
													'post_office' => $row['post_office'],
													'zone' => $row['zone']);
						}	
	
	
						//BUILD LIST OF POSTAL CODE FOR OWNER ADDRESS
					$sql = "SELECT * FROM postal_codes WHERE status_id = 1 AND parish_id = $parish_id ORDER BY post_office";
					$result = mysqli_query($link, $sql);
					
					if (!$result)
					{
						$error = 'Error fetching postal codes  ';
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
					while ($row = mysqli_fetch_array($result))
					{
						$owner_zipcodes[] = array(	'id' => $row['id'], 
												'postal_code' => $row['postal_code'],
												'parish_id' => $row['parish_id'],
												'post_office' => $row['post_office'],
												'zone' => $row['zone']);
					}	
	
	
	
				
	
	//build list of countries
	$sql = "SELECT id, name FROM countries";
	$result = mysqli_query($link, $sql);
	
	if (!$result)
	{
		$error = 'Error fetching list of countries'. mysqli_error($link);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
		exit();
	}
	while ($row = mysqli_fetch_array($result))
	{
		$countries[] = array('id' => $row['id'], 'name' => $row['name']);
	}
	
	
	//Build list of application types
		$sql = "SELECT * FROM application_type";
		$result = mysqli_query($link, $sql) ;
		
		if (!$result)
		{
			$error = 'Error fetching list of application type ' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		while ($row = mysqli_fetch_array($result))
		{
			$application_types[] = array('id' => $row['id'], 'name' => $row['name']);
		}
				
		//build list of bdo officer id
		$sql = "SELECT id, name from bdo_officers";
		$result = mysqli_query($link, $sql);
	
	if (!$result)
		{
			$error = 'error fetch BDOs';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	
	while ($row = mysqli_fetch_array($result))
		{
			$bdo_officers[] = array('id' => $row['id'], 'name' => $row['name']);
		}
	
	
	//build list of csr officer id
		$sql = "SELECT * FROM csr_officers";
		$result = mysqli_query($link, $sql);
	
	if (!$result)
		{
			$error = 'error fetch BDOs';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	
	while ($row = mysqli_fetch_array($result))
		{
			$csr_officers[] = array('id' => $row['id'], 'name' => $row['name']);
		}
	
	
	//Build the list of business registration types
		$sql = "SELECT * FROM bus_reg_type WHERE status_id = 1 ";
		$result = mysqli_query($link, $sql);
		if (!$result)
		{
			$error = 'Error fetching list of business registration types' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	
		while ($row = mysqli_fetch_array($result))
		{
			$bus_reg_types[]= array('id' => $row['id'], 'name' => $row['name'], 'status_id' => $row['status_id']);
		}
	
	
	
					//Build the list of business trade styles
							$sql = "SELECT * FROM trade_style WHERE status_id = 1 ";
							$result = mysqli_query($link, $sql);
							if (!$result)
							{
								$error = 'Error fetching list of business trade style' . mysqli_error($link);
								include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
								exit();
							}
						
							while ($row = mysqli_fetch_array($result))
							{
								$trade_styles[]= array('id' => $row['id'], 'name' => $row['name']);
							}
	
	
	
	
	
	//Build the list of technical evaluation service provider
		$sql = "SELECT * FROM tech_eval_serv_providers ORDER BY name";
		$result = mysqli_query($link, $sql);
		
		if (!$result)
		{
			$error = 'Error fetching list of technical evaluation service providers' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		while ($row = mysqli_fetch_array($result))
		{
			$tech_eval_serv_providers[] = array('id' => $row['id'], 'name' => $row['name']);
		}
	
	//Build the list of security check service providers
		$sql = "SELECT * FROM security_chk_serv_providers ORDER BY name";
		$result = mysqli_query($link, $sql);
		
		if (!$result)
		{
			$error = 'Error fetching list of security check service provider' . mysqli_error($link);
			setjMessage($error);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		while ($row = mysqli_fetch_array($result))
		{
			$sec_chk_serv_providers[] = array('id' => $row['id'], 'name' => $row['name']);
		}
	
	
	//Build the list of business analysis result
		$sql = "SELECT * FROM bus_anal_result";
		$result = mysqli_query($link, $sql);
		
		if (!$result)
		{
			$error = 'Error fetching list of business analysis results'. mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		while ($row = mysqli_fetch_array($result))
		{
			$bus_anal_results[] = array('id' => $row['id'], 'name' => $row['name']);
		}
	
	
	
			//Build the list of technical evaluation results
			$sql = "SELECT * FROM tech_eval_result WHERE status_id = 1 ";
			$result = mysqli_query($link, $sql);
			if (!$result)
			{
				$error = 'Error fetching list of business trade style' . mysqli_error($link);
				include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
				exit();
			}
		
			while ($row = mysqli_fetch_array($result))
			{
				$tech_eval_results[]= array('id' => $row['id'], 'name' => $row['name']);
			}
			
				
	
	
	
	
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
	

	if(isset($_GET['editform']))
	{
	
	$id = mysqli_real_escape_string ($link, $_REQUEST['id']);
	$corporate_name = mysqli_real_escape_string($link, $_REQUEST['corporate_name']);
	$bus_name = mysqli_real_escape_string($link, $_REQUEST['bus_name']);
	$street_addr = mysqli_real_escape_string($link, $_REQUEST['street_addr']);
	
	
	$parish_id = mysqli_real_escape_string($link, $_REQUEST['parish_id']);
	$city_id =  mysqli_real_escape_string($link, $_REQUEST['city_id']);
	$zipcode_id = mysqli_real_escape_string($link, $_REQUEST['zipcode_id']);
	$country_id = mysqli_real_escape_string($link, $_REQUEST['country_id']);
	$prim_contact_fname = mysqli_real_escape_string($link, $_REQUEST['prim_contact_fname']);
	$prim_contact_lname = mysqli_real_escape_string($link, $_REQUEST['prim_contact_lname']);
	$sec_contact_fname = mysqli_real_escape_string($link, $_REQUEST['sec_contact_fname']);	
	$sec_contact_lname = mysqli_real_escape_string($link, $_REQUEST['sec_contact_lname']);
	$bus_phone = mysqli_real_escape_string($link, $_REQUEST['bus_phone']);
	$alt_phone = mysqli_real_escape_string($link, $_REQUEST['alt_phone']);
	$faxno = mysqli_real_escape_string($link, $_REQUEST['faxno']);
	$email = mysqli_real_escape_string($link, $_REQUEST['email']);
	$trn = mysqli_real_escape_string($link, $_REQUEST['trn']);
	$bus_reg_type_id = mysqli_real_escape_string($link, $_REQUEST['bus_reg_type_id']);
	$home_addr							= mysqli_real_escape_string($link, $_REQUEST['home_addr']);
	$owner_parish						= mysqli_real_escape_string($link, $_REQUEST['owner_parish']);
	$owner_town							= mysqli_real_escape_string($link, $_REQUEST['owner_town']);
	$owner_zipcode						= mysqli_real_escape_string($link, $_REQUEST['owner_zipcode']);
	$home_phone							= mysqli_real_escape_string($link, $_REQUEST['home_phone']);
	$mobile_phone						= mysqli_real_escape_string($link, $_REQUEST['mobile_phone']);
				
	
	
	
	
	
	
	$application_type_id =  mysqli_real_escape_string($link, $_REQUEST['application_type_id']);
	
	$trade_style_id	=  mysqli_real_escape_string($link, $_REQUEST['trade_style_id']);
	
	
	
			if(isset($_REQUEST['multiple_agent'])){ 
		$multiple_agent 	=   1;
	
		}else {$multiple_agent=0;}
		
			if(isset($_REQUEST['multiple_terminal'])){ 
		$multiple_terminal 	=   1;
	
		}else {$multiple_terminal=0;}
		
	$bus_anal_bdo 						= mysqli_real_escape_string($link, $_REQUEST['bus_anal_bdo']);
	
	$bus_anal_comp_date 				= mysqli_real_escape_string($link, $_REQUEST['bus_anal_comp_date']);
	$bus_anal_result_id					= mysqli_real_escape_string($link, $_REQUEST['bus_anal_result_id']);
	$bus_anal_note 						= mysqli_real_escape_string($link, $_REQUEST['bus_anal_note']);
	$pck_sub_to_pros_date 				= mysqli_real_escape_string($link, $_REQUEST['pck_sub_to_pros_date']);
	$pck_recd_by_pros_date 				= mysqli_real_escape_string($link, $_REQUEST['pck_recd_by_pros_date']);
	$contract_sub_to_pros_date	 		= mysqli_real_escape_string($link, $_REQUEST['contract_sub_to_pros_date']);
	$contract_ret_date 					= mysqli_real_escape_string($link, $_REQUEST['contract_ret_date']);
	$sec_chk_req_date 					= mysqli_real_escape_string($link, $_REQUEST['sec_chk_req_date']);
	$sec_chk_comp_date 					= mysqli_real_escape_string($link, $_REQUEST['sec_chk_comp_date']);
	$sec_chk_serv_prov_id 				= mysqli_real_escape_string($link, $_REQUEST['sec_chk_serv_prov_id']);
	$bnk_grant_recd_date 				= mysqli_real_escape_string($link, $_REQUEST['bnk_grant_recd_date']);
	$bnk_acc_req_date 					= mysqli_real_escape_string($link, $_REQUEST['bnk_acc_req_date']);
	$bnk_accno 							= mysqli_real_escape_string($link, $_REQUEST['bnk_accno']);
	$tech_eval_sub_to_serv_prov_date 	= mysqli_real_escape_string($link, $_REQUEST['tech_eval_sub_to_serv_prov_date']);
	$tech_eval_serv_prov_id 			= mysqli_real_escape_string($link, $_REQUEST['tech_eval_serv_prov_id']);
	$tech_eval_result_id 				= mysqli_real_escape_string($link, $_REQUEST['tech_eval_result_id']);
	$tech_eval_note 					= mysqli_real_escape_string($link, $_REQUEST['tech_eval_note']);
	$tech_eval_recd_date 				= mysqli_real_escape_string($link, $_REQUEST['tech_eval_recd_date']);
	$agent_config_date 					= mysqli_real_escape_string($link, $_REQUEST['agent_config_date']);
	$terminal_install_date				= mysqli_real_escape_string($link, $_REQUEST['terminal_install_date']);
	$terminal_install_date				= date('Y-m-d',strtotime($terminal_install_date	 	));
	$csr_officer_id 					= mysqli_real_escape_string($link, $_REQUEST['csr_officer_id']);
	$bdo_officer_id 					= mysqli_real_escape_string($link, $_REQUEST['bdo_officer_id']);
	$status_id							= mysqli_real_escape_string($link, $_REQUEST['status_id']);
	
	$mon_openingtime 		= mysqli_real_escape_string($link, $_REQUEST['mon_openingtime']);
	$tue_openingtime		= mysqli_real_escape_string($link, $_REQUEST['tue_openingtime']);				
	$wed_openingtime		= mysqli_real_escape_string($link, $_REQUEST['wed_openingtime']);				
	$thu_openingtime		= mysqli_real_escape_string($link, $_REQUEST['thu_openingtime']);			
	$fri_openingtime		= mysqli_real_escape_string($link, $_REQUEST['fri_openingtime']);				
	$sat_openingtime		= mysqli_real_escape_string($link, $_REQUEST['sat_openingtime']);			
	$sun_openingtime		= mysqli_real_escape_string($link, $_REQUEST['sun_openingtime']);			
	$mon_closingtime		= mysqli_real_escape_string($link, $_REQUEST['mon_closingtime']);	
	$tue_closingtime		= mysqli_real_escape_string($link, $_REQUEST['tue_closingtime']);
	$wed_closingtime		= mysqli_real_escape_string($link, $_REQUEST['wed_closingtime']);			
	$thu_closingtime		= mysqli_real_escape_string($link, $_REQUEST['thu_closingtime']);			
	$fri_closingtime		= mysqli_real_escape_string($link, $_REQUEST['fri_closingtime']);			
	$sat_closingtime		= mysqli_real_escape_string($link, $_REQUEST['sat_closingtime']);		
	$sun_closingtime		= mysqli_real_escape_string($link, $_REQUEST['sun_closingtime']);	
	$application_date =		mysqli_real_escape_string($link, $_REQUEST['application_date']);	
	
	
	
	
			
	$sql = "UPDATE prospect_mgmt SET
			corporate_name 		= '$corporate_name		',
			bus_name 			= '$bus_name			',
			street_addr			= '$street_addr			',
			parish_id			= '$parish_id			',
			city_id 			= '$city_id				',
			zipcode_id 			= '$zipcode_id			',
			country_id 			= '$country_id			',
			prim_contact_fname	= '$prim_contact_fname	',
			prim_contact_lname 	= '$prim_contact_lname	',
			sec_contact_fname	= '$sec_contact_fname	', 	
			sec_contact_lname	= '$sec_contact_lname	',
			bus_phone			= '$bus_phone			',
			alt_phone			= '$alt_phone			',
			faxno				= '$faxno				',
			email				= '$email				',
			trn					= '$trn					',
			home_addr			= '$home_addr',
			owner_parish		= '$owner_parish',
			owner_town			= '$owner_town',
			owner_zipcode		= '$owner_zipcode',
			home_phone			= '$home_phone',
			mobile_phone		= '$mobile_phone',
			bus_reg_type_id		= '$bus_reg_type_id',	
				
			multiple_agent		= '$multiple_agent					',
			multiple_terminal	= '$multiple_terminal					',
			application_type_id	= '$application_type_id					',
			trade_style_id		= '$trade_style_id',
			bus_anal_bdo 					= '$bus_anal_bdo					',
			bus_anal_result_id					= '$bus_anal_result_id					',
			bus_anal_note 					= '$bus_anal_note',
			bus_anal_comp_date 				= '$bus_anal_comp_date 				',		
			pck_sub_to_pros_date			= '$pck_sub_to_pros_date			',
			contract_sub_to_pros_date		= '$contract_sub_to_pros_date		',
			contract_ret_date 				= '$contract_ret_date 				',
			sec_chk_req_date 				= '$sec_chk_req_date 				',	
			sec_chk_comp_date 				= '$sec_chk_comp_date 				',	
			sec_chk_serv_prov_id			= '$sec_chk_serv_prov_id			',
			bnk_accno 						= '$bnk_accno 						',
			bnk_grant_recd_date 			= '$bnk_grant_recd_date 			',	
			bnk_acc_req_date				= '$bnk_acc_req_date				',
			tech_eval_serv_prov_id 			= '$tech_eval_serv_prov_id 			',
			tech_eval_sub_to_serv_prov_date = '$tech_eval_sub_to_serv_prov_date ',
			tech_eval_recd_date 			= '$tech_eval_recd_date 			',
			tech_eval_result_id				= '$tech_eval_result_id',
			tech_eval_note 					= '$tech_eval_note 					',
			agent_config_date 				= '$agent_config_date 				',
			terminal_install_date			= '$terminal_install_date			',
			csr_officer_id 					= '$csr_officer_id					',
			status_id						= '$status_id',
			mon_openingtime 	= '$mon_openingtime',
			tue_openingtime		= '$tue_openingtime',			
			wed_openingtime		= '$wed_openingtime',			
			thu_openingtime		= '$thu_openingtime',			
			fri_openingtime		= '$fri_openingtime',			
			sat_openingtime		= '$sat_openingtime',			
			sun_openingtime		= '$sun_openingtime',			
			mon_closingtime		= '$mon_closingtime',	
			tue_closingtime		= '$tue_closingtime',
			wed_closingtime		= '$wed_closingtime',			
			thu_closingtime		= '$thu_closingtime',			
			fri_closingtime		= '$fri_closingtime',			
			sat_closingtime		= '$sat_closingtime',	
			sun_closingtime		= '$sun_closingtime',
			application_date	= '$application_date',
			
			bdo_officer_id 					= '$bdo_officer_id					'
			WHERE id = '$id' ";
			
			
		if (!mysqli_query($link, $sql))
		{
			$error = 'Error updating applicant details '. mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		
		
	
			
	
		
	setjMessage('Record Updated');
	header('Location: .');
	exit();
	
	}
	
	if (isset($_REQUEST['action']) and $_REQUEST['action'] == 'Checklist' )
	
	{
	
		$id = mysqli_real_escape_string ($link, $_REQUEST['id']);
	
		$sql = "SELECT 	* FROM prospect_mgmt where id = '$id'";
		$result = mysqli_query($link, $sql);
		
	if (!$result)
		{
			$error = 'Error fetching prospect details';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	
		$row = mysqli_fetch_array($result);
		
		$pagetitle = 'Checklist';
		$action = '';
		$id 								= $row['id'];
		$corporate_name 					= $row['corporate_name'];
		$bus_name 							= $row['bus_name'];
		$street_addr 						= $row['street_addr'];
		$parish_id 							= $row['parish_id'];
		$city_id 							= $row['city_id'];
		$zipcode_id 						= $row['zipcode_id'];
		$country_id 						= $row['country_id'];
		$prim_contact_fname 				= $row['prim_contact_fname'];
		$prim_contact_lname 				= $row['prim_contact_lname'];
		$sec_contact_fname 					= $row['sec_contact_fname']; 	
		$sec_contact_lname 					= $row['sec_contact_lname'];
		$csr_officer_id 					= $row['csr_officer_id'];
		$bus_phone 							= $row['bus_phone'];
		$alt_phone 							= $row['alt_phone'];
		$email 								= $row['email'];
		$trn 								= $row['trn'];
		$multiple_agent 					= $row['multiple_agent'];
		$bdo_officer_id 					= $row['bdo_officer_id'];
		$bus_anal_bdo 						= $row['bus_anal_bdo'];
	 	$bus_anal_comp_date 				= $row['bus_anal_comp_date'];
	 	$bus_anal_result_id					= $row['bus_anal_result_id'];
	 	$bus_anal_note 						= $row['bus_anal_note'];
	 	$pck_sub_to_pros_date 				= $row['pck_sub_to_pros_date'];
	 	$pck_recd_by_pros_date 				= $row['pck_recd_by_pros_date'];
	 	$contract_sub_to_pros_date	 		= $row['contract_sub_to_pros_date'];
	 	$contract_ret_date 					= $row['contract_ret_date'];
	 	$sec_chk_req_date 					= $row['sec_chk_req_date'];
	 	$sec_chk_comp_date 					= $row['sec_chk_comp_date'];
	 	$sec_chk_serv_prov_id 				= $row['sec_chk_serv_prov_id'];
	 	$bnk_grant_recd_date 				= $row['bnk_grant_recd_date'];
	 	$bnk_acc_req_date 					= $row['bnk_acc_req_date'];
	 	$bnk_accno 							= $row['bnk_accno'];
	 	$tech_eval_sub_to_serv_prov_date 	= $row['tech_eval_sub_to_serv_prov_date'];
	 	$tech_eval_serv_prov_id 			= $row['tech_eval_serv_prov_id'];
	 	$tech_eval_result_id 				= $row['tech_eval_result_id'];
	 	$tech_eval_note 					= $row['tech_eval_note'];
	 	$tech_eval_recd_date 				= $row['tech_eval_recd_date'];
	 	$agent_config_date 					= $row['agent_config_date'];
	 	$terminal_install_date				= $row['terminal_install_date'];
		
		
					
		
		
			
		
		
		// DB TABLE Exporter
    //
    // How to use:
    //
    // Place this file in a safe place, edit the info just below here
    // browse to the file, enjoy!
     
    // CHANGE THIS STUFF FOR WHAT YOU NEED TO DO
     
    $dbhost = "127.0.0.1:3306";
    $dbuser = "root";
    $dbpass = "Welcome1";
    $dbname = "svl";
    $dbtable = "prospect_mgmt";
     
    // END CHANGING STUFF
     
     
    // first thing that we are going to do is make some functions for writing out
    // and excel file. These functions do some hex writing and to be honest I got
    // them from some where else but hey it works so I am not going to question it
    // just reuse
     
     
    // This one makes the beginning of the xls file
    function xlsBOF() {
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
    return;
    }
     
    // This one makes the end of the xls file
    function xlsEOF() {
    echo pack("ss", 0x0A, 0x00);
    return;
    }
     
    // this will write text in the cell you specify
    function xlsWriteLabel($Row, $Col, $Value ) {
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
    return;
    }
     
     
     
    // make the connection an DB query
    $dbc = mysql_connect( $dbhost , $dbuser , $dbpass ) or die( mysql_error() );
    mysql_select_db( $dbname );
    #$q = "SELECT * FROM ".$dbtable."";
	$q = "SELECT prospect_mgmt.tech_eval_sub_to_serv_prov_date as Date, prospect_mgmt.prim_contact_fname , prospect_mgmt.prim_contact_lname,
	prospect_mgmt.bus_name, prospect_mgmt.street_addr AS ' Street Address', cities.name, parish.name, 
	prospect_mgmt.bus_phone, prospect_mgmt.alt_phone
			FROM (prospect_mgmt INNER JOIN parish ON prospect_mgmt.parish_id = parish.id) 
			INNER JOIN cities ON prospect_mgmt.city_id = cities.id;
";
	
    $qr = mysql_query( $q ) or die( mysql_error() );
     
     
    // Ok now we are going to send some headers so that this
    // thing that we are going make comes out of browser
    // as an xls file.
    //
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
     
    //this line is important its makes the file name
    header("Content-Disposition: attachment;filename=export_".$dbtable.".xls ");
     
    header("Content-Transfer-Encoding: binary ");
     
    // start the file
    xlsBOF();
     
    // these will be used for keeping things in order.
    $col = 0;
    $row = 0;
     
    // This tells us that we are on the first row
    $first = true;
     
    while( $qrow = mysql_fetch_assoc( $qr ) )
    {
    // Ok we are on the first row
    // lets make some headers of sorts
    if( $first )
    {
    foreach( $qrow as $k => $v )
    {
    // take the key and make label
    // make it uppper case and replace _ with ' '
    xlsWriteLabel( $row, $col, strtoupper( ereg_replace( "_" , " " , $k ) ) );
    $col++;
    }
     
    // prepare for the first real data row
    $col = 0;
    $row++;
    $first = false;
    }
     
    // go through the data
    foreach( $qrow as $k => $v )
    {
    // write it out
    xlsWriteLabel( $row, $col, $v );
    $col++;
    }
    // reset col and goto next row
    $col = 0;
    $row++;
    }
     
    xlsEOF();
    exit();
		
		
		
		
		
		

	include 'checklist.html.php';
	exit();
	}
	
	if (isset($_REQUEST['action']) and $_REQUEST['action'] == 'Delete')
	{
	$id = mysqli_real_escape_string($link, $_REQUEST['id']);
	
	
		
	//Delete prospect information
	$sql = "DELETE FROM prospect_mgmt WHERE id = '$id'";
	
	if (!mysqli_query($link, $sql))
		{
			$error = 'Error applicant details(s)';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	
	header('Location: .');
	exit();
	
	
	
	}
	
	
	//Display search form 
	
	$result = mysqli_query($link, 'SELECT id, bus_name FROM prospect_mgmt');
	
	
	//Build list of business name
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
	
	
	$result = mysqli_query($link, 'SELECT id, prim_contact_fname FROM prospect_mgmt WHERE prim_contact_fname IS NOT NULL');
	
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
	
	//Build the list of service provider
		$sql = "SELECT * FROM tech_eval_serv_providers ORDER BY name";
		$result = mysqli_query($link, $sql);
		
		if (!$result)
		{
			$error = 'Error fetching list of technical evaluation service providers' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		while ($row = mysqli_fetch_array($result))
		{
			$tech_eval_serv_providers[] = array('id' => $row['id'], 'name' => $row['name']);
		}
	
	
	
	
		
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/searchform.html.php';

	
	
	if(isset($_REQUEST['action']) and $_REQUEST['action'] == 'search')
	{
	//the basic SELECT statement
	
	$select = 'SELECT 	prospect_mgmt.id, 
						bus_name, 
						agentno,
						prim_contact_fname, 
						prim_contact_lname, 
						street_addr, 
						parish.name,
						prospect_mgmt.parish_id,
						bus_phone,
						cities.name,
						prospect_mgmt.tech_eval_serv_prov_id,
						prospect_mgmt.status_id,
						city_id ';
						
	$from = ' FROM prospect_mgmt 	INNER JOIN parish ON prospect_mgmt.parish_id = parish.id
									INNER JOIN cities ON prospect_mgmt.city_id = cities.id
									INNER JOIN statustype ON prospect_mgmt.status_id = statustype.id 
									INNER JOIN tech_eval_serv_providers ON 
									prospect_mgmt.tech_eval_serv_prov_id  = tech_eval_serv_providers.id
												';
	
		
	$where = ' WHERE TRUE ';
	
	
	
	
					// User has selected business name 
					$bus_name = mysqli_real_escape_string($link, $_GET['bus_name']);
					
					if ($bus_name != '')  
					{
						$where .= " AND prospect_mgmt.id  = '$bus_name' ";
					}
					
					// User has selected agent number 
					$agentno = mysqli_real_escape_string($link, $_GET['agentno']);
					if ($agentno != '')  // agent number is selected 
					{
						$where .= " AND prospect_mgmt.id  = '$agentno' ";
					}
					
					// User has entered contact first name
					$prim_contact_fname = mysqli_real_escape_string($link, $_GET['prim_contact_fname']);
					if ($prim_contact_fname != '')  // a primary contact first name is selected 
					{
						$where .= " AND prospect_mgmt.id  = '$prim_contact_fname' ";
					}
			

					// User has entered contact street address			
					$street_addr = mysqli_real_escape_string($link, $_GET['street_addr']);
					if ($street_addr != '' ) // street address entered  
					{
						$where .= " AND street_addr LIKE  '%$street_addr%' ";
					}
	
					
	
					// User has selected status 
					$status_id = mysqli_real_escape_string($link, $_GET['status_id']);
					if ($status_id != '')   
					{
						$where .= " AND statustype.id   = '$status_id' ";
					}
	
					
					// User has selected service provider 
					$tech_eval_serv_prov_id = mysqli_real_escape_string($link, $_GET['tech_eval_serv_prov_id']);
					if ($tech_eval_serv_prov_id != '')   
					{
						$where .= " AND tech_eval_serv_providers.id   = '$tech_eval_serv_prov_id' ";
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
					$prospects[] = array('id' => $row['id'], 
						'bus_name' 					=> $row['bus_name'], 
						'street_addr' 				=> $row['street_addr'],
						'prim_contact_fname' 		=> $row['prim_contact_fname'], 
						'prim_contact_lname' 		=> $row['prim_contact_lname'], 
						'parish_id' 				=> $row['parish_id'],
						'parish.name' 				=> $row['name'],
						'bus_phone' 				=> $row['bus_phone'],
						'cities.name' 				=> $row['name'],
						'city_id' 					=> $row['city_id']
						);
				}
		}
			include 'prospect.html.php';
			exit();
	
	
			
	
	?>