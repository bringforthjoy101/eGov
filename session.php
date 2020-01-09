<?php
   include('config/db.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conn,"select * from users where email = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $user_id = $row['uid'];
   $login_email = $row['email'];
   $username = $row['username'];
   $full_name = $row['full_name'];
   $avatar = $row['avatar'];
   $role_id = $row['role_id'];
   $ministry_id = $row['u_ministry_id'];
   $department_id = $row['u_department_id'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>