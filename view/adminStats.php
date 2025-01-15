<?php
include("header.php") ?>
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-extrabold mb-8 text-center text-purple-600">Platform Statistics</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
        <div class="bg-gray-800 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-2 text-white">Total Courses</h2>
            <p class="text-3xl font-bold text-blue-500"><?= count($courses) ?></p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="bg-gray-800 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-white">Course Category Distribution</h2>
            <ul class="space-y-4">
                <?php foreach ($CategoryCours as $CatCours):?>
                <li class="flex justify-between items-center text-white">
                    <span class="font-medium"><?= $CatCours["category_name"] ?></span>
                    <span class="text-blue-500 font-bold"><?= $CatCours["courses_count"] ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="bg-gray-800 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-white">Top Performing Courses</h2>
            <ul class="space-y-4">
                <?php foreach ($topCourses as $topCourse):?>
                <li class="flex justify-between items-center text-white">
                    <span class="font-medium"><?= $topCourse["title"] ?></span>
                    <span class="text-blue-500 font-bold"><?= $topCourse["enrollments_count"] ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="mt-10 bg-gray-800 rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-4 text-white">Top Performing Teachers</h2>
        <table class="w-full table-auto">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Teacher</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Courses</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Total Students</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                <?php foreach($TeacherStats as $Teacher):?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300"><?= $Teacher["teacher_name"]?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400"><?= $Teacher["courses_count"]?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400"><?= $Teacher["total_students"]?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>