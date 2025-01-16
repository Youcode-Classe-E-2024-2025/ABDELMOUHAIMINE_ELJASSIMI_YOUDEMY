<?php
include("header.php") ?>
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
