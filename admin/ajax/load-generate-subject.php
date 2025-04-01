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
    ?>
    <label for="subjectName" class="block text-sm font-medium text-gray-700">Subject Name</label>
          <select id="subjectName" name="subjectName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required onchange="getSubjectId(this.value)">

            <option value="">Select Subject</option>
            <?php
            
            $sql1 = "SELECT DISTINCT
                     question_mas.class_id,
                     question_mas.subject_id,
                     class_mas.class_num,
                     subject_mas.degree_nm,
                    qdm.status
                FROM 
                    question_division_mas qdm
                INNER JOIN question_mas ON qdm.qpm_id = question_mas.qpm_id
                INNER JOIN class_mas ON class_mas.class_id = question_mas.class_id
                INNER JOIN subject_mas ON subject_mas.degree_id = question_mas.subject_id
                WHERE 
                    qdm.qpm_id IN (
                SELECT qpm_id
                FROM question_division_mas
                GROUP BY qpm_id
                HAVING COUNT(*) = SUM(status = 'completed')
    )
AND 
    qdm.status = 'completed'
    AND question_mas.class_id = '$classid'";

            $result1 = mysqli_query($DBCON, $sql1);
            while ($row = mysqli_fetch_array($result1)) {
             
             ?>
               
               <option value="<?php echo $row['degree_nm'] ?>"><?php echo $row['degree_nm'] ?></option>
 
             <?php
             }
             ?>
          </select>
          <?php
}
?>