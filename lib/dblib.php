<?php
include_once("DBmanager.php");
$db = new DBmanager();
	

function countRecords($table,$where,$debug=0){
	global $db;
	$query = "select COUNT(*) as TOTAL from ".$table." where ".$where;
	if ($debug==1)
		echo $query;
	$result = $db->execute($query);
    return $result[0]['TOTAL'];
}

function getRecord($field='*',$table,$where,$debug=0){
	global $db;
	$query = "select ".$field." from ".$table." where ".$where;
	if ($debug==1)
		echo $query;
	$result = $db->execute($query);
	return $result[0][$field];
}
function getRecords($field='*',$table,$where,$debug=0){
	global $db;
	$query = "select ".$field." from ".$table." where ".$where;
	if ($debug==1)
		echo $query;
	$result = $db->execute($query);
	return $result;
}	
	
?>














