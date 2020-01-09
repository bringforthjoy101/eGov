<?php
require_once('config/db.php');
$id = $_GET['id'];
$DelSql = "UPDATE projects SET resolve = 'YES' WHERE id=$id";
$res = mysqli_query($conn, $DelSql);
if($res){
	header('location: assignments.php');
}else{
	echo "Failed to delete";
}
?>