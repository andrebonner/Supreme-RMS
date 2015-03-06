<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
?>


	<?php if (isset($prospects)): ?>

		
		<link rel="stylesheet" type="text/css" href="../flexigrid/css/flexigrid.pack.css"/>
	<table  id="prospect_table">
	</table>
	<table border = 1 >
	<tr> <h2> Search Results </h2> </tr>
	<tr> <th> Business Name </th>
	<th> Address </th>
	<th> Parish </th>
	<th> Contact </th>
	<th> Phone </a></th>
	<th> Options </th> </tr>
	
	<?php foreach ($prospects as $prospect): ?>
	
	<tr valign = "top">
	<div>
	<td>  
		<a href ="?action=Edit&id= <?php htmlout($prospect['id']); ?> "> 
				<?php htmlout($prospect['bus_name']); ?></a> 
	
	</td>
	</div>
	<td> <a href ="?action=Edit&id= <?php htmlout($prospect['id']); ?> "><?php htmlout($prospect['street_addr']); ?></a> </td>
	
	<td> <a href ="?action=Edit&id= <?php htmlout($prospect['id']); ?> "><?php htmlout($prospect['parish.name']); ?></a> </td>
	
	<td> <a href ="?action=Edit&id= <?php htmlout($prospect['id']); ?> "><?php htmlout($prospect['prim_contact_fname'] . $prospect['prim_contact_lname']); ?></a> </td>
	
	
	
	<td> <a href ="?action=Edit&id= <?php htmlout($prospect['id']); ?> "><?php htmlout($prospect['bus_phone']); ?></a> </td>
	
	<td>
	<form action ="?" method ="post">
	<div>
	<input type = "hidden" name = "id" value = "<?php htmlout($prospect['id']); ?> "/>
	<!--<input type = "submit" name = "action" value = "Edit" />-->
	<!--<input type = "submit" name = "action" value = "Delete" /> -->
	<input type = "submit" name = "action" value = "Checklist" />
	</div>
	</form>
	</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
	<script language="javascript" src="../flexigrid/js/jquery.js"></script>
<script language="javascript" src="../flexigrid/js/flexigrid.pack.js"></script>

	<script language="javascript" >

	$("#prospect_table").flexigrid({
	url: 'index.php?ajax=1&grid=prospect_mgmt&<?php echo $_SERVER['QUERY_STRING'];?>',
	dataType: 'json',
	colModel: [
	{ display: 'ID', name : 'id', width : 40, sortable : true, align: 'left'},
	{ display: 'Business Name', name : 'bus_name', width : 120, sortable : true, align: 'left'},
	{ display: 'Business Address', name : 'street_addr', width : 140, sortable : true, align: 'left'},
	{ display: 'Parish', name : 'parish.name', width : 120, sortable : true, align: 'left'},
	{ display: 'Contact', name : 'prim_contact_fname', width : 80, sortable : true, align: 'left'},		
	{ display: 'Phone', name : 'bus_phone', width : 80, sortable : true, align: 'left'}		
	],
	buttons: [
	{ name: 'Edit', bclass: 'edit', onpress: doCommand},
	//{ name: 'Delete', bclass: 'delete', onpress: doCommand},
	{ separator: true}
	],
	searchitems : [
	{ display: 'ID', name:'id'},
	{ display: 'Business Name', name:'bus_name', isdefault: true}
	],
	sortname: "id",
	sortorder: "asc",
	usepager: true,
	title: "Postal Codes",
	useRp: true,
	rp: 10,
	showTableToggleBtn: false,
	resizable: false,
	width: 780,
	height: 170,
	singleSelect: true
});
function doCommand(com, grid) {
	if(com == 'Edit'){
		$('.trSelected', grid).each(function(){
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+(3));
			alert("Edit row " + id);
		})
	}
	if(com == 'Delete'){
		$('.trSelected', grid).each(function(){
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+(3));
			alert("Delete row " + id);
		})
	}
}
</script>

	</td>
	</tr>
	
		