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
                <li><a href="" class="text-white hover:text-purple-400 transition">Mes Cours</a></li>
                <li><a href="profile.php" class="text-white hover:text-purple-400 transition">Profil</a></li>
            <?php elseif ($role === 'teacher'): ?>
                <li><a href="index.php?action=addCourse" class="text-white hover:text-purple-400 transition">Ajouter un cours</a></li>
                <li><a href="index.php?action=manageCourses" class="text-white hover:text-purple-400 transition">Gérer mes cours</a></li>
                <li><a href="stats.php" class="text-white hover:text-purple-400 transition">Statistiques</a></li>
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
    <h1 class="text-3xl font-bold mb-8 text-center text-purple-500">Course Management</h1>
    
    <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden">
        <table class="w-full table-auto">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wide">Course Title</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wide">Description</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wide">Category</th>
                </tr>
            </thead>
            <tbody class="bg-gray-700 divide-y divide-gray-600">
                <?php foreach($courses as $course): ?>
                <tr class="hover:bg-gray-800 transition duration-300">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-100"><?= $course['title'] ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-400"><?= $course['description'] ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-green-500 text-gray-900">
                        <?=$course['category_name']?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("footer.php")?>
</body>
</html>
