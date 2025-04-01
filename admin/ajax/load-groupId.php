<?php 
include '../../connection.php';
session_start();
$groupName = $_GET['gn'];
echo $groupName;
$sql = "SELECT id FROM exam_group WHERE group_name = '$groupName'";
$result = mysqli_query($DBCON, $sql);
if($row = mysqli_fetch_array($result)){
    $_SESSION['grp_id'] = $row['id'];
}else{
    echo "Invalid group name.";
    exit;
 
}