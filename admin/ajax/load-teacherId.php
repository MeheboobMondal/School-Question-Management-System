<?php
include '../../connection.php'; 
session_start();

$name = $_GET['tn'];

$sql = "SELECT hr_id FROM emp_mas WHERE emp_nm = '$name'";
$result = mysqli_query($DBCON, $sql);
if($row = mysqli_fetch_array($result)){
    $_SESSION['hr_id'] = $row['hr_id'];
    echo  $row['hr_id'];
}else{
    echo "No teacher id found!!!";
}