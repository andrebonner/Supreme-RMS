<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';
?>








<table class="layout" >
	<tr>
		<td colspan="2" height="20%">
		<h1> SVL Customer Service Management System </h1>
		
			
		</td>
	</tr>
	<tr>
	<td valign="top" width="20%">
	
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
	</td>
	<td width="80%">
<form action ="?<?php htmlout($action); ?>" method = "post" onSubmit="return verify(this)">
  
  
  <h2> SVL  <?php htmlout ($pagetitle); ?>    </h2>
  <div class="tabber">

<div >
  <table width="100%" border="0">
   
    <tr>
	
	
	<div>
	<td>	<label for = "agentno"> Agent no: </label> </td>
	<td>	<select name = "agentno" id = "agentno" STYLE="width: 200px">
		<option value =""> Any agent </option>
		<?php foreach ($agentnumbers as $agentno): ?>
		<option value ="<?php htmlout($agentno['agentno']); ?> "> 
		<?php htmlout($agentno['agentno']); ?>
		</option>
		<?php endforeach; ?>
		</select> </td>
		</div>
		
     
	</tr>
	
	<tr>
	
	
	<div>
		<td> <label for = "relocation_type"> Type of Relocation </label></td>
		<td> <select name = "relocation_type" id = "relocation_type" STYLE="width: 200px">
		<option value =""> Any type </option>
		<?php foreach ($relocation_types as $relocation_type): ?>
		<option value ="<?php htmlout($relocation_type['id']); ?> "> 
		<?php htmlout($relocation_type['name']); ?>
		</option>
		<?php endforeach; ?>
		</select> </td>
		</div>
		
     
	</tr>
	
	
	
    <tr>
	
    	<td><label for = "relocation_date"> Relocation date</label> </td>
	<td><input type="text" name="relocation_date" id="relocation_date" STYLE="width: 200px" value="<?php htmlout($relocation_date); ?>"/></td>
     
</tr>
    
     <tr>
	
    	<td><label for = "relocate_to"> Relocation To</label></td>
	<td>	<textarea name = "relocate_to" id = "relocate_to" cols="40" rows="2"value="<?php htmlout($relocate_to); ?>" ></textarea> </td>
	<!--<td><input type="text" name="relocate_to" id="relocate_to" value="<?php htmlout($relocate_to); ?>"/></td> -->
    
</tr>

<tr>
	
    	<td><label for = "sub_to_serv_prov_date"> Date sent to service provider</label> </td>
	<td><input type="text" name="sub_to_serv_prov_date" id="sub_to_serv_prov_date" STYLE="width: 200px" value="<?php htmlout($relocation_date); ?>"/></td>
     
</tr>

    <tr>
	
    	<td><label for = "completion_date"> Completion date</label> </td>
	<td><input type="text" name="completion_date" id="completion_date" STYLE="width: 200px" value="<?php htmlout($completion_date); ?>"/></td>
     
</tr>
    
	
	
	  <tr>
	
    	<td><label for = "note"> Note</label></td>
	<td>	<textarea name = "note" id = "note" cols="40" rows="2"value="<?php htmlout($note); ?>" ></textarea> </td>

    
</tr>

	</table>
	</div>

	

  

 <div>
    <input type = "hidden" name = "id" value = "<?php htmlout($id); ?>" />
    <input type = "submit" value = "<?php htmlout($button); ?>" />
  </div>
</form>

	
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>
	
		