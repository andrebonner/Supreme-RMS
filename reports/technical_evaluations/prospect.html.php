<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
?>


	<?php if (isset($relocations)): ?>

		<h2> Search Results </h2>
	<table border = 1>
	<tr> 
	
	<th><a href="?action=search&sort=bus_name"> Business Name </a></th>
	<th> <a href="?action=search&sort=street_addr">Address </a></th>
	<th> <a href="?action=search&sort=parish">Parish </a></th>
	<th> <a href="?action=search&sort=parish">Contact </a></th>
	<th> <a href="?action=search&sort=parish">Phone </a></th>
	<th><a href="?action=search&sort=bus_name"> Relocation type </a></th>
		<th><a href="?action=search&sort=bus_name"> Relocation date </a></th>
	<th> Options </th> </tr>
	
	<?php foreach ($relocations as $relocation): ?>
	
	<tr valign = "top">
	<div>
	
	
	
	<td>  
		<a href ="?action=Edit&id= <?php htmlout($relocation['id']); ?> "> 
				<?php htmlout($relocation['agentno']); ?></a> 
	
	</td>
	</div>
	
	<td> <a href ="?action=Edit&id= <?php htmlout($relocation['id']); ?> "><?php htmlout($relocation['bus_name']); ?></a> </td>
	
	<td> <a href ="?action=Edit&id= <?php htmlout($relocation['id']); ?> "><?php htmlout($relocation['street_addr']); ?></a> </td>
	

	
	
	
	
	
	<td>  
		<a href ="?action=Edit&id= <?php htmlout($relocation['id']); ?> "> 
				<?php htmlout($relocation['relocation_type']); ?></a> 
	
	</td>
	
	<td>  
		<a href ="?action=Edit&id= <?php htmlout($relocation['id']); ?> "> 
				<?php htmlout($relocation['relocation_date']); ?></a> 
	
	</td>
	
	
	
	<td>
	<form action ="?" method ="post">
	<div>
	<input type = "hidden" name = "id" value = "<?php htmlout($relocation['id']); ?> "/>
	<!--<input type = "submit" name = "action" value = "Edit" /> -->
	<input type = "submit" name = "action" value = "Delete" />
	<input type = "submit" name = "action" value = "Checklist" />
	</div>
	</form>
	</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</td>
	</tr>
	
		
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.inc.html.php'; ?>
	
		