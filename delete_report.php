<?php
require_once('config/db.php');
$id = $_GET['rep_id'];
$DelSql = "DELETE FROM reports WHERE rep_id=$id";
$res = mysqli_query($conn, $DelSql);
if($res){
	header('location: reports.php');
}else{
	echo "Failed to delete";
}
?>