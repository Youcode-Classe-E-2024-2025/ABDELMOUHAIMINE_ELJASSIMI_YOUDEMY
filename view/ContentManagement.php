<?php
include("header.php") ?>
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-extrabold mb-8 text-center text-purple-600">Content Management</h1>

    <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden mb-8">
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
                        <div class="text-sm text-gray-400"><?= $course['enrolled_students'] ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-green-500 text-gray-900">
                        <?=$course['category_name']?>
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
    
    <!-- Grid Layout for Categories and Tags Management -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Categories Management -->
        <div class="bg-gray-800 rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-semibold mb-6 text-white">Categories</h2>
            <ul class="space-y-3">
                <?php foreach($categories as $categorie): ?>
                <li class="flex justify-between items-center">
                    <span class="text-gray-400"><?= $categorie["name"] ?></span>
                    <a href="index.php?action=deleteCategory&id=<?=$categorie["id"]?>" class="text-red-600 hover:text-red-800 transition duration-300 transform hover:scale-105">Delete</a>
                </li>
                <?php  endforeach ; ?>
                <!-- Add more categories -->
            </ul>
            <form action="index.php?action=createCategory" method="POST" class="mt-6 flex items-center space-x-4">
                <input type="text" name="categoryname" placeholder="New category" class="flex-grow px-4 py-3 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 transition duration-200">
                <button type="submit" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 transition duration-200">Add</button>
            </form>
        </div>

        <!-- Tags Management -->
        <div class="bg-gray-800 rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-semibold mb-6 text-white">Tags</h2>
            <div class="flex flex-wrap gap-3 mb-6">
                <?php foreach($tags as $tag): ?>
                <span class="bg-purple-600 text-white px-4 py-2 rounded-full text-sm font-medium"><?= $tag["name"] ?> <a href="index.php?action=DeleteTag&id=<?= $tag["id"]?>" class="font-extrabold text-gray-900 ml-4">X</a></span>
                <?php endforeach; ?>
            </div>
            <form action="index.php?action=CreateTag" method="POST" class="flex items-center space-x-4">
                <input type="text" name="tagname" placeholder="New tag" class="flex-grow px-4 py-3 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 transition duration-200">
                <button type="submit" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 transition duration-200">Add</button>
            </form>
        </div>
    </div>

    <!-- Bulk Tag Addition -->
    <div class="mt-12 bg-gray-800 rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-semibold mb-6 text-white">Bulk Tag Addition</h2>
        <form action="index.php?action=addBulkTag" method="POST">
            <div class="mb-6">
                <label for="courses" class="block text-gray-400 font-bold mb-3">Select Courses</label>
                <select id="courses" name="course" class="w-full px-4 py-3 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 transition duration-200">
                    <?php foreach($courses as $course): ?>
                    <option value="<?= $course["id"] ?>"><?= $course["title"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-6">
                <label for="tags" class="block text-gray-400 font-bold mb-3">Select Tags</label>
                <select id="tags" name="tags[]" multiple class="w-full px-4 py-3 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 transition duration-200">
                    <?php foreach($tags as $tag): ?>
                    <option value="<?= $tag["id"] ?>"><?= $tag["name"] ?></option>
                    <?php endforeach; ?>
                </select>           
            </div>
            <button type="submit" class="bg-purple-600 text-white py-3 px-6 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2 transition duration-200">
                Add Tags to Selected Courses
            </button>
        </form>
    </div>
</div>
</body>
</html>
