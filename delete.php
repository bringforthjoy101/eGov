<?php
require_once('config/db.php');
$id = $_GET['id'];
$DelSql = "DELETE FROM projects WHERE id=$id";
$res = mysqli_query($conn, $DelSql);
if($res){
	header('location: projects.php');
}else{
	echo "Failed to delete";
}
?>