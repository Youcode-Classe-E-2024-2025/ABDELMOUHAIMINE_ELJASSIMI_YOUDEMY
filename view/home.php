<?php 
if(!empty($_SESSION["user_id"])){
if($_SESSION['user_status'] == 'suspended' ){
    header("location: index.php?action=suspended");
    exit;
}else if($_SESSION['user_status'] == 'deleted'){
    header("location: index.php?action=deleted");
    exit;
}
}

$role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : 'visiteur'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Online Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Manrope', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100"></body>
<header class="bg-gradient-to-r from-purple-700 via-purple-600 to-purple-500 shadow-lg">
<nav class="bg-gray-800 shadow-lg">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="index.php" class="text-3xl font-bold text-white hover:opacity-90 transition duration-300">Youdemy</a>
        
        <!-- Mobile Menu Button -->
        <button id="menu-toggle" class="lg:hidden text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <!-- Menu -->
        <ul id="menu" class="hidden lg:flex space-x-6 lg:space-x-6 bg-gray-800 lg:bg-transparent absolute lg:static top-16 lg:top-auto right-0 lg:right-auto w-full lg:w-auto z-10 lg:z-auto text-center lg:text-left">
            <li><a href="?action=home" class="block px-4 py-2 lg:inline-block text-white hover:text-purple-400 transition">Catalogue</a></li>
            <?php if ($role === 'visiteur'): ?>
                <li><a href="index.php?action=login" class="block px-4 py-2 lg:inline-block text-white hover:text-purple-400 transition">Login</a></li>
            <?php elseif ($role === 'student'): ?>
                <li><a href="index.php?action=mesCours" class="block px-4 py-2 lg:inline-block text-white hover:text-purple-400 transition">Mes Cours</a></li>
                <li><a href="profile.php" class="block px-4 py-2 lg:inline-block text-white hover:text-purple-400 transition">Profil</a></li>
            <?php elseif ($role === 'teacher'): ?>
                <li><a href="index.php?action=addCourse" class="block px-4 py-2 lg:inline-block text-white hover:text-purple-400 transition">Ajouter un cours</a></li>
                <li><a href="index.php?action=manageCourses" class="block px-4 py-2 lg:inline-block text-white hover:text-purple-400 transition">Gérer mes cours</a></li>
                <li><a href="index.php?action=TeacherStats" class="block px-4 py-2 lg:inline-block text-white hover:text-purple-400 transition">Statistiques</a></li>
            <?php elseif ($role === 'admin'): ?>
                <li><a href="index.php?action=manageUsers" class="block px-4 py-2 lg:inline-block text-white hover:text-purple-400 transition">Gérer utilisateurs</a></li>
                <li><a href="index.php?action=manageContent" class="block px-4 py-2 lg:inline-block text-white hover:text-purple-400 transition">Gérer contenu</a></li>
                <li><a href="index.php?action=adminstats" class="block px-4 py-2 lg:inline-block text-white hover:text-purple-400 transition">Statistiques globales</a></li>
            <?php endif; ?>
            <?php if ($role !== 'visiteur'): ?>
                <li><a href="?action=logout" class="block px-4 py-2 lg:inline-block text-red-400 hover:text-red-600 transition">Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
</header>
    <section class="bg-gradient-to-r from-gray-800 to-gray-900 py-16">
        <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-6 text-white">Find Your Perfect Course</h2>
        <p class="text-gray-400 mb-10">Explore thousands of courses in technology, business, design, and more.</p>
                <form method="GET" action="index.php?action=home">
                    <div class="flex justify-center">
                        <input type="text" name="keyword" placeholder="Search for courses..." 
                            class="w-full max-w-lg px-6 py-3 rounded-l-full bg-gray-700 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <button type="submit" 
                                class="bg-purple-600 text-white px-6 py-3 rounded-r-full shadow-md hover:bg-purple-700 hover:shadow-lg transition duration-300">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <main class="container mx-auto px-6 py-16">
        <h1 class="text-4xl font-bold mb-10 text-white text-center">Featured Courses</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php  foreach ($courses as $course): ?>
            <div class="bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl overflow-hidden transform hover:scale-105 transition duration-300">
                <img src="<?= $course["thumbnail"]?>" alt="Course Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-4 text-white"><?= $course["title"]?></h2>
                    <p class="text-gray-400 mb-6"><?= $course["description"]?></p>
                    <div class="flex justify-between items-center">
                        <span class="text-purple-400 font-bold text-xl">$49.99</span>
                        <a href="index.php?action=CourseDetails&id=<?= $course["id"]?>" class="bg-purple-600 text-white px-6 py-2 rounded-full shadow-md hover:bg-purple-700 hover:shadow-lg transition duration-300">View Details</a>
                    </div>
                </div>
            </div>
            <?php  endforeach; ?>
        </div>
        <div class="flex justify-center mt-16">
            <nav class="inline-flex rounded-full shadow-lg overflow-hidden">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>" 
                    class="px-6 py-3 bg-gray-800 text-white hover:bg-purple-500 transition duration-300">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" 
                    class="px-6 py-3 <?php echo $i == $page ? 'bg-purple-600 font-bold' : 'bg-gray-800'; ?> text-white hover:bg-purple-500 transition duration-300">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" 
                    class="px-6 py-3 bg-gray-800 text-white hover:bg-purple-500 transition duration-300">Next</a>
                <?php endif; ?>
            </nav>
        </div>
    </main>
    <?php include("footer.php")?>

    <script>
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
    </script>
</body>
</html>
