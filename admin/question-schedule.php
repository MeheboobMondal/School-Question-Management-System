<?php
include './header.php';
include './sidebar.php';
include '../connection.php'
?>


<div class="flex-1 p-8">
  <div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Question Devision</h2>
      <form method="post">

        <!-- Class Select -->
        <div class="mb-4">
          <label for="class" class="block text-sm font-medium text-gray-700">Class</label>
          <select id="class" name="class" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required onchange="updateSubjectAndSection(this.value)">
            <option value="">select class</option>
            <?php
            $sql = "SELECT DISTINCT class_num 
                    FROM class_mas 
                    INNER JOIN question_mas ON question_mas.class_id = class_mas.class_id 
                    ";
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



        <!-- Section Select -->

        <!-- Group Select -->

        <div class="mb-4">
          <label for="section" class="block text-sm font-medium text-gray-700">Question Group</label>
          <select id="section" name="section" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required onchange="getGrpId(this.value)">
            <?php
            $sql = "SELECT group_name FROM exam_group";
            $result = mysqli_query($DBCON, $sql);
            echo "<option value=''>Select Group</option>";
            while ($row = mysqli_fetch_array($result)) {
            ?>
              <option value="<?php echo $row['group_name'] ?>"><?php echo $row['group_name'] ?></option>

            <?php
            }
            ?>

          </select>
        </div>

        <!-- Assign To Checkbox -->
        <!-- Section Select -->
        <div class="mb-4" id="teacherId">
          <label for="lela" class="block text-sm font-medium text-gray-700">Assign To</label>
          <select id="lela" name="section" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            <option value="">Select teacher</option>

          </select>
        </div>
        <!-- Total Marks Input -->
        <div class="mb-4">
          <label for="totalMarks" class="block text-sm font-medium text-gray-700">Group Marks</label>
          <input type="number" id="totalMarks" name="totalMarks" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>
        <div class="mb-4">
          <label for="heading" class="block text-sm font-medium text-gray-700">Heading </label>
          <input type="text" id="heading" name="heading" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>
        <div class="mb-4">
          <label for="max" class="block text-sm font-medium text-gray-700">Max Question</label>
          <input type="number" id="max" name="max" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>
        <!-- Submit Button -->
        <div class="mt-6">
          <button type="submit" name="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Assign</button>
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


  $classid = $_SESSION['classid'];
  $subject_id = $_SESSION['subjectid'];
  $teacher_id = $_SESSION['hr_id'];
  $groupId = $_SESSION['grp_id'];
  // echo $groupId;
  $sql2 = "SELECT qpm_id FROM question_mas WHERE class_id= '$classid' AND subject_id= '$subject_id'";
  $qpmId = 0;
  $result2 = mysqli_query($DBCON, $sql2);

  if ($row = mysqli_fetch_array($result2)) {
    $qpmId = $row['qpm_id'];
  }


  $heading = mysqli_real_escape_string($DBCON, $_POST['heading']);
  $grp_marks = mysqli_real_escape_string($DBCON, $_POST['totalMarks']);
  $maxqs = mysqli_real_escape_string($DBCON, $_POST['max']);

  $sql3 = "INSERT INTO question_division_mas(qpm_id, heading, division_mas, group_id, max_qs, th_id) VALUES ('$qpmId','$heading','$grp_marks','$groupId','$maxqs','$teacher_id')";

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
