
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar with Centered Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <!-- Header -->
  


 

  <!-- new code -->
  <div class="flex">
    <!-- Sidebar -->
    <div class="bg-gray-800 text-white w-64 min-h-screen p-4">
  <h2 class="text-2xl font-bold mb-6">Menu</h2>
  <ul>
    <!-- Simple Menu -->
    <li class="mb-4">
      <a href="tasks.php" class="block hover:text-gray-400 p-2 rounded" onclick="setActive(event)">Your Tasks</a>
    </li>
    <!-- Add more menu items as needed -->
    
  </ul>
</div>
<div class="w-full">
<header class="bg-white shadow p-4">
    <div class="flex justify-between items-center">
      <div>
        <span class="text-gray-600">Welcome</span> - <span class="text-gray-800" id="breadcome"><?php echo $_SESSION['user']?></span>
      </div>
      <div class="flex items-center">
      <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors duration-300">
    <a href="logout.php" class="text-white no-underline">LogOut</a>
</button>
      </div>
    </div>
  </header>


<script>
  const setActive = (event) => {
    // Prevent the default link behavior (optional)
    event.preventDefault();

    // Remove the active class from all li elements
    document.querySelectorAll('li').forEach(li => {
      li.classList.remove('bg-gray-700', 'text-white');
    });

    // Add the active class to the clicked li element
    const li = event.target.parentElement;
    li.classList.add('bg-gray-700', 'text-white');

    // Navigate to the link's href (if you want to keep the link functionality)
    window.location.href = event.target.getAttribute('href');
  };

  // Set the initial active menu item based on the current page
  document.addEventListener('DOMContentLoaded', () => {
    const currentPage = window.location.pathname.split('/').pop();
    document.querySelectorAll('a').forEach(a => {
      if (a.getAttribute('href') === currentPage) {
        a.parentElement.classList.add('bg-gray-700', 'text-white');
      }
    });
  });
</script>