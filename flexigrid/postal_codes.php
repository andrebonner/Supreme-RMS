<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
// connect to mysql database

mysql_connect('localhost', 'root', 'usbw');
mysql_select_db('svl');

$page = 1; // the current page
$sortname = 'id'; // sort column
$sortorder = 'asc'; // sort order
$qtype = ''; // search column
$query = ''; // search string
$rp=10;
// get posted data
if(isset($_POST['page'])){
	$page = mysql_real_escape_string($_POST['page']);
}
if(isset($_POST['sortname'])){
	$sortname = mysql_real_escape_string($_POST['sortname']);
}
if(isset($_POST['sortorder'])){
	$sortorder = mysql_real_escape_string($_POST['sortorder']);
}
if(isset($_POST['qtype'])){
	$qtype = mysql_real_escape_string($_POST['qtype']);
}
if(isset($_POST['query'])){
	$query = mysql_real_escape_string($_POST['query']);
}
if(isset($_POST['rp'])){
	$rp = mysql_real_escape_string($_POST['rp']);
}

// setup sort and search SQL using posted data
$sortSql = "order by $sortname $sortorder";
$searchSql = ($qtype != '' && $query != '') ? "where $qtype = '$query'" : '';
//get total count of records
$sql = "select count(*) 
from postal_codes
$searchSql";
$result = mysql_query($sql);
//echo $sql;
$row = mysql_fetch_array($result);
$total = $row[0];
// Setup paging SQL
$pageStart = ($page-1)*$rp;
$limitSql = "limit $pageStart, $rp";
// Return JSON data
$data['page'] = $page;
$data['total'] = $total;
$data['rows'] = array();
$sql = "select id, postal_code, parish_id, post_office, zone
from postal_codes
$searchSql
$sortSql
$limitSql";
$results = mysql_query($sql);
//echo $sql;
while($row = mysql_fetch_assoc($results)){
	$data['rows'][] = array(
	'id' =>$row['id'],
	'cell'=>array('id' =>$row['id'],'postal_code' =>$row['postal_code'],'parish_id' =>$row['parish_id'],'post_office' =>$row['post_office'],'zone' =>$row['zone'])
	);
}

echo json_encode($data);
?>