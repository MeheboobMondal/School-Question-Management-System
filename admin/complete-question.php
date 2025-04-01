<?php
include './header.php';
include './sidebar.php';
include '../connection.php'
?>
<div class="w-full">
    <div class="overflow-x-auto  p-8">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">Sl No</th>
                    <th class="py-2 px-4 border-b">Class Name</th>
                    <th class="py-2 px-4 border-b">Subject Name</th>
                    <th class="py-2 px-4 border-b">Full Marks</th>
                    <th class="py-2 px-4 border-b">Group Name</th>
                    <th class="py-2 px-4 border-b">Group Marks</th>
                    <th class="py-2 px-4 border-b">Assign</th>

                    <!-- <th class="py-2 px-4 border-b">Add</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT  question_division_mas.qs_id,question_division_mas.heading,  question_division_mas.division_mas,  question_division_mas.max_qs, emp_mas.emp_nm, question_mas.full_marks, class_mas.class_num, subject_mas.degree_nm, exam_group.group_name FROM question_division_mas
    INNER JOIN question_mas ON question_mas.qpm_id = question_division_mas.qpm_id
    INNER JOIN class_mas ON class_mas.class_id = question_mas.class_id
    INNER JOIN subject_mas ON subject_mas.degree_id = question_mas.subject_id
    INNER JOIN emp_mas ON emp_mas.hr_id =  question_division_mas.th_id
    INNER JOIN exam_group ON exam_group.id = question_division_mas.group_id
    WHERE question_division_mas.status = 'completed'
    ORDER BY class_mas.class_num DESC, subject_mas.degree_nm, exam_group.group_name
    ";
                $result = mysqli_query($DBCON, $sql);
               $count=1;
                while ($row = mysqli_fetch_array($result)) {
                    
                    
                  
                ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b text-center"><?php echo $count ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $row['class_num'] ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $row['degree_nm'] ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $row['full_marks'] ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $row['group_name'] ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $row['division_mas'] ?></td>
                            <td class="py-2 px-4 border-b text-center"><?php echo $row['emp_nm'] ?></td>
                            <!-- <td class="py-2 px-4 border-b text-center text-blue-500">Add</td> -->

                        </tr>
                    <?php
                    $count++;
                    }
                    ?>

                <?php
               
                ?>



            </tbody>
        </table>
    </div>
</div>