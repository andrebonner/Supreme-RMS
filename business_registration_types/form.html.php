<?php include_once $_SERVER['DOCUMENT_ROOT'] .
		'/includes/helpers.inc.php'; require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';	
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
	include $_SERVER['DOCUMENT_ROOT'].'/svl/ca_menu.html.php';

}


if (userHasRole('Site Administrator'))
{
	include $_SERVER['DOCUMENT_ROOT'].'/svl/sa_menu.html.php';

}
?>
</div>
<div id="col2">		
		<h2><?php htmlout($pagetitle); ?></h2>
		<form action="?<?php htmlout($action); ?>" method="post" onSubmit="return verify(this)">
			<div>
				<label for="name">Name: 
				
				
				<input type="text" name="name"
						id="name" style="width: 250px" value="<?php htmlout(Trim($name)); ?>"/> 
						
						
						</label>
						
				
			
			<label for="status">Status <select name = "status_id" id = "status_id" >
          <option value =""> Select one </option>
          <?php foreach ($statuses as $status): ?>
          <option value = "<?php htmlout($status['id']); ?>" 
		
			<?php 
 		
			if ($status['id'] == $status_id)
		echo ' selected= "selected"'; ?> >
          <?php htmlout($status['status']); ?>
          </option>
          <?php endforeach; ?>
        </select> </label>
		
		
		
			</div>
			
						
			
			
			<div>
				<input type="hidden" name="id" value="<?php
						htmlout($id); ?>"/>
				<input type="submit" value="<?php htmlout($button); ?>"/>
			</div>
		</form>
		</div>
		
		
		
		<script language="JavaScript">
	  
		function verify(form)
		{
		
		
			if(form.name.value == "")
				{
					alert("Please enter an registration type.");
					form.name.focus();
						return false;
				}
	 
			if(form.status_id.value == "")
				{
					alert("Please select Status ID.");
					form.status_id.focus();
						return false;
				}
	 
	 
	 
			}

	</script>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>