<?php
        if(empty($_SESSION['user_id'])){
            header("location:?action=login");
            exit;
        }
include("header.php") ?>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8 text-center text-purple-400">Add New Course</h1>
            <?php foreach ($courses as $course):?>
            <form action="?action=CourseEdit" method="POST" enctype="multipart/form-data" class="bg-gray-800 rounded-lg shadow-md p-6 text-gray-300 max-w-lg mx-auto">
                <div class="mb-4">
                    <label for="title" class="block text-gray-400 font-semibold mb-2">Course Title</label>
                    <input type="text" id="title" value="<?=$course["title"]?>" name="title" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-400 font-semibold mb-2">Course Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md" required><?=$course["description"]?></textarea>
                </div>
                <div class="mb-4">
                    <label for="category" class="block text-gray-400 font-semibold mb-2">Category</label>
                    <select id="category" name="category" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="tags" class="block text-gray-400 font-semibold mb-2">Tags</label>
                    <select id="tags" name="tags[]" multiple class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md">
                        <?php foreach ($tags as $tag): ?>
                            <option value="<?= $tag['id'] ?>"><?= $tag['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="thumbnail" class="block text-gray-400 font-semibold mb-2">Upload Thumbnail</label>
                    <input type="file" id="thumbnail" name="thumbnail_file" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md" accept="image/jpeg, image/png">
                    </div>
                <div class="mb-4">
                    <label for="video_file" class="block text-gray-400 font-semibold mb-2">Upload Video</label>
                    <input type="file" id="video_file" name="video_file" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md" accept="video/mp4">
                </div>
                <div class="mb-4">
                    <label for="document_file" class="block text-gray-400 font-semibold mb-2">Upload Document</label>
                    <input type="file" id="document_file" name="document_file" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md" accept="application/pdf">
                </div>
                <input type="hidden" name="id" value="<?=$course["id"]?>">
                <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">
                    Edit Course
                </button>
            </form>
            <?php endforeach; ?>
        </div>
        <?php include("footer.php") ?>
</body>
</html>
