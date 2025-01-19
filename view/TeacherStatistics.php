<?php
include("header.php") ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center text-purple-600">Course Statistics</h1>
    

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

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
            <h2 class="text-lg font-semibold text-gray-300 mb-2">Revenue</h2>
            <p class="text-4xl font-bold text-purple-500">$<?= $stats["total_revenue"] ?></p>
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
