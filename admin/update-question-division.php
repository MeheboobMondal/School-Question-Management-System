<?php
include './header.php';
include './sidebar.php';
include '../connection.php';
$qs_id = $_GET['id'];
$sql6 = "SELECT  question_division_mas.status,question_division_mas.qs_id,question_division_mas.heading,  question_division_mas.division_mas,  question_division_mas.max_qs, emp_mas.emp_nm, question_mas.full_marks, class_mas.class_num, subject_mas.degree_nm, exam_group.group_name FROM question_division_mas
INNER JOIN question_mas ON question_mas.qpm_id = question_division_mas.qpm_id
INNER JOIN class_mas ON class_mas.class_id = question_mas.class_id
INNER JOIN subject_mas ON subject_mas.degree_id = question_mas.subject_id
INNER JOIN emp_mas ON emp_mas.hr_id =  question_division_mas.th_id
INNER JOIN exam_group ON exam_group.id = question_division_mas.group_id
WHERE question_division_mas.qs_id = '$qs_id'";
$result6 = mysqli_query($DBCON, $sql6);


?>


<div class="flex-1 p-8">
  <div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Update Question Devision</h2>
      <form method="post">
    <?php 
    while ($row6 = mysqli_fetch_array($result6)) {
        ?>
        



        <!-- Section Select -->

        <!-- class Name -->
        <div class="mb-4">
          <label for="totalMarks" class="block text-sm font-medium text-gray-700">Class Name</label>
          <input type="text" id="totalMarks" name="totalMarks" class="bg-gray-200 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" readonly value="<?php echo $row6['class_num'] ?>">
        </div> 
        <!-- Subject Name -->
        <div class="mb-4">
          <label for="totalMarks" class="block text-sm font-medium text-gray-700">Subject Name</label>
          <input type="text" id="totalMarks" name="totalMarks" class="bg-gray-200 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" readonly value="<?php echo $row6['degree_nm'] ?>">
        </div>
        <!-- Group Name -->
        <div class="mb-4">
          <label for="totalMarks" class="block text-sm font-medium text-gray-700">Subject Name</label>
          <input type="text" id="totalMarks" name="totalMarks" class="bg-gray-200 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" readonly value="<?php echo $row6['group_name'] ?>">
        </div>
       
        <!-- Total Marks Input -->
        <div class="mb-4">
          <label for="totalMarks" class="block text-sm font-medium text-gray-700">Group Marks</label>
          <input type="number" id="totalMarks" name="totalMarks" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required value="<?php echo $row6['division_mas'] ?>">
        </div>
        <div class="mb-4">
          <label for="heading" class="block text-sm font-medium text-gray-700">Heading </label>
          <input type="text" id="heading" name="heading" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required value="<?php echo $row6['heading'] ?>">
        </div>
        <div class="mb-4">
          <label for="max" class="block text-sm font-medium text-gray-700">Max Question</label>
          <input type="number" id="max" name="max" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required value="<?php echo $row6['max_qs'] ?>">
        </div>
        <?php
    }
    ?>
        
        <!-- Submit Button -->
        <div class="mt-6">
          <button type="submit" name="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update</button>
        </div>
        <div class="mt-6 w-full w-full">
          <a class="block text-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" href="view-question.php">Back</a>
        </div>
      </form>
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
    section(classValue);
    classNameload(classValue)
  }
  classNameload = (classValue) => {
    loadClass = classValue;
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
    comp.open("GET", "ajax/load-division-subject.php?cn=" + className, true);
    comp.send()
  }
  const section = (className) => {
    let comp = new XMLHttpRequest()
    comp.onreadystatechange = () => {
      if (comp.readyState == 4 && comp.status == 200) {
        let change = document.getElementById('sectionId')
        change.innerHTML = comp.responseText
      } else {
        let change = document.getElementById('sectionId')
        change.innerHTML = "error"
      }
    }
    comp.open("GET", "ajax/load-section.php?cn=" + className, true);
    comp.send()
  }
  const teacherload = (subject) => {
    teacher(subject, loadClass)

  }
  const teacher = (subject, className) => {
    let comp = new XMLHttpRequest()
    comp.onreadystatechange = () => {
      if (comp.readyState == 4 && comp.status == 200) {
        let change = document.getElementById('teacherId')
        change.innerHTML = comp.responseText
      } else {
        let change = document.getElementById('teacherId')
        change.innerHTML = "error"
      }
    }
    comp.open("GET", "ajax/load-teacher.php?cn=" + className + "&sub=" + subject, true);
    comp.send()
  }

  const loadteacherId = (teacher_name) => {
    console.log(teacher_name)
    let comp = new XMLHttpRequest()
    comp.onreadystatechange = () => {
      if (comp.readyState == 4 && comp.status == 200) {
        // let change = document.getElementById('teacherId')
        // change.innerHTML = comp.responseText
        // alert(comp.responseText)
      } else {
        // let change = document.getElementById('teacherId')
        // change.innerHTML = "error"
        // alert(comp.responseText)
      }
    }
    comp.open("GET", "ajax/load-teacherId.php?tn=" + teacher_name, true);
    comp.send()
  }
  const getGrpId = (group_name) => {
    // console.log(group_name)
    let comp = new XMLHttpRequest()
    comp.onreadystatechange = () => {
      if (comp.readyState == 4 && comp.status == 200) {
        // let change = document.getElementById('teacherId')
        // change.innerHTML = comp.responseText
        // alert(comp.responseText)
      } else {
        // let change = document.getElementById('teacherId')
        // change.innerHTML = "error"
        // alert(comp.responseText)
      }
    }
    comp.open("GET", "ajax/load-groupId.php?gn=" + group_name, true);
    comp.send()
  }
  <?php

  ?>
</script>

<?php

if (isset($_POST['submit'])) {





  $heading = mysqli_real_escape_string($DBCON, $_POST['heading']);
  $grp_marks = mysqli_real_escape_string($DBCON, $_POST['totalMarks']);
  $maxqs = mysqli_real_escape_string($DBCON, $_POST['max']);

  $sql3 = "UPDATE question_division_mas SET heading = '$heading', division_mas = '$grp_marks',  max_qs = '$maxqs' WHERE qs_id = '$qs_id'";

  $result3 = mysqli_query($DBCON, $sql3);
  if ($result3) {
?>
    <script>
      alert("Question Group Assign Successfully!")
      window.location = 'view-question.php';
    </script>
<?php
  }
}
