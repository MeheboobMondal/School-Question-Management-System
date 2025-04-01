<?php
include './header.php';
include './sidebar.php';
include '../connection.php';
// $teacher_id = $_SESSION['hr_id'];
$qs_id = $_GET['qs_id'];
$qpm_id = $_GET['qpm'];
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
    question_division_mas.qs_id = '$qs_id'";

$result = mysqli_query($DBCON, $sql);
$sql3 = "SELECT 
    question_division_mas.max_qs FROM question_division_mas WHERE question_division_mas.qs_id = '$qs_id'";
$result3 = mysqli_query($DBCON, $sql3);
while ($row = mysqli_fetch_array($result3)) {
  $total_tasks = $row['max_qs'];
}



$sql2 = "SELECT qs_detials FROM question_details WHERE qs_id = '$qs_id'";
$result2 = mysqli_query($DBCON, $sql2);
$completeTask = mysqli_num_rows($result2);
$progress = ($completeTask / $total_tasks) * 100;
$progressBar = round($progress, 2);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- TinyMCE Script -->
  <script src="https://cdn.tiny.cloud/1/d71kkfjpozt900p9rl68i8w0msava9nmr2kaj48rmxr10ga3/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body class="bg-gray-100 font-sans p-5">
  <div class="container mx-auto">
    <!-- Task Cards Section -->
    <div class="">
      <?php
      while ($row = mysqli_fetch_array($result)) {
        $total_tasks = $row['max_qs'];

      ?>
       <div class="  p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
  <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
    <thead>
      <tr class="bg-gray-50">
        <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 uppercase">Class</th>
        <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 uppercase">Subject</th>
        <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 uppercase">Group</th>
        <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 uppercase">Marks</th>
        <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 uppercase">Max Questions</th>
        <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 uppercase">Status</th>
        <th class="py-3 px-4 text-center text-sm font-medium text-gray-600 uppercase">Action</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
      <tr class=" transition duration-200 border-b hover:bg-gray-100">
        <td class="py-4 px-4 text-sm text-gray-700 text-center"><?php echo $row['class_nm']; ?></td>
        <td class="py-4 px-4 text-sm text-gray-700 text-center"><?php echo $row['degree_nm']; ?></td>
        <td class="py-4 px-4 text-sm text-gray-700 text-center"><?php echo $row['group_name']; ?></td>
        <td class="py-4 px-4 text-sm text-gray-700 text-center"><?php echo $row['division_mas']; ?></td>
        <td class="py-4 px-4 text-sm text-gray-700 text-center"><?php echo $row['max_qs']; ?></td>
        <td class="py-4 px-4 text-center">
          <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2.5 rounded-full" style="width: <?php echo $progressBar . '%'; ?>;"></div>
          </div>
          <p class="text-xs text-gray-600 mt-1"><?php echo $progressBar . '% completed'; ?></p>
        </td>
        <td class="py-4 px-4 text-center">
          <a href="tasks.php" class="text-red-500 hover:text-red-700 text-md font-medium transition duration-300 flex items-center justify-center">
           Back ↩
          </a>
        </td>
      </tr>
    </tbody>
  </table>
</div>
      <?php
      }
      ?>
    </div>
    
    <!-- read Data -->


    <!-- TinyMCE Editor Section -->
    <h1 id="heading" class="text-3xl text-center text-gray-800 mb-5 mt-5">Create Only 1 Question each editor!</h1>
    <p id="msg" class="bg-blue-100 text-blue-900 font-semibold p-4 rounded-lg shadow-md border-l-4 border-blue-500 text-center max-w-[80vw] mx-auto hidden">
  For mathematical equations, click on <span class="font-bold">"Math,"</span> paste the raw LaTeX code, and hit <span class="font-bold">"Submit."</span> You will see the output on the previous page!
</p>

    <div class="text-center">
      <!-- Toggle Button -->
      <button id="toggleEditor" class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600 transition duration-300 mb-20">
        Add a Question
      </button>

      <!-- Editor Container -->
      <div class="editor-container bg-white rounded-lg shadow-md p-5 max-w-2xl mx-auto mt-6 hidden">
        <form method="post">
          <textarea id="mytextarea" class="w-full min-h-[300px] border border-gray-300 rounded-md p-3 text-sm" name="question" required>

          </textarea>
          <button class="bg-blue-500 text-white px-5 py-2 rounded-lg mt-4 hover:bg-blue-600 transition duration-300" type="submit" name="submit">
            Submit
          </button>
        </form>
      </div>
    </div>
    <div class="container mx-auto p-6">
  <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Questions Table</h2>
  <div class="overflow-x-auto rounded-lg shadow-md">
    <table class="min-w-full bg-white border border-gray-200">
      <!-- Table Header -->
      <thead class="bg-gray-100">
        <tr>
          <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Sl. Number</th>
          <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Question</th>
          <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase tracking-wider">Update</th>
          <!-- <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase tracking-wider">Delete</th> -->
        </tr>
      </thead>
      <!-- Table Body -->
      <tbody class="divide-y divide-gray-200">
        <?php
        $sql1 = "SELECT qs_detials, qt_id FROM question_details WHERE qs_id = '$qs_id'";
        $result1 = mysqli_query($DBCON, $sql1);
        $count = 1;
        $completeTask = mysqli_num_rows($result1);
        while ($row = mysqli_fetch_array($result1)) {
        ?>
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 text-sm text-gray-700 font-medium"><?php echo $count ?></td>
            <td class="px-6 py-4 text-sm text-gray-600"><?php echo $row['qs_detials'] ?></td>
            <td class="px-6 py-4 text-center">
              <a href="update-question.php?id=<?php echo $row['qt_id'] ?>" class="text-blue-500 hover:text-blue-700 transition-colors">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
            </td>
            <!-- <td class="px-6 py-4 text-center">
              <button class="text-red-500 hover:text-red-700 transition-colors">
                <a href="delete-question.php?id=<?php echo $row['qt_id'] ?>">Delete</a>
              </button>
            </td> -->
          </tr>
        <?php
          $count++;
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
  </div>

  <!-- TinyMCE Editor Popup -->
  <!-- MathJax Script -->
  <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
  <!-- TinyMCE Script -->
  <script src="https://cdn.tiny.cloud/1/d71kkfjpozt900p9rl68i8w0msava9nmr2kaj48rmxr10ga3/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  </div>
  <!-- TinyMCE Initialization -->
  <script>
     tinymce.init({
    selector: '#mytextarea',
    plugins: 'advlist autolink lists link charmap print preview',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | mathjax | exportpdf',
    content_style: `
        body { padding: 20px !important; }
        p { margin: 2px 0 !important; line-height: 1.2; }
        .math { font-size: 1.2em; display: inline-block; }
        @media print {
            @page { margin: 0; } 
            header, footer { display: none !important; }
            a[href]:after { content: none !important; }
        }
    `,
    forced_root_block: '',
    force_br_newlines: true,
    force_p_newlines: false,
    setup: function (editor) {
        // Custom MathJax button
        editor.ui.registry.addButton('mathjax', {
            text: 'Math',
            onAction: function () {
                editor.windowManager.open({
                    title: 'Insert Math Equation',
                    body: {
                        type: 'panel',
                        items: [{ type: 'textarea', name: 'math', label: 'Enter LaTeX equation:' }]
                    },
                    buttons: [
                        { type: 'cancel', text: 'Cancel' },
                        { type: 'submit', text: 'Insert', primary: true }
                    ],
                    onSubmit: function (api) {
                        var math = api.getData().math;

                        // Insert the MathJax formatted LaTeX equation wrapped inside a span
                        editor.insertContent(`<span class="math">\\(${math}\\)</span>`);

                        api.close();
                        setTimeout(renderMath, 100); // Ensure MathJax renders the new equation
                    }
                });
            }
        });

        // Function to re-render MathJax
        function renderMath() {
            if (window.MathJax) {
                MathJax.typesetPromise();
            }
        }

        // Render MathJax when TinyMCE is initialized
        editor.on('init', function () {
            renderMath();
        });

        // Re-render MathJax when content changes
        editor.on('input change paste', function () {
            setTimeout(renderMath, 100);
        });
    }
});

    // Toggle Editor Visibility
    document.getElementById('toggleEditor').addEventListener('click', function() {
      var editorContainer = document.querySelector('.editor-container');
      let msg = document.getElementById('msg');
      if (editorContainer.classList.contains('hidden') && msg.classList.contains('hidden')) {
        editorContainer.classList.remove('hidden');
        msg.classList.remove('hidden');
        document.getElementById('toggleEditor').style.display = 'none';
      } else {
        editorContainer.classList.add('hidden');
        msg.classList.add('hidden');
        this.textContent = 'Add a Question';
      }
    });
  </script>
  </div>
</body>

</html>
<?PHP
if (isset($_POST['submit'])) {
  $question = mysqli_real_escape_string($DBCON, $_POST['question']);
  $sql = "INSERT INTO question_details (qpm_id, qs_id, qs_detials) VALUES('$qpm_id','$qs_id','$question')";
  $result = mysqli_query($DBCON, $sql);
  if ($result) {


?>
    <script>
      alert("Question Added Successfully!!")
      window.location = "create-question.php?qs_id=<?php echo $qs_id ?>&qpm=<?php echo $qpm_id ?>"
    </script>
  <?php
  }
}
if ($completeTask == $total_tasks) {
  $sql4 = "UPDATE question_division_mas SET status= 'completed' WHERE qs_id = '$qs_id'";
  $result4 = mysqli_query($DBCON, $sql4);
  if ($result4) {
  ?>
    <script>
      document.getElementById('toggleEditor').style.display = 'none';
      document.getElementById('heading').innerText = "✅ Question Completed Like a Pro! 💡";
      document.getElementById('msg').style.display = 'none';
    </script>
<?php
  }
}
?>