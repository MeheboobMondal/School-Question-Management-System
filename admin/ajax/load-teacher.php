<?php 
include '../../connection.php';
session_start();
$className = $_GET['cn'];
$subjectName = $_GET['sub'];
$sessionId = $_SESSION['session_id'];
$sql = "SELECT emp_mas.emp_nm, subject_mas.degree_id
        FROM emp_mas 
        INNER JOIN teacher_subject ON emp_mas.hr_id = teacher_subject.teacher_hr_id 
        INNER JOIN class_mas ON class_mas.class_id = teacher_subject.class_id 
        INNER JOIN subject_mas ON subject_mas.degree_id = teacher_subject.degree_id
        WHERE teacher_subject.session_id = '$sessionId' 
        AND class_mas.class_num = '$className'
        AND subject_mas.degree_nm = '$subjectName'";
        

$result = mysqli_query($DBCON, $sql);

?>
<select id="teacherId" name="section" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required onchange="loadteacherId(this.value)">
<option value="">Select teacher</option>
<?php 
    while($row = mysqli_fetch_array($result)){
        ?>
           
            <option value="<?php echo $row['emp_nm']?>"><?php echo $row['emp_nm']?></option>
          
           
        <?php
        $_SESSION['subjectid'] = $row['degree_id'];

    }
?>

            
          </select>