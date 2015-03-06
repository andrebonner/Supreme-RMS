<?php

include_once 	$_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
include 		$_SERVER['DOCUMENT_ROOT'] . '/includes/svl_db.inc.php';
require_once 	$_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
require_once 	$_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';

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

	
	$tech_eval_serv_prov_id = '';
	
	
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'search' )
	
	{
	
	$start_date 				= mysqli_real_escape_string($link,$_REQUEST['start_date']);
	$end_date 					= mysqli_real_escape_string($link,$_REQUEST['end_date']);
	$tech_eval_serv_prov_id 	= mysqli_real_escape_string($link,$_REQUEST['tech_eval_serv_prov_id']);
	
	
				//Select the service provider name for report label
					$sql = "SELECT id, name AS Service_Provider FROM tech_eval_serv_providers 
					WHERE id = $tech_eval_serv_prov_id";
					
					$result = mysqli_query($link, $sql);
					
					if (!$result)
					{
						$error = 'Error fetching list of technical evaluation service providers' . mysqli_error($link);
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
					
					$row = mysqli_fetch_array($result);
					
					$Service_Provider = $row['Service_Provider'];
					
					
				
	
		
				
				// This is the count of applications received for the selected date period
						$sql = "SELECT Count(prospect_mgmt.application_date) as No_of_Apps
						FROM prospect_mgmt WHERE application_date BETWEEN '$start_date' AND '$end_date' AND 
						tech_eval_serv_prov_id = '$tech_eval_serv_prov_id ' ";
					
					$result = mysqli_query($link, $sql);
					
				if (!$result)
					{
						$error = 'Error fetching the number of applications received for the period' . mysqli_error($link);
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
				
					$row = mysqli_fetch_array($result);
					
					$No_of_Apps = $row['No_of_Apps'];
					
	
					// This is count businiess analysis complete for selected date period
							$sql = "SELECT Count(prospect_mgmt.bus_anal_comp_date) as No_Bus_Anal_Comp
							FROM prospect_mgmt WHERE bus_anal_comp_date BETWEEN '$start_date' AND '$end_date'
							AND 
							tech_eval_serv_prov_id = '$tech_eval_serv_prov_id ' ";
														
					$result = mysqli_query($link, $sql);
						
					if (!$result)
						{
							$error = 'Error fetching the number of business assessment completed for the period' . mysqli_error($link);
							include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
							exit();
						}
					
						$row = mysqli_fetch_array($result);
						
						$No_Bus_Anal_Comp = $row['No_Bus_Anal_Comp'];
						
		
			
				// This is count application package submitted for selected date period		
						$sql = "SELECT 	Count(prospect_mgmt.pck_sub_to_pros_date) AS No_App_Pck_Submitted
						FROM prospect_mgmt WHERE pck_sub_to_pros_date BETWEEN '$start_date' AND '$end_date'
						AND 
						tech_eval_serv_prov_id = '$tech_eval_serv_prov_id ' ";
				
					$result = mysqli_query($link, $sql);
					
				if (!$result)
					{
						$error = 'Error fetching the number of application package submitted for the selected period' . mysqli_error($link);
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
				
					$row = mysqli_fetch_array($result);
					$No_App_Pck_Submitted = $row['No_App_Pck_Submitted'];
		
				// This is a count of bank guarantee received from applicant for selected date period		
						$sql = "SELECT 	Count(prospect_mgmt.bnk_grant_recd_date) AS No_Bank_Fee_Recd
						FROM prospect_mgmt WHERE bnk_grant_recd_date BETWEEN '$start_date' AND '$end_date'
						AND 
						tech_eval_serv_prov_id = '$tech_eval_serv_prov_id ' ";
				
					$result = mysqli_query($link, $sql);
					
				if (!$result)
					{
						$error = 'Error fetching the count of bank guarantee for the selected period' . mysqli_error($link);
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
				
					$row = mysqli_fetch_array($result);
					$No_Bank_Fee_Recd = $row['No_Bank_Fee_Recd'];
					
		
					// This is a count of bank account requested for selected date period		
						$sql = "SELECT 	Count(prospect_mgmt.bnk_acc_req_date) AS No_Bnk_Acc_Req
						FROM prospect_mgmt WHERE bnk_acc_req_date BETWEEN '$start_date' AND '$end_date'
						AND tech_eval_serv_prov_id = '$tech_eval_serv_prov_id ' ";
				
					$result = mysqli_query($link, $sql);
					
					if (!$result)
					{
						$error = 'Error fetching the count of bank guarantee requested for the selected period' . mysqli_error($link);
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
				
					$row = mysqli_fetch_array($result);
					$No_Bnk_Acc_Req = $row['No_Bnk_Acc_Req'];
					
					
					// This is a count of bank account received for selected date period		
						$sql = "SELECT 	Count(prospect_mgmt.bnk_accno) AS No_Bnk_Acc_Recd
						FROM prospect_mgmt WHERE bnk_acc_req_date BETWEEN '$start_date' AND '$end_date'
						AND tech_eval_serv_prov_id = '$tech_eval_serv_prov_id ' ";
				
					$result = mysqli_query($link, $sql);
					
					if (!$result)
					{
						$error = 'Error fetching the count of bank guarantee requested for the selected period' . mysqli_error($link);
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
				
					$row = mysqli_fetch_array($result);
					$No_Bnk_Acc_Recd = $row['No_Bnk_Acc_Recd'];
		
				// This is a count of security checks requested		
						$sql = "SELECT 	Count(prospect_mgmt.sec_chk_req_date) AS No_BackGrndChk_Req
						FROM prospect_mgmt WHERE sec_chk_req_date BETWEEN '$start_date' AND '$end_date'
						AND tech_eval_serv_prov_id = '$tech_eval_serv_prov_id ' ";
				
					$result = mysqli_query($link, $sql);
					
					if (!$result)
					{
						$error = 'Error fetching the count of bank guarantee requested for the selected period' . mysqli_error($link);
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
				
					$row = mysqli_fetch_array($result);
					$No_BackGrndChk_Req = $row['No_BackGrndChk_Req'];
		
			
			// This is a count of security checks completed		
						$sql = "SELECT 	Count(prospect_mgmt.sec_chk_comp_date) AS No_BackGrndChk_Comp
						FROM prospect_mgmt WHERE sec_chk_comp_date BETWEEN '$start_date' AND '$end_date'
						AND tech_eval_serv_prov_id = '$tech_eval_serv_prov_id ' ";
				
					$result = mysqli_query($link, $sql);
					
					if (!$result)
					{
						$error = 'Error fetching the count of security check completed' . mysqli_error($link);
						include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
						exit();
					}
				
					$row = mysqli_fetch_array($result);
					$No_BackGrndChk_Comp = $row['No_BackGrndChk_Comp'];
		
		
		
	
		
		include  'performance_report.html.php';
		}
		
		
		
		
		
		else{
		
		
		//Build the list of technical evaluation service provider
		$sql = "SELECT * FROM tech_eval_serv_providers WHERE status_id = 1";
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
		
	
		include 'search_criteria.html.php';
		
		
		
		}
		
	
	
	
	
	
	
	
	
	
	?>