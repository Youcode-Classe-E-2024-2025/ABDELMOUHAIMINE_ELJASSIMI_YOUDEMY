<?php
        if(empty($_SESSION['user_id'])){
            header("location:?action=login");
            exit;
        }
        $role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : 'visiteur';
include("header.php") ?>

<nav class="bg-gray-800 shadow-lg">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="index.php" class="text-3xl font-bold text-white hover:opacity-90 transition duration-300">Youdemy</a>
        <ul class="flex space-x-6">
            <li><a href="?action=home" class="text-white hover:text-purple-400 transition">Catalogue</a></li>
            <?php if ($role === 'visiteur'): ?>
                <li><a href="index.php?action=login" class="text-white hover:text-purple-400 transition">Login</a></li>
            <?php elseif ($role === 'student'): ?>
                <li><a href="index.php?action=mesCours" class="text-white hover:text-purple-400 transition">Mes Cours</a></li>
                <li><a href="profile.php" class="text-white hover:text-purple-400 transition">Profil</a></li>
            <?php elseif ($role === 'teacher'): ?>
                <li><a href="index.php?action=addCourse" class="text-white hover:text-purple-400 transition">Ajouter un cours</a></li>
                <li><a href="index.php?action=manageCourses" class="text-white hover:text-purple-400 transition">Gérer mes cours</a></li>
                <li><a href="index.php?action=TeacherStats" class="text-white hover:text-purple-400 transition">Statistiques</a></li>
            <?php elseif ($role === 'admin'): ?>
                <li><a href="validate_teachers.php" class="text-white hover:text-purple-400 transition">Valider enseignants</a></li>
                <li><a href="manage_users.php" class="text-white hover:text-purple-400 transition">Gérer utilisateurs</a></li>
                <li><a href="manage_content.php" class="text-white hover:text-purple-400 transition">Gérer contenu</a></li>
                <li><a href="admin_stats.php" class="text-white hover:text-purple-400 transition">Statistiques globales</a></li>
            <?php endif; ?>
            <?php if ($role !== 'visiteur'): ?>
                <li><a href="?action=logout" class="text-red-400 hover:text-red-600 transition">Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center text-purple-600">Course Statistics</h1>
    

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

    <div class="bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
            <h2 class="text-lg font-semibold text-gray-300 mb-2">Total Students</h2>
            <p class="text-4xl font-bold text-blue-500"><?= $stats["enrolled_students"]?></p>
            <p class="text-sm text-gray-400 mt-2">Enrolled students so far</p>
        </div>
       
        <div class="bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
            <h2 class="text-lg font-semibold text-gray-300 mb-2">Courses Published</h2>
            <p class="text-4xl font-bold text-green-500"><?= $stats["courses_number"] ?></p>
            <p class="text-sm text-gray-400 mt-2">Active courses online</p>
        </div>
        <div class="bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
            <h2 class="text-lg font-semibold text-gray-300 mb-2">Pending Reviews</h2>
            <p class="text-4xl font-bold text-yellow-500">12</p>
            <p class="text-sm text-gray-400 mt-2">Courses awaiting approval</p>
        </div>
        <div class="bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
            <h2 class="text-lg font-semibold text-gray-300 mb-2">Revenue</h2>
            <p class="text-4xl font-bold text-purple-500">$8,934</p>
            <p class="text-sm text-gray-400 mt-2">Total revenue earned</p>
        </div>
    </div>

    
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-4 text-gray-200">Enrollment Trends</h2>
        <div class="bg-gray-800 rounded-lg shadow-md p-6">
            
            <div class="w-full h-64 bg-gray-700 rounded-md flex items-center justify-center">
                <span class="text-gray-400">Chart Placeholder</span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
