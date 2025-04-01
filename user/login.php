<?php
include '../connection.php'; 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    User Id
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="userid" name="user-name">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" name="password">
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit">
                    Sign In
                </button>
                
            </div>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    
    $userid = mysqli_real_escape_string($DBCON, $_POST['user-name']);
    $password = mysqli_real_escape_string($DBCON, $_POST['password']);

    
    $sql = "SELECT * FROM user_mas WHERE user_id = '$userid' and pwd = '$password' and user_type = 'G'";
    $result = mysqli_query($DBCON, $sql);

    if (mysqli_num_rows($result) > 0) {
        // $user = mysqli_fetch_assoc($result);
        while($row = mysqli_fetch_array($result)) {
            $_SESSION['hr_id'] = $row['hr_id'];
            $userName = $row['user_nm'];
        }
        $sql1 = "SELECT session_id FROM sessin_mas WHERE status='Y'";
        $result1 = mysqli_query($DBCON, $sql1);
        $row = mysqli_fetch_assoc($result1);
        
        $_SESSION['session_id'] = $row['session_id'];
        $_SESSION['user'] = $userName;
       
        header("Location:tasks.php");
        
       

        
        
    } else {
        ?>
        <script>
            alert("User not found!");
        </script>
    <?php
    }
}
?>