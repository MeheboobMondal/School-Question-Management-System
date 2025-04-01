<?php
include 'header.php';
include 'sidebar.php';
include '../connection.php';
$teacher_id = $_SESSION['hr_id'];
// echo $teacher_id;
$sql = "SELECT 
    question_division_mas.max_qs, 
    question_mas.qpm_id,
    question_division_mas.qs_id, 
    exam_group.group_name, 
    question_division_mas.division_mas, 
    class_mas.class_nm, 
    subject_mas.degree_nm 
FROM 
    question_division_mas 
INNER JOIN 
    question_mas ON question_mas.qpm_id = question_division_mas.qpm_id  
INNER JOIN 
    class_mas ON question_mas.class_id = class_mas.class_id 
INNER JOIN 
    subject_mas ON question_mas.subject_id = subject_mas.degree_id 
INNER JOIN 
    exam_group ON question_division_mas.group_id = exam_group.id  


WHERE 
    question_division_mas.th_id = '$teacher_id'";

$result = mysqli_query($DBCON, $sql);

$status = "Create Question";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Progress Bar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .progress-bar {
            transition: width 0.5s ease;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-gray-50 to-gray-100 p-8">
    <div class="w-full px-10 mx-auto ">
        <h1 class="text-4xl font-bold mb-8 text-gray-800 text-center mt-5">Task Progress</h1>

        <!-- Flex Container for Task Cards -->
        <div class="flex flex-wrap gap-6">
            <!-- Task 1 -->
             <!-- table head -->
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 border-b">Sl No</th>
                <th class="py-2 px-4 border-b">Class</th>
                <th class="py-2 px-4 border-b">Subject</th>
                <th class="py-2 px-4 border-b">Group</th>
                <th class="py-2 px-4 border-b">Marks</th>
                <th class="py-2 px-4 border-b">Max Question</th>
                <th class="py-2 px-4 border-b">Progress</th>
                <th class="py-2 px-4 border-b">Action</th>
            </tr>
        </thead>
            <?php
            $count = 1;
            while ($row = mysqli_fetch_array($result)) {
                $qs_id =  $row['qs_id'];
                $sql4 = "SELECT status FROM question_division_mas  WHERE qs_id = '$qs_id'";
                $result4 = mysqli_query($DBCON, $sql4);
                if($result4){
                    while($row4 = mysqli_fetch_array($result4)){
                    if($row4['status'] == 'completed') {
                 
                    $status = "✏️";
                    }else{
                    $status = "➕";
                    }
                    }
                }
                $sql3 = "SELECT question_division_mas.max_qs FROM question_division_mas WHERE question_division_mas.qs_id = '$qs_id'";
                $result3 = mysqli_query($DBCON, $sql3);
                while ($row1 = mysqli_fetch_array($result3)) {
                    $total_tasks = $row1['max_qs'];
                }



                $sql2 = "SELECT qs_detials FROM question_details WHERE qs_id = '$qs_id'";
                $result2 = mysqli_query($DBCON, $sql2);
                $completeTask = mysqli_num_rows($result2);
                $progress = ($completeTask / $total_tasks) * 100;
                $progressBar = round($progress, 2);
            ?>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 text-gray-700 text-center"> <?php echo $count ?> </td>
                    <td class="py-2 px-4 text-gray-700 text-center"> <?php echo $row['class_nm']; ?> </td>
                    <td class="py-2 px-4 text-gray-700 text-center"> <?php echo $row['degree_nm']; ?> </td>
                    <td class="py-2 px-4 text-gray-700 text-center"> <?php echo $row['group_name']; ?> </td>
                    <td class="py-2 px-4 text-gray-700 text-center"> <?php echo $row['division_mas']; ?> </td>
                    <td class="py-2 px-4 text-gray-700 text-center"> <?php echo $row['max_qs']; ?> </td>
                    <td class="py-2 px-4 text-center">
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="progress-bar bg-gradient-to-r from-blue-400 to-blue-600 h-3 rounded-full" style="width: <?php echo $progressBar . '%'; ?>;"></div>
                        </div>
                        <p class="text-gray-600 text-sm mt-1"> <?php echo $progressBar . '% completed'; ?> </p>
                    </td>
                    <td class="py-2 px-4 text-center">
                        <a href="create-question.php?qpm=<?php echo $row['qpm_id']; ?>&qs_id=<?php echo $row['qs_id']; ?>"
                           class="">
                            <?php echo $status; ?>
                        </a>
                    </td>
                </tr>
            <?php
            $count++;
            }
            ?>
            </table>


        </div>

        <!-- Overall Progress Card -->

    </div>
    </div>
</body>

</html>
<?php
