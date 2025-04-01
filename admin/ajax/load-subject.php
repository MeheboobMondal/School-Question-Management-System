<?php
include '../../connection.php';
$className = $_GET['cn'];
$classid = 0;
session_start();


$sql1 = "SELECT class_id FROM class_mas WHERE class_num = '$className'";
$result1 = mysqli_query($DBCON, $sql1);
while($row = mysqli_fetch_array($result1)){
    $classid = $row['class_id'];
    $_SESSION['classid'] = $classid;
    $sql = "SELECT degree_nm FROM subject_mas WHERE class_id = '$classid'";

$result = mysqli_query($DBCON, $sql);
?>
<label for="subjectName" class="block text-sm font-medium text-gray-700">Subject Name</label>
<select id="subjectName" name="subjectName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required onchange="teacherload(this.value)">
    <option value="">Select Subject</option>


    <?php
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <option value="<?php echo $row['degree_nm']?>"><?php echo $row['degree_nm']?></option>

    <?php

    }
}

