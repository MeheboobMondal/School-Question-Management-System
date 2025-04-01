<?php 
include '../../connection.php';
$className = $_GET['cn'];
$sql = "SELECT section_mas.section FROM class_mas INNER JOIN section_mas ON class_mas.class_id = section_mas.class_id WHERE class_mas.class_num = '$className'";
$result = mysqli_query($DBCON, $sql);
?>
<label for="section" class="block text-sm font-medium text-gray-700">Section</label>
          <select id="section" name="section" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
          <option value="">Select Section</option>
            <?php 
            while($row = mysqli_fetch_array($result)){
                ?>
                <option value=""><?php echo $row['section']?></option>
                <?php
            }


?>
            
          </select>
