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

            <div class="w-full h-64 bg-gray-600 rounded-md flex items-center justify-center">
                <span class="text-gray-400">Pie Chart Placeholder</span>
            </div>
        </div>

        <div class="bg-gray-800 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-white">Top Performing Courses</h2>
            <ul class="space-y-4">
                <li class="flex justify-between items-center text-white">
                    <span class="font-medium">Advanced JavaScript Concepts</span>
                    <span class="text-blue-500 font-bold">1,234 students</span>
                </li>
                <li class="flex justify-between items-center text-white">
                    <span class="font-medium">Python for Data Science</span>
                    <span class="text-blue-500 font-bold">987 students</span>
                </li>

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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Average Rating</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">Jane Smith</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">5</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">3,456</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">4.8</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>