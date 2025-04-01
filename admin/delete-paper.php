<?php 
include '../connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM question_mas WHERE qpm_id = '$id'";
$result = mysqli_query($DBCON, $sql);
if($result){
    ?>
    <script>
        alert("Question Deleted Successfully!!")
        window.location = "set-paper.php"
    </script>
    <?php

    
}else{
    echo "Error Deleting Question";
}