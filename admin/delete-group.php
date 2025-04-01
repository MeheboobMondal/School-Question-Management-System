<?php 
include '../connection.php';
$id = intval($_GET['id']);
$sql = "DELETE FROM exam_group WHERE id=$id";
$result = mysqli_query($DBCON, $sql);
if($result){
    header("Location: add-group.php");
}
?>