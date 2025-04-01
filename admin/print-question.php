<?php
include './header.php';
include './sidebar.php';
include '../connection.php';

$class_id = $_GET['cid'];
$subject_id = $_GET['sid'];
$sql2 = "SELECT question_mas.full_marks, question_division_mas.division_mas FROM question_mas
            INNER JOIN question_division_mas ON question_mas.qpm_id = question_division_mas.qpm_id
             WHERE question_mas.class_id = '$class_id' AND question_mas.subject_id = '$subject_id'";

$result2 = mysqli_query($DBCON, $sql2);
$full_marks = 0;
$division_mas = 0;
while ($row = mysqli_fetch_array($result2)) {
    $full_marks = $row['full_marks'];
    $division_mas += $row['division_mas'];
}
if ($full_marks == $division_mas) {
    $sql1 = "SELECT DISTINCT 
        om.orgn_nm,
        qm.exam_type, 
        qm.full_marks, 
        qm.time, 
        qm.general_instruction, 
        cm.class_num,  
        sm.degree_nm, 
        qdm.heading, 
        qdm.division_mas, 
        eg.group_name, 
        GROUP_CONCAT(TRIM(qd.qs_detials) SEPARATOR '|~|') AS qs_details
    FROM question_mas qm
    INNER JOIN class_mas cm ON qm.class_id = cm.class_id
    INNER JOIN subject_mas sm ON qm.subject_id = sm.degree_id
    INNER JOIN question_division_mas qdm ON qm.qpm_id = qdm.qpm_id
    INNER JOIN exam_group eg ON qdm.group_id = eg.id
    INNER JOIN question_details qd ON qdm.qs_id = qd.qs_id
    INNER JOIN orgn_mas om ON qm.orgn_id = om.orgn_id
    WHERE qm.class_id = '$class_id' AND qm.subject_id = '$subject_id'
    GROUP BY 
        om.orgn_nm, qm.exam_type, qm.full_marks, qm.general_instruction, 
        cm.class_num, sm.degree_nm, qdm.heading, qdm.division_mas, 
        eg.group_name
    ORDER BY eg.id
    LIMIT 1";

    $result1 = mysqli_query($DBCON, $sql1);
    if ($row1 = mysqli_fetch_assoc($result1)) {
        $orgn_nm = $row1['orgn_nm'];
        $exam_type = $row1['exam_type'];
        $class_num = $row1['class_num'];
        $degree_nm = $row1['degree_nm'];
        $full_marks = $row1['full_marks'];
        $time = $row1['time'];
        echo "<hr style='margin: 5px 0;'>";
        $general_instruction = $row1['general_instruction'];
    }

    $sql = "SELECT 
        om.orgn_nm,
        qm.exam_type, 
        qm.full_marks,
        qm.general_instruction, 
        cm.class_num,  
        sm.degree_nm, 
        qdm.heading, 
        qdm.division_mas, 
        eg.group_name,  
        GROUP_CONCAT(TRIM(qd.qs_detials) ORDER BY qd.qt_id ASC SEPARATOR '|~|') AS qs_details
    FROM question_mas qm
    INNER JOIN class_mas cm ON qm.class_id = cm.class_id
    INNER JOIN subject_mas sm ON qm.subject_id = sm.degree_id
    INNER JOIN question_division_mas qdm ON qm.qpm_id = qdm.qpm_id
    INNER JOIN exam_group eg ON qdm.group_id = eg.id
    INNER JOIN question_details qd ON qdm.qs_id = qd.qs_id
    INNER JOIN orgn_mas om ON qm.orgn_id = om.orgn_id
    WHERE qm.class_id = '$class_id' AND qm.subject_id = '$subject_id'
    GROUP BY 
        eg.id -- Group by exam group ID
    ORDER BY 
        eg.group_name ASC, qd.qt_id ASC";

    $result = mysqli_query($DBCON, $sql);
?>

<!-- Main Container -->
<div class="flex-1 p-8 min-h-screen">
    <div class="flex flex-col items-center justify-center flex-1">
        
        <!-- Download Button -->
        <button id="downloadBtn" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Download PDF</button>

        <div class="editor-container bg-white rounded-lg shadow-md p-5 max-w-2xl w-full mx-auto mt-6" id="questionPaper">
            
<?php
    echo "<p style='text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 2px;'>$orgn_nm</p>";
    echo "<p style='text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 2px;'> $exam_type</p>";
    echo "<p style='text-align: center; margin-bottom: 2px;'>Class: $class_num</p>";
    echo "<p style='text-align: center; margin-bottom: 2px;'>Subject: $degree_nm</p>";
    echo "<p style='text-align: center; margin-bottom: 2px;'>Full Marks: $full_marks</p>";
    echo "<p style='text-align: left; margin-bottom: 2px;'>Time Allowed: $time</p>";
    echo "<hr style='margin: 5px 0;'>";
    echo "<p style='text-align: left; font-weight: bold; margin-bottom: 2px;'>General Instruction:</p>";
    echo "<p style='text-align: left; margin-bottom: 2px;'>$general_instruction</p>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<div style='position: relative; text-align: center;'>
        <div>
            <p class='groupName' style='font-weight: bold; margin-bottom: 2px; margin-top:5px;'>{$row['group_name']}</p>
            <p style='font-weight: semi-bold; margin-bottom: 2px;'>{$row['heading']}</p>
        </div>
        <p style='position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-weight: bold;'>{$row['division_mas']}</p>
    </div>";
        

        // Split questions and display them
        $questions = array_filter(explode("|~|", $row['qs_details']), 'strlen');
        foreach ($questions as $question) {
            // Clean the question: remove new lines, extra spaces, and trim
            $question = trim($question);
            $question = str_replace(["\r", "\n", "  "], '', $question); // Remove new lines and extra spaces

            // Display the question without any extra spaces
            echo "<p style='margin-bottom: 5px; font-family: Times New Roman, serif;'>{$question}</p>";
        }

        echo "<hr class='hr'style='margin: 5px 5px; margin-top:10px'>";
    }
?>
                
        </div>
    </div>
</div>

<!-- Include MathJax for rendering equations -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML"></script>

<!-- Include html2pdf library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    // Ensure MathJax is fully loaded before using it
    window.addEventListener('load', function() {
        if (typeof MathJax === 'undefined' || !MathJax.Hub) {
            console.error("MathJax is not loaded. Please check the script URL.");
            return;
        }

        console.log("MathJax is fully loaded and initialized.");

        // Add event listener for the download button
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const element = document.getElementById('questionPaper'); // Define element here

            // Ensure MathJax has finished rendering
            MathJax.Hub.Queue(function() {
                // Add a small delay to ensure MathJax rendering is complete
                setTimeout(function() {
                    // Hide the original LaTeX code inside <span class="math"> elements
                    const mathSpans = document.querySelectorAll('span.math');
                    console.log( mathSpans)
                    mathSpans.forEach(span => {
                        span.style.color = ''; // Hide the original LaTeX code
                        span.style.fontSize = '0'; // Make the original LaTeX code take up no space
                    });

                    // Configure html2pdf
                    const options = {
                        margin: 10, // Margin around the content
                        filename: 'question_paper.pdf', // Output file name
                        image: { type: 'jpeg', quality: 0.98 }, // Image quality
                        html2canvas: { 
                            scale: 2, // Scale for better quality
                            logging: true, // Enable logging for debugging
                            useCORS: true, // Enable CORS for external resources
                            allowTaint: true, // Allow tainted canvas (if needed)
                            onclone: function(clonedDoc) {
                                // Ensure MathJax elements are visible in the cloned document
                                const mathjaxElements = clonedDoc.querySelectorAll('.MathJax_SVG, .MathJax');
                                mathjaxElements.forEach(element => {
                                    element.style.visibility = 'visible';
                                });

                                // show the original LaTeX code in the cloned document
                                const mathSpans = clonedDoc.querySelectorAll('span.math');
                                console.log(mathSpans)
                                mathSpans.forEach(span => {
                                    span.style.color = '';
                                    span.style.fontSize = '';
                                });
                            }
                        },
                        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' } // PDF format
                    };

                    // Generate PDF
                    
                    html2pdf().from(element).set(options).save().then(() => {
                        // Restore the original LaTeX code after PDF generation
                        mathSpans.forEach(span => {
                            span.style.color = '';
                            span.style.fontSize = '';
                        });
                    });
                }, 1000); // Increased delay to 2000ms for better rendering
            });
            MathJax.Hub.Queue(["Typeset", MathJax.Hub, element]); // Re-render MathJax
        });
    });
</script>

<?php
} elseif ($full_marks > $division_mas) {
    echo "<script>alert('Your Current Question Marks is less than Total Marks!')
    window.location = 'view-question.php'
    </script>";
} else {
    echo "<script>alert('Your Current Question Marks is Grater than Total Marks!')</script>";
}
?>