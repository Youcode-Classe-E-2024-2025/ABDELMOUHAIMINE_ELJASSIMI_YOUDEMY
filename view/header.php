<?php 
if(empty($_SESSION['user_id'])){
    header("location:?action=login");
    exit;
}

if($_SESSION['user_status'] == 'suspended' ){
    header("location: index.php?action=suspended");
    exit;
}else if($_SESSION['user_status'] == 'deleted'){
    header("location: index.php?action=deleted");
    exit;
}

$role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : 'visiteur'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Online Learning Platform</title>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
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
                <li><a href="index.php?action=manageUsers" class="text-white hover:text-purple-400 transition">Gérer utilisateurs</a></li>
                <li><a href="index.php?action=manageContent" class="text-white hover:text-purple-400 transition">Gérer contenu</a></li>
                <li><a href="admin_stats.php" class="text-white hover:text-purple-400 transition">Statistiques globales</a></li>
            <?php endif; ?>
            <?php if ($role !== 'visiteur'): ?>
                <li><a href="?action=logout" class="text-red-400 hover:text-red-600 transition">Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
</header>