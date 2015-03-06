
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="js/flexigrid.pack.js"></script>


<title>FlexiGrid</title>
<link rel="stylesheet" type="text/css" href="css/flexigrid.pack.css"/>

</head>

<body>
<table class="flexme">
<thead>
<tr>
	<th width=100>Col 1</th>
	<th width=100>Col 2</th>
	<th width=300>Col 3</th>
</tr>
</thead>
<tbody>

<tr>
	<td>Data 1</td>
	<td>Data 2</td>
	<td>Data 3</td>
</tr>
<tr>
	<td>Data 1</td>
	<td>Data 2</td>
	<td>Data 3</td>
</tr>
</table>
<br />
<table id="flex1" >
</table><script language="javascript" src="js/postal_grid.js"></script>
<script language="javascript" >
	$('.flexme').flexigrid({height: 200, width: 500, striped: false});

	$("#flex1").flexigrid({
	url: 'postal_codes.php',
	dataType: 'json',
	colModel: [
	{ display: 'ID', name : 'id', width : 40, sortable : true, align: 'left'},
	{ display: 'Postal Code', name : 'postal_code', width : 140, sortable : true, align: 'left'},
	{ display: 'Parish ID', name : 'parish_id', width : 140, sortable : true, align: 'left'},
	{ display: 'Post Office', name : 'post_office', width : 240, sortable : true, align: 'left'},
	{ display: 'Zone', name : 'zone', width : 40, sortable : true, align: 'left'}		
	],
	buttons: [
	{ name: 'Edit', bclass: 'edit', onpress: doCommand},
	{ name: 'Delete', bclass: 'delete', onpress: doCommand},
	{ separator: true}
	],
	searchitems : [
	{ display: 'ID', name:'id'},
	{ display: 'Postal Code', name:'postal_code', isdefault: true}
	],
	sortname: "id",
	sortorder: "asc",
	usepager: true,
	title: "Postal Codes",
	useRp: true,
	rp: 10,
	showTableToggleBtn: false,
	resizable: false,
	width: 680,
	height: 270,
	singleSelect: true
});

</script>

</body>
</html>
