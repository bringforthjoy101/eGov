<?php
//Include database configuration file
include_once('config/dbase.php');


if(isset($_POST["ministry_id"]) && !empty($_POST["ministry_id"])){
    //Get all local_govt data
    $query = $db->query("SELECT * FROM departments WHERE ministry_id = ".$_POST['ministry_id']." ORDER BY id ASC");
    print_r($query);
    //Count total number of rows
    $rowCount = $query->num_rows;
    //echo "$rowCount";
    
    //Display local govt list
    if($rowCount > 0){
        echo '<option value="">Select Department</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['id'].'">'.$row['department'].'</option>';
        }
    }else{
        echo '<option value="">Department not available</option>';
    }
}

?>