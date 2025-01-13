<?php
  if(empty($_SESSION['user_id'])){
    header("location:?action=login");
      exit;
  }
include("header.php"); ?>

<header class="bg-gradient-to-r from-purple-700 via-purple-600 to-purple-500 shadow-lg">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="#" class="text-3xl font-extrabold text-white hover:opacity-90 transition duration-300">Youdemy</a>
        <div class="space-x-4">
            <?php if(empty($_SESSION['user_id'])):?>
            <a href="?action=login" class="bg-white text-purple-600 text-lg px-5 py-2 rounded-full shadow-lg hover:bg-purple-100 transition duration-300">Login</a>
            <?php endif; ?>
        </div>
    </nav>
</header>


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

                <!-- Enroll Button -->
                <div class="mt-8">
                    <a href="enroll.php" 
                       class="w-full inline-block bg-purple-600 text-white text-center py-3 px-6 rounded-full shadow-lg hover:bg-purple-700 transition duration-300">
                        Enroll Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php  endforeach; ?>

<?php include("footer.php") ?>
</body>
</html>
