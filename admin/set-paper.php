<?php
include './header.php';
include './sidebar.php';
?>
<div class="w-full">


<div class=" p-8">
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Set Question Paper</h2>
            <form method="post">
                <!-- Total Marks Input -->
                <!-- Total Marks Input -->

                
                
                <!-- Class Select -->
                <div class="mb-4">
                    <label for="class" class="block text-sm font-medium text-gray-700">Class</label>
                    <select id="class" name="class" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required onchange="updateSubjectAndSection(this.value)">
                        <option value="">select class</option>
                        <?php
                        $sql = "SELECT class_num FROM class_mas";
                        $result = mysqli_query($DBCON, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>

                            <option value="<?php echo $row['class_num'] ?>"><?php echo $row['class_num'] ?></option>

                        <?php
                        }
                        ?>


                    </select>
                </div>

                <!-- Subject Name Select -->
                <div class="mb-4" id="subjectId">
                    <label for="subjectName" class="block text-sm font-medium text-gray-700">Subject Name</label>
                    <select id="subjectName" name="subjectName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="">Select Subject</option>

                    </select>
                </div>
                <div class="mb-4">
                    <label for="class" class="block text-sm font-medium text-gray-700">Exam Type</label>
                    <select id="class" name="exam_type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required onchange="">
                        <option value="">select type</option>
                        <?php
                        $sql4 = "SELECT exam_desc FROM exam_master";
                        $result4 = mysqli_query($DBCON, $sql4);
                        while ($row = mysqli_fetch_array($result4)) {
                        ?>

                            <option value="<?php echo $row['exam_desc'] ?>"><?php echo $row['exam_desc'] ?></option>

                        <?php
                        }
                        ?>


                    </select>
                    </div>


                <!-- Section Select -->
                <!-- <div class="mb-4" id="sectionId">
          <label for="section" class="block text-sm font-medium text-gray-700">Section</label>
          <select id="section" name="section" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
           
            
          </select>
        </div> -->
                <!-- Group Select -->
                <div class="mb-4">
                    <label for="totalMarks" class="block text-sm font-medium text-gray-700">Full Marks</label>
                    <input type="number" id="totalMarks" name="fullMarks" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div> 
                <!-- set Time -->
                <div class="mb-4">
                    <label for="totaltime" class="block text-sm font-medium text-gray-700">Total Times</label>
                    <input type="text" id="totaltime" name="totaltime" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-4">
                    <label for="totalMarks" class="block text-sm font-medium text-gray-700">General Instruction</label>
                    <textarea rows="5" placeholder="Enter Instruction Here" type="number" id="totalMarks" name="generalInstruction" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                </div>

                <!-- Assign To Checkbox -->
                

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" name="create" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create</button>
                </div>
            </form>
        </div>
    </div>
    <div class="overflow-x-auto  p-8">
<button id="toggleTable" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4">
<span id="toggleTableText">Hide Table</span>
</button>
  <div id="tableContainer" class="overflow-x-auto p-8">
  <table class="min-w-full bg-white border border-gray-300">
    <thead>
      <tr class="bg-gray-100">
        <th class="py-2 px-4 border-b">Exam Type</th>
        <th class="py-2 px-4 border-b">Class Name</th>
        <th class="py-2 px-4 border-b">Subject Name</th>
        <th class="py-2 px-4 border-b">Full Marks</th>
        <th class="py-2 px-4 border-b">General Instruction</th>
        <th class="py-2 px-4 border-b">Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $sql = "SELECT question_mas.qpm_id, question_mas.exam_type, question_mas.full_marks, question_mas.general_instruction, class_mas.class_num, subject_mas.degree_nm FROM question_mas INNER JOIN class_mas ON class_mas.class_id = question_mas.class_id INNER JOIN subject_mas ON subject_mas.degree_id = question_mas.subject_id";
    $result = mysqli_query($DBCON, $sql);
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr class="hover:bg-gray-50">
        <td class="py-2 px-4 border-b text-center"><?php echo $row['exam_type']?></td>
        <td class="py-2 px-4 border-b text-center"><?php echo $row['class_num']?></td>
        <td class="py-2 px-4 border-b text-center"><?php echo $row['degree_nm']?></td>
        <td class="py-2 px-4 border-b text-center"><?php echo $row['full_marks']?></td>
        <td class="py-2 px-4 border-b text-center"><?php echo $row['general_instruction']?></td>
        <td class="px-4 py-2 border-b"> <a href="delete-paper.php?id=<?php echo $row['qpm_id']?>"><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-red-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg></a></td>
      </tr>
        <?php
    }
    ?>
      
     
      
    </tbody>
  </table>
  </div>
</div>
</div>
</div>
</div>

</body>

</html>

<script>
    let loadClass = "";

    function updateSubjectAndSection(classValue) {
        subject(classValue);
    }

    const subject = (className) => {
        let comp = new XMLHttpRequest()
        comp.onreadystatechange = () => {
            if (comp.readyState == 4 && comp.status == 200) {
                let change = document.getElementById('subjectId')
                change.innerHTML = comp.responseText
            } else {
                let change = document.getElementById('subjectId')
                change.innerHTML = "error"
            }
        }
        comp.open("GET", "ajax/load-subject.php?cn=" + className, true);
        comp.send()
    }
    // JavaScript to toggle table visibility and update button text
    document.getElementById('toggleTable').addEventListener('click', function() {
        const tableContainer = document.getElementById('tableContainer');
        tableContainer.classList.toggle('hidden');
        document.getElementById('toggleTableText').innerText = tableContainer.classList.contains('hidden') ? 'Show Table' : 'Hide Table';
    })
</script>

<?php
if (isset($_POST['create'])) {
    $classId = 0;
    $subject_id = 0;
    $sessionId = $_SESSION['session_id'];
    $fullMarks = mysqli_real_escape_string($DBCON, $_POST['fullMarks']);
    $totaltime = mysqli_real_escape_string($DBCON, $_POST['totaltime']);
    $className = mysqli_real_escape_string($DBCON, $_POST['class']);
    $subjectName = mysqli_real_escape_string($DBCON, $_POST['subjectName']);
    $gi = mysqli_real_escape_string($DBCON, $_POST['generalInstruction']);
    $examType = mysqli_real_escape_string($DBCON, $_POST['exam_type']);
    // echo $className;
    $sql = "SELECT class_id FROM class_mas WHERE class_num = '$className'";
    $result = mysqli_query($DBCON, $sql);
    if ($row = mysqli_fetch_array($result)) {
        $classId = $row['class_id'];
    }

    $sql1 = "SELECT degree_id FROM subject_mas WHERE class_id = '$classId' AND degree_nm = '$subjectName'";
    $result1 = mysqli_query($DBCON, $sql1);
    if ($row = mysqli_fetch_array($result1)) {
        $subject_id = $row['degree_id'];
    }
  
    $org = 0;
    $sql3 = "SELECT orgn_id FROM orgn_mas";
    $result3 = mysqli_query($DBCON, $sql3);
    if($row = mysqli_fetch_array($result3)){
        $org = $row['orgn_id'];
    }

    $sql2 = "INSERT into question_mas (exam_type, session_id, class_id, subject_id, full_marks, general_instruction, orgn_id, time) VALUES('$examType', '$sessionId', '$classId', '$subject_id', '$fullMarks', '$gi', '$org', '$totaltime')";
    $result2 = mysqli_query($DBCON, $sql2);
    if ($result2) {
?>
        <script>
            alert("Question Paper Created Successfully!");
            window.location = "set-paper.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Question Paper Created Successfully!");
            window.location = "set-paper.php";
        </script>
<?php
    }
}
