<?php 
session_start();
include '../../connection.php';
$subjectName = $_GET['sn'];
  $classid = $_SESSION['classid'];
  
  $sql5 = "SELECT degree_id FROM subject_mas WHERE degree_nm= '$subjectName' AND class_id = '$classid'";
  $subjectId = 0;
  $result5 = mysqli_query($DBCON, $sql5);
  while ($row = mysqli_fetch_array($result5)) {
    $_SESSION['subjectid'] = $row['degree_id'];
  }
?>