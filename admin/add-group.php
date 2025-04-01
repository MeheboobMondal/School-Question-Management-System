<?php
include './header.php';
include './sidebar.php';

?>


<div class="flex-1 p-8">
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Add Group</h2>
            <form method="post">
                <!-- Total Marks Input -->
                <div class="mb-4">
                    <label for="totalMarks" class="block text-sm font-medium text-gray-700">Group Name</label>
                    <input type="text" id="totalMarks" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <!-- <div class="mb-4">
                    <label for="totalMarks" class="block text-sm font-medium text-gray-700">Marks like (10*1=10)</label>
                    <input type="text" id="totalMarks" name="marks" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div> -->
                <!-- Class Select -->


                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" name="add">Add</button>
                </div>
            </form>
            <table class="w-6xl bg-white border border-gray-300 mt-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b">ID</th>
                        <th class="px-4 py-2 border-b">Group Name</th>
                        <th class="px-4 py-2 border-b">Update</th>
                        <th class="px-4 py-2 border-b">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql1 = "select * from exam_group";
                    $result1 = mysqli_query($DBCON, $sql1) or die("Faild to fetch group data");
                    while ($data = mysqli_fetch_array($result1)) {
                    ?>
                        <tr class="hover:bg-gray-50">
    <td class="px-4 py-3 border-b text-sm"><?php echo $data['id'] ?></td>
    <td class="px-4 py-3 border-b text-sm"><?php echo $data['group_name'] ?></td>
    <td class="px-4 py-3 border-b text-sm text-center">
        <a href="update-group.php?id=<?php echo $data['id']?>" class="text-blue-500 hover:text-blue-700">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    </td>
    <td class="px-4 py-3 border-b text-sm text-center">
        <a href="delete-group.php?id=<?php echo $data['id'] ?>" class="text-red-500 hover:text-red-700">
            <i class="fa-solid fa-trash-can"></i>
        </a>
    </td>
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
<div class="overflow-x-auto">

</div>
</body>

</html>
<?php
if (isset($_POST['add'])) {
     // Ensure database connection is included
    $name = mysqli_real_escape_string($DBCON, $_POST['name']);

    $sql = "INSERT INTO exam_group (group_name) VALUES ('$name')";
    try {
        $result = mysqli_query($DBCON, $sql);

        if ($result) {
            echo "<script>
                    alert('Group Added Successfully');
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