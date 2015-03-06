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
		

<table cellspacing = 2 cellpadding = 2 border = 1>

<tr>
		<form action = "" method = "get">
		
		<td colspan = "2" align = "center"> Performance Report for <strong> <?php htmlout($Service_Provider); ?> </strong>
		
		
		</td>
		<tr>
		<td colspan = "2" align = "center"> <?php 
			date_default_timezone_set('America/Bogota');
		echo date('F j, Y, g:i a', time());?> </td>
		</tr>
		
		<tr> <td colspan = "2" align = "center"> Activity for the period <?php echo date('M, j Y',strtotime($start_date));?> to <?php echo date('M, j Y',strtotime($end_date));?> </td>
		</tr>

<tr>

 <td align = "center"><strong>Activities</strong></td>
 <td align = "center"><strong>Count</strong></td>

</tr>


<tr>

	<div>
		<td> Applications Received </td>
		  <td><input type="text" name="start_date" id="start_date"  STYLE="width: 200px; text-align:center;"  value="<?php htmlout($No_of_Apps); ?>"/></td>
	</div>
		
</tr>
           <tr>
              <td>Business Analysis</td>
              <td><input type="text" name="bus_anal_comp_date" id="bus_anal_comp_date" 
			  STYLE="width: 200px; text-align:center;"  value="<?php htmlout($No_Bus_Anal_Comp); ?>"/></td>
            </tr>


<tr>
		<div>
		<td> Application Package Submitted </td>
		  <td><input type="text" name="start_date" id="start_date" style="width: 200px;  text-align:center;"
		  value="<?php htmlout($No_App_Pck_Submitted); ?>"/></td>
		</div>
</tr>



<tr>
		<div>
		<td> Banking Guarantee Fee Received </td>
		  <td><input type="text" name="start_date" id="start_date" style="width: 200px; text-align:center;"
		  value="<?php htmlout($No_Bank_Fee_Recd); ?>"/> </td>
		  
		  
		  
		</div>
</tr>

<tr>
		<div>
		<td> Bank Account Requested </td>
		  <td><input type="text" name="start_date" id="start_date" style="width: 200px; text-align:center;"
		  value="<?php htmlout($No_Bnk_Acc_Req); ?>"/> </td>
		</div>
</tr>
<tr>
		<div>
		<td> Bank Account Received </td>
		  <td><input type="text" name="start_date" id="start_date" style="width: 200px"/></td>
		
		</div>
</tr>



<tr>
		<div>
		<td> Security - Checks Requested  </td>
		  <td><input type="text" name="start_date" id="start_date" style="width: 200px; text-align:center;"
		  value="<?php htmlout($No_BackGrndChk_Req); ?>"/> </td>
		  
		  
		   
		</div>
</tr>

<tr>
		<div>
		<td> Security - Checks Completed </td>
		  <td><input type="text" name="start_date" id="start_date" style="width: 200px; text-align:center;"
		  value="<?php htmlout($No_BackGrndChk_Comp); ?>"/> </td>
				
	
		</div>
</tr>


<tr>
		<div>
		<td> Technical Evaluations - Requested  </td>
		  <td><input type="text" name="start_date" id="start_date" style="width: 200px"/></td>
		  
		</div>
</tr>

<tr>
		<div>
		<td> Technical Evaluations - Completed </td>
		  <td><input type="text" name="start_date" id="start_date" style="width: 200px"/></td>
		
		</div>
</tr>


<tr>
		<div>
		<td> Technical Evaluations - Documentations Received </td>
		  <td><input type="text" name="start_date" id="start_date" style="width: 200px"/></td>
		
		</div>
</tr>


<tr>
		<div>
		<td> Agent Configuration Completed </td>
		  <td><input type="text" name="start_date" id="start_date" style="width: 200px"/></td>
		
		</div>
</tr>


<tr>
		<div>
		<td> Installations Completed </td>
		  <td><input type="text" name="start_date" id="start_date" style="width: 200px"/></td>
		
		</div>
</tr>






</tr></form>
</table>


		
		</div>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>