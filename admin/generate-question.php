<?php
include './header.php';
include './sidebar.php';
include '../connection.php'
?>


<div class="flex-1 ">
  <div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Avaliable Quesiton For Print</h2>
      <form method="post">

        <!-- Class Select -->
        <div class="mb-4">
          <label for="class" class="block text-sm font-medium text-gray-700">Class</label>
          
            <select id="class" name="class" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required onchange="updateSubject(this.value)">
            <option value="">select class</option>
            <?php
            $sql = "SELECT 
                      qdm.division_mas,
                      question_mas.full_marks,
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
                 WHERE qdm.status = 'completed'
        GROUP BY class_mas.class_id, class_mas.class_num
AND 
    qdm.status = 'completed'";

            $result = mysqli_query($DBCON, $sql);
            while ($row = mysqli_fetch_array($result)) {
             
             
            ?>
              
              <option value="<?php echo $row['class_num'] ?>"><?php echo $row['class_num'] ?></option>

            <?php
            
            }
            ?>


          </select>
          <?php
          
          ?>
          
        </div>

        <!-- Subject Name Select -->
        <div class="mb-4" id="subjectId">
          <label for="subjectName" class="block text-sm font-medium text-gray-700">Subject Name</label>
          <select id="subjectName" name="subjectName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>

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
    qdm.status = 'completed'";

            $result1 = mysqli_query($DBCON, $sql1);
            while ($row = mysqli_fetch_array($result1)) {
             
             ?>
               
               <option value="<?php echo $row['degree_nm'] ?>"><?php echo $row['degree_nm'] ?></option>
 
             <?php
             }
             ?>
          </select>
        </div>



        <!-- Section Select -->

        <!-- Group Select -->

        <!-- Submit Button -->
        <div class="mt-6">
          <button type="submit" name="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Generate</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</body>

</html>

<script>
const updateSubject = (className) => {
  
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
    comp.open("GET", "ajax/load-generate-subject.php?cn=" + className, true);
    comp.send()
  
}
const getSubjectId = (subjectName) => {
  let comp = new XMLHttpRequest()
    comp.onreadystatechange = () => {
      if (comp.readyState == 4 && comp.status == 200) {
        console.log(comp.responseText);
      } else {
        console.log("error")
      }
    }
    comp.open("GET", "ajax/load-subjectId.php?sn=" + subjectName, true);
    comp.send()
}

</script>

<?php

if (isset($_POST['submit'])) {


  $classid = $_SESSION['classid'];
  $subject_id = $_SESSION['subjectid'];
 
 
?>
    <script>
      
      window.location = 'print-question.php?cid=<?php echo $classid; ?>&sid=<?php echo $subject_id ?>';
    </script>
<?php
  
}
