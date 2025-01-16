<?php
include("header.php"); ?>
<?php  foreach($courses as $course):?>
<section class="bg-gradient-to-r from-gray-800 to-gray-900 py-16">
    <div class="container mx-auto px-6">
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-white mb-4"><?= $course["title"] ?></h1>
            <p class="text-gray-400 mb-4"><?= $course["title"] ?></p>
            <div class="flex items-center space-x-4">
                <img src="<?= $course["thumbnail"] ?>" alt="Teacher" class="w-12 h-12 rounded-full">
                <span class="text-gray-300">Taught by <strong class="text-white">John Doe</strong></span>
            </div>
        </div>
        

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Course Content -->
            <div class="lg:col-span-2">
                <!-- Video -->
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-white mb-4">Course Video</h2>
                    <video controls class="w-full rounded-lg">
                        <source src="<?= $course["video_path"] ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <!-- Description -->
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-white mb-4">Course Description</h2>
                    <p class="text-gray-300 leading-relaxed"><?= $course["description"] ?></p>
                </div>

                <!-- Document -->
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">Downloadable Resources</h2>
                    <div class="bg-gray-700 p-4 rounded-lg shadow-md">
                        <p class="text-gray-300">Get additional materials to enhance your learning:</p>
                        <a href="<?= $course["document_path"] ?>" download 
                           class="mt-4 inline-block bg-purple-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-purple-700 transition duration-300">
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Course Info -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                    <h3 class="text-2xl font-bold text-white mb-4">Course Info</h3>
                    <ul class="space-y-3">
                        <li class="text-gray-300">
                            <strong class="text-white">Duration:</strong> 10 hours
                        </li>
                        <li class="text-gray-300">
                            <strong class="text-white">Level:</strong> Beginner
                        </li>
                        <li class="text-gray-300">
                            <strong class="text-white">Language:</strong> English
                        </li>
                        <li class="text-gray-300">
                            <strong class="text-white">Last Updated:</strong> January 2025
                        </li>
                    </ul>
                </div>
                <h2 class="text-2xl font-semibold mt-6 mb-6 text-white">Tags</h2>
                    <div class="flex flex-wrap gap-3 mb-6">
                        <?php foreach($tags as $tag): ?>
                        <span class="bg-purple-600 text-white px-4 py-2 rounded-full text-sm font-medium"><?= $tag["name"] ?></span>
                        <?php endforeach; ?>
                    </div>

                <?php if($_SESSION['user_role'] == 'student'): ?>
                <div class="mt-8">
                    <?php if($enrolled):?>
                        <a href="index.php?action=mesCours" class="w-full inline-block bg-purple-600 text-white text-center py-3 px-6 rounded-full shadow-lg hover:bg-purple-700 transition duration-300" >already rolled click to check your courses</a>
                        <?php else: ?>
                    <form action="index.php?action=enroll" method="POST">
                        <input type="hidden" name="id" value="<?=$course["id"]?>">
                        <button class="w-full inline-block bg-purple-600 text-white text-center py-3 px-6 rounded-full shadow-lg hover:bg-purple-700 transition duration-300" type="submit">Enroll Now</button>
                    </form>
                </div>
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php  endforeach; ?>

<?php include("footer.php") ?>
</body>
</html>
