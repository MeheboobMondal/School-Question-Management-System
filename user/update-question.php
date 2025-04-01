<?php 
include '../connection.php';
include './header.php';
include './sidebar.php';
$id = $_GET['id'];
$sql = "SELECT qs_detials,qs_id, qpm_id FROM question_details WHERE qt_id = '$id'";
$result = mysqli_query($DBCON, $sql);
$question = '';
$qpm_id = '';
$qs_id = '';
while ($row = mysqli_fetch_array($result)) {
    $question = $row['qs_detials'];
    $qpm_id = $row['qpm_id'];
    $qs_id = $row['qs_id'];
}
?>
 <!-- Editor Container -->
 <div>
 <p class="bg-blue-100 text-blue-900 font-semibold p-4 rounded-lg shadow-md border-l-4 border-blue-500 text-center">
  For mathematical equations, click on <span class="font-bold">"Math,"</span> paste the raw LaTeX code, and hit <span class="font-bold">"Update."</span> You will see the output on the previous page!
</p>
 <div class="editor-container bg-white rounded-lg shadow-md p-5 max-w-3xl mx-auto mt-6 max-h-[500px]">
    <form method="post" class="flex flex-col items-center">
        <textarea id="mytextarea" class="w-full max-h-[200px] border border-gray-300 rounded-md p-3 text-sm" name="question">
            <?php echo $question ?>
        </textarea>
        <div class="flex gap-2">
        <button class="bg-red-500 text-white px-5 py-2 rounded-lg mt-4 hover:bg-red-600 transition duration-300" type="submit" name="submit">
            <a href="create-question.php?qpm=<?php echo $qpm_id?>&qs_id=<?php echo $qs_id?>">Back</a>
        </button>
        <button class="bg-blue-500 text-white px-5 py-2 rounded-lg mt-4 hover:bg-blue-600 transition duration-300" type="submit" name="submit">
            Update
        </button>
        
        </div>
    </form>
</div>
 </div>
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


</script>
<?php 
if(isset($_POST['submit'])){
    $update_question = mysqli_real_escape_string($DBCON, $_POST['question']);
    $sql1 = "UPDATE question_details SET qs_detials = '$update_question' WHERE qt_id = '$id'";
    $result1 = mysqli_query($DBCON, $sql1);
    if($result1){
        ?>
        <script>
            // alert('Question updated successfully');
            window.location = "create-question.php?qpm=<?php echo $qpm_id?>&qs_id=<?php echo $qs_id?>"
        </script>
        <?php
    }
}
?>