<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';	
?>

	<div id="header">
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/logout.inc.html.php'; ?>
			
	</div>
	<div id="mainwrapper">
	<div id="col1">
	
	
	
	
	
	
	<?php 
	if (userHasRole('Content Administrator'))
{
	include $_SERVER['DOCUMENT_ROOT'].'/svl/ca_menu.html.php';

}


if (userHasRole('Site Administrator'))
{
	include $_SERVER['DOCUMENT_ROOT'].'/svl/sa_menu.html.php';

}
?>
</div>
<div id="col2">		
		


<tr>
		
		<form action = "" method = "get" onSubmit="return verify(this);">
						
		<td colspan = "2" align = "center"> Select Date Range </td>
		
	</tr>	



<tr>
		<div>
		<td> Start Date </td>
		  <td><input type="text" name="start_date" id="start_date" title = "Start Date" onBlur="checkdate(this)" size="11" maxlength="11" style="width: 200px"/></td>
		</div>
</tr>


<tr>
		<div>
		<td> End Date </td>
		  <td><input type="text" name="end_date" id="end_date" title = "End Date" onBlur="checkdate(this)" size="11" maxlength="11" style="width: 200px"/></td>
		</div>
</tr>



<tr>


<td>Service Provider</td>
						<td><select name = "tech_eval_serv_prov_id" id = "tech_eval_serv_prov_id"
						STYLE="width: 200px" >
						<option value ="0"> Select Provider </option>
						<?php foreach ($tech_eval_serv_providers as $tech_eval_serv_provider): ?>
						<option value = "<?php htmlout($tech_eval_serv_provider['id']); ?>" 
						
						<?php 
				
						if ($tech_eval_serv_provider['id'] == $tech_eval_serv_prov_id)
						echo ' selected= "selected"'; ?> >
						<?php htmlout($tech_eval_serv_provider['name']); ?>
						</option>
						<?php endforeach; ?>
						</select></td>
</tr>
		<tr>
		<td colspan="3">
		<div>
		<input type = "hidden" name = "action" value = "search"/>
		<input type = "submit" value = "Search" />
		</div>
		</td>
		</tr>

		</table>


		</form>
		
		 
		

<script>

	jQuery(function($){
				
		$('#start_date').datepicker({ dateFormat: 'yy-mm-dd'});
		$('#end_date').datepicker({ dateFormat: 'yy-mm-dd'});
		
				
    });
</script>
	  
				
		
		
		
		
	
		 <script language="JavaScript">
	  
		function verify(form)
		{
		
		
			if((form.tech_eval_serv_prov_id.value == "") || (form.tech_eval_serv_prov_id.value == "0" ))
				{
					alert("Please select service provider.");
					form.tech_eval_serv_prov_id.focus();
						return false;
				}
	 
		}

		
						
						
		
		
	</script>
	
	
	
	
	
	
		</div>