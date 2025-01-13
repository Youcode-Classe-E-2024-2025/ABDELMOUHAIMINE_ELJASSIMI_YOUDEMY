<?php
        if(empty($_SESSION['user_id'])){
            header("location:?action=login");
            exit;
        }
include("header.php") ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center text-purple-500">Course Management</h1>
    
    <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden">
        <table class="w-full table-auto">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wide">Course Title</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wide">Students</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wide">Category</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wide">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-700 divide-y divide-gray-600">
                <?php foreach($courses as $course): ?>
                <tr class="hover:bg-gray-800 transition duration-300">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-100"><?= $course['title'] ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-400">127</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-green-500 text-gray-900">
                        <?=$course['category_id']?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
                        <form action="index.php?action=editCourse" method="POST">
                            <input type="hidden" name="id" value="<?=$course['id']?>">
                            <button type="submit" class="text-blue-400 hover:text-blue-300 transition duration-300 mr-3">Edit</button>
                        </form>
                        <form action="index.php?action=deleteCourse" method="POST">
                            <input type="hidden" name="id" value="<?=$course['id']?>">
                            <button type="submit" class="text-red-400 hover:text-red-300 transition duration-300">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
   <!-- Footer -->
   <footer class="bg-gray-800 py-8">
        <div class="container mx-auto px-6 text-center">
            <p class="text-gray-400">&copy; 2023 Youdemy. All rights reserved.</p>
            <div class="mt-4 space-x-4">
                <a href="#" class="text-gray-400 hover:text-purple-400 transition duration-300">Privacy Policy</a>
                <a href="#" class="text-gray-400 hover:text-purple-400 transition duration-300">Terms of Service</a>
            </div>
        </div>
    </footer>
</body>
</html>
