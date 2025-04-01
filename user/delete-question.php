<?php 
include '../connection.php';
include './header.php';
include './sidebar.php';
$id = $_GET['id'];
$sql = "SELECT qs_id, qpm_id FROM question_details WHERE qt_id = '$id'";
$result = mysqli_query($DBCON, $sql);
$question = '';
$qpm_id = '';
$qs_id = '';
while ($row = mysqli_fetch_array($result)) {
    $question = $row['qs_detials'];
    $qpm_id = $row['qpm_id'];
    $qs_id = $row['qs_id'];
}

    $sql1 = "DELETE FROM question_details WHERE qt_id = '$id'";
    $result1 = mysqli_query($DBCON, $sql1);
    if($result1){
        ?>
        <script>
            // alert('Question updated successfully');
            window.location = "create-question.php?qpm=<?php echo $qpm_id?>&qs_id=<?php echo $qs_id?>"
        </script>
        <?php
    }

?>