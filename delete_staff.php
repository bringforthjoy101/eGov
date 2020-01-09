<?php
require_once('config/db.php');
$id = $_GET['u_id'];
$DelSql = "DELETE FROM reports WHERE u_id=$id";
$res = mysqli_query($conn, $DelSql);
if($res){
	header('location: staffs.php');
}else{
	echo "Failed to delete";
}
?>