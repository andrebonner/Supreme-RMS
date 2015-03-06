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

// Connect to MySQL database
mysql_connect('localhost', 'root', 'Welcome1');
mysql_select_db('svl');
$page = 1; // The current page
$sortname = 'id'; // Sort column
$sortorder = 'asc'; // Sort order
$qtype = ''; // Search column
$query = ''; // Search string
// Get posted data
if (isset($_POST['page'])) {
$page = mysql_real_escape_string($_POST['page']);
}
if (isset($_POST['sortname'])) {
$sortname = mysql_real_escape_string($_POST['sortname']);
}
if (isset($_POST['sortorder'])) {
$sortorder = mysql_real_escape_string($_POST['sortorder']);
}
if (isset($_POST['qtype'])) {
$qtype = mysql_real_escape_string($_POST['qtype']);
}
if (isset($_POST['query'])) {
$query = mysql_real_escape_string($_POST['query']);
}
if (isset($_POST['rp'])) {
$rp = mysql_real_escape_string($_POST['rp']);
}
// Setup sort and search SQL using posted data
$sortSql = "order by $sortname $sortorder";
$searchSql = ($qtype != '' && $query != '') ? "where $qtype = '$query'" : '';
// Get total count of records
$sql = "select count(*)
from cities
$searchSql";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$total = $row[0];
// Setup paging SQL
$rp= 10;
$pageStart = ($page-1)*$rp;
$limitSql = "limit $pageStart, $rp";
// Return JSON data
$data = array();
$data['page'] = $page;
$data['total'] = $total;
$data['rows'] = array();
$sql = "select id, name, parish_id, status_id
from cities
$searchSql
$sortSql
$limitSql";
$results = mysql_query($sql);
while ($row = mysql_fetch_assoc($results)) {
$data['rows'][] = array(
'id' => $row['id'],
'cell' => array($row['id'], $row['name'], $row['parish_id'], $row['status_id'])
);
}
echo json_encode($data);

	
		
	
	
	?>