<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';	
?>

	<div id="header">
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php'; ?>
			<h1> SVL Customer Service Management System </h1>
		</div>
		<div id="mainwrapper">
		<div id="col1">
		
	
	<?php 
	if (userHasRole('Content Administrator'))
{
	include '../ca_menu.html.php';

}


if (userHasRole('Site Administrator'))
{
	include '../sa_menu.html.php';

}
?>
	
	</div>
	<div id="col2">		
		
		
	<table class="searchTable">

	
	

	<form id="form1" name="form1" method="post" action="">

    <tr>
      <td> <strong>Prospect Checklist</strong></td>
    </tr>
    <tr>
      <td></td>
         <td>Completed</td>
      <td>Date Completed</td>
    </tr>
    <tr>
      <td ><strong>Application</strong></td>
     
    </tr>
    <tr>
       <td>Received applicant requested for terminal</td>
      <td align="center"><input type="checkbox" name="checkbox" id="checkbox" /></td>
      <td><input type="text" name="textfield2" id="textfield2" /></td>
    </tr>
    
    <tr>
      <td><strong>Business Analysis</strong></td>
   
      </tr>
    <tr>
      <td> Business analysis complete</td>
	       <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2"
<?php 
	if(isset($bus_anal_comp_date)){
		echo 'checked = "checked"';
	}
?>

	  /></td>
      <td><input type="text" name="bus_anal_comp_date" id="bus_anal_comp_date" value="<?php htmlout($bus_anal_comp_date); ?>" /></td>
    </tr>
	   
    <tr>
      <td><strong>Application Package</strong></td>
     
      
    </tr>
     <tr>
      <td> Application package sent to applicant</td>
      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2"

	  
	  
	  <?php 
	if(isset($pck_sub_to_pros_date)){
		echo 'checked = "checked"';
	}
?>

	  /></td>
      <td><input type="text" name="pck_sub_to_pros_date" id="pck_sub_to_pros_date" value="<?php htmlout($pck_sub_to_pros_date); ?>" /></td>
    </tr>
	
    <tr>
     
      <td>Application package received by applicant</td>
	  
	 
      <td align="center"><input type="checkbox" name="chkbx_pck_recd_by_pros_date" id="chkbx_pck_recd_by_pros_date"
		<?php 
		if(isset($pck_recd_by_pros_date)){
		echo 'checked = "checked"';
		}
		?>



	  /></td>
      <td><input type="text" name="textfield4" id="textfield4" value="<?php htmlout($pck_recd_by_pros_date); ?>" /></td>
    </tr>
  
    <tr>
      <td><strong>Security Check</strong></td>
      
    </tr>
    <tr>
      
      <td>Security checked requested</td>
      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3"
		<?php 
		if(isset($sec_chk_req_date)){
		echo 'checked = "checked"';
		}
		?>

	  /></td>
      <td><input type="text" name="sec_chk_req_date" id="sec_chk_req_date" value="<?php htmlout($sec_chk_req_date); ?>" /></td>
    </tr>
    <tr>
     
      <td>Security check completed</td>
      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4"
		<?php 
		if(isset($sec_chk_comp_date)){
		echo 'checked = "checked"';
		}
		?>


	  /></td>
      <td><input type="text" name="sec_chk_comp_date" id="sec_chk_comp_date" value="<?php htmlout($sec_chk_comp_date); ?>" /></td>
    </tr>
    <tr>
     
    </tr>
    <tr>
      <td><strong>Contract</strong></td>
      
    </tr>
    <tr>
  
      <td>Contract sent to prospect</td>
      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3"
		<?php 
		if(isset($contract_sub_to_pros_date)){
		echo 'checked = "checked"';
		}
		?>


	  /></td>
      <td><input type="text" name="contract_sub_to_pros_date" id="contract_sub_to_pros_date" value="<?php htmlout($contract_sub_to_pros_date); ?>" /></td>
    </tr>
    <tr>
    
      <td>Contract signed and returned</td>
      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4"
	<?php 
		if(isset($contract_ret_date)){
		echo 'checked = "checked"';
		}
		?>


	  /></td>
      <td><input type="text" name="contract_ret_date" id="contract_ret_date" value="<?php htmlout($contract_ret_date); ?>"  /></td>
    </tr>
    <tr>
     
    </tr>
    <tr>
      <td><strong>Banking</strong></td>
      
    </tr>
    <tr>
     
      <td>Received applicant's bank guarantee </td>
      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" 
	  <?php 
		if(isset($bnk_grant_recd_date)){
		echo 'checked = "checked"';
		}
		?>

	  
	  /></td>
      <td><input type="text" name="bnk_grant_recd_date" id="bnk_grant_recd_date" value="<?php htmlout($bnk_grant_recd_date); ?>"/></td>
    </tr>

  <tr>
  
      <td>Requested Applicant's bank account number </td>
      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4"
	<?php 
		if(isset($bnk_acc_req_date)){
		echo 'checked = "checked"';
		}
		?>
		
	  /></td>
      <td><input type="text" name="bnk_acc_req_date" id="bnk_acc_req_date" value="<?php htmlout($bnk_acc_req_date); ?>"/></td>
    </tr>
    <tr>
	
   <tr>
  
      <td>Received Agent bank account number</td>
      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
      <td><input type="text" name="textfield4" id="textfield4" /></td>
    </tr>
    <tr>
     
    </tr>
    <tr>
      <td><strong>Service Provider</strong></td>
     
    </tr>
    <tr>
      
      <td>Transferred to service provider for evaluation</td>
      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3"
		<?php 
		if(isset($tech_eval_sub_to_serv_prov_date)){
		echo 'checked = "checked"';
		}
		?>

	  /></td>
      <td><input type="text" name="tech_eval_sub_to_serv_prov_date" id="tech_eval_sub_to_serv_prov_date" value="<?php htmlout($tech_eval_sub_to_serv_prov_date); ?>" /></td>
    </tr>
    <tr>
      
      <td>Received evaluation documentation from service provicer</td>
      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4"
		<?php 
		if(isset($tech_eval_recd_date)){
		echo 'checked = "checked"';
		}
		?>


	  /></td>
      <td><input type="text" name="	tech_eval_recd_date" id="tech_eval_recd_date" value="<?php htmlout($tech_eval_recd_date); ?>" /></td>
    </tr>
    <tr>
      
    </tr>
    <tr>
      <td><strong>Terminal Installation</strong></td>
     
    </tr>
    <tr>
   
      <td>Agent configured</td>
      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" 
	  <?php 
		if(isset($agent_config_date)){
		echo 'checked = "checked"';
		}
		?>
	  
	  /></td>
      <td><input type="text" name="agent_config_date" id="agent_config_date" value="<?php htmlout($agent_config_date); ?>" /></td>
    </tr>
    <tr>

      <td>Terminal installed</td>
      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4"
	  <?php 
		if(isset($terminal_install_date)){
		echo 'checked = "checked"';
		}
		?>
	  


	  /></td>
      <td><input type="text" name="terminal_install_date" id="terminal_install_date" value="<?php htmlout($terminal_install_date); ?>"/></td>
    </tr>
    <tr>
    
    </tr>
  </table>
</form>
</div>


</tr>

	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>

