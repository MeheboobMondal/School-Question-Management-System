<?php include 'header.php'?>
   <?php include 'sidebar.php'?>

    <!-- Main Content -->
    

        <!-- Main Content Area -->
        <main class="p-4">
            <h1 class="text-2xl font-bold mb-4">Welcome to the Dashboard</h1>
            <p class="text-gray-700">This is the main content area. You can add charts, tables, or other components here.</p>
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow p-4 mt-auto">
            <p class="text-center text-gray-600">Developed by 3rd Year</p>
        </footer>
    </div>

    <!-- JavaScript for Dropdown Toggle -->
    <script>
        document.querySelectorAll('.cursor-pointer').forEach(item => {
            item.addEventListener('click', () => {
                const dropdown = item.nextElementSibling;
                dropdown.classList.toggle('hidden');
            });
        });
        window.location = "tasks.php"
    </script>
</body>
</html>