<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar with Centered Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .active {
      background-color: #4a5568; /* Darker background */
      color: white; /* White text */
      border-left: 4px solid #4299e1; /* Blue left border */
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); /* Subtle shadow */
      transform: translateX(4px); /* Slight shift to the right */
      transition: all 0.3s ease; /* Smooth transition */
    }

    /* Hover effect for non-active items */
    .sidebar li:not(.active):hover {
      background-color: #2d3748; /* Darker hover background */
      color: white;
      transition: background-color 0.3s ease;
    }
  </style>
</head>
<body class="bg-gray-100">
  

  <!-- Main Layout -->
  <div class="flex">
    <!-- Sidebar -->
    <div class="bg-gray-800 text-white w-64 min-h-screen p-4">
      <h2 class="text-2xl font-bold mb-6">Menu</h2>
      <ul>
        <!-- Simple Menu -->
        <li class="mb-4">
          <a href="set-paper.php" class="hover:text-gray-400" onclick="setActive(event)">Set Paper</a>
        </li>
        <li class="mb-4">
          <a href="add-group.php" class="hover:text-gray-400" onclick="setActive(event)">Add Group</a>
        </li>
        <li class="mb-4">
          <a href="question-schedule.php" class="hover:text-gray-400" onclick="breadcome(event, 'Question Schedule'); setActive(event)">Question Devision</a>
        </li>
        <li class="mb-4">
          <a href="view-question.php" class="hover:text-gray-400" onclick="breadcome(event, 'Question Schedule'); setActive(event)">View Question Devision</a>
        </li>
        <li class="mb-4">
          <a href="complete-question.php" class="hover:text-gray-400" onclick="breadcome(event, 'Question Schedule'); setActive(event)">Completed Questions</a>
        </li>
        <li class="mb-4">
          <a href="generate-question.php" class="hover:text-gray-400" onclick="breadcome(event, 'Question Schedule'); setActive(event)">Generate Questions</a>
        </li>
      </ul>
    </div>
    <div class="w-full">
      <!-- Header -->
  <header class="bg-white shadow p-4">
    <div class="flex justify-between items-center">
      <div>
        <span class="text-gray-600">Welcome</span> - <span class="text-gray-800" id="breadcome"><?php echo $_SESSION['admin']?></span>
      </div>
      <div class="flex items-center">
        <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors entation-300">
          <a href="logout.php" class="text-white no-underline">LogOut</a>
        </button>
      </div>
    </div>
  </header>
    
  

  <script>
    const breadcome = (event, data) => {
      let text = document.getElementById('breadcome');
      if (data) {
        text.textContent = data;
      }
    }

    const setActive = (event) => {
      // Remove the active class from all li elements
      document.querySelectorAll('li').forEach(li => {
        li.classList.remove('active');
      });

      // Add the active class to the clicked li element
      event.target.parentElement.classList.add('active');
    }

    // Set the initial active menu item based on the current page
    document.addEventListener('DOMContentLoaded', () => {
      const currentPage = window.location.pathname.split('/').pop();
      document.querySelectorAll('a').forEach(a => {
        if (a.getAttribute('href') === currentPage) {
          a.parentElement.classList.add('active');
        }
      });
    });
  </script>
