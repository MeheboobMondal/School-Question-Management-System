<?php 
    include 'header.php';
    include 'sidebar.php';
    include '../connection.php';
    $id = $_GET['id'];
    $sql1 = "SELECT group_name FROM exam_group WHERE id = '$id'";
    $result1 = mysqli_query($DBCON, $sql1);
    while($row = mysqli_fetch_array($result1)){
        $groupName = $row['group_name'];
    }
?>



<div class="flex-1 p-8">
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Update Group</h2>
            <form method="post">
                <!-- Total Marks Input -->
                <div class="mb-4">
                    <label for="totalMarks" class="block text-sm font-medium text-gray-700">Group Name</label>
                    <input type="text" id="totalMarks" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required value="<?php echo $groupName?>">
                </div>
                <!-- <div class="mb-4">
                    <label for="totalMarks" class="block text-sm font-medium text-gray-700">Marks like (10*1=10)</label>
                    <input type="text" id="totalMarks" name="marks" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div> -->
                <!-- Class Select -->


                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" name="add">Update</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
</div>
<div class="overflow-x-auto">

</div>
</body>

</html>
<?php
if (isset($_POST['add'])) {
     // Ensure database connection is included
    $name = mysqli_real_escape_string($DBCON, $_POST['name']);

    $sql = "UPDATE  exam_group SET group_name = '$name' WHERE id = '$id'";
    try {
        $result = mysqli_query($DBCON, $sql);

        if ($result) {
            echo "<script>
                    alert('Group Updated Successfully');
                    window.location.href = 'add-group.php';
                  </script>";
        }
    } catch (Exception $e) {
        // Check if error is duplicate entry (MySQL error code 1062)
        if (mysqli_errno($DBCON) == 1062) {
            echo "<script>alert('Error: Group name already exists!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($DBCON) . "');</script>";
        }
    }
}
?>