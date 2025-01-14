<?php
include("header.php");
?>
    <section class="bg-gradient-to-r from-gray-800 to-gray-900 py-16">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-6 text-white">Find Your Perfect Course</h2>
                <p class="text-gray-400 mb-10">Explore thousands of courses in technology, business, design, and more.</p>
                <div class="flex justify-center">
                    <input type="text" placeholder="Search for courses..." 
                           class="w-full max-w-lg px-6 py-3 rounded-l-full bg-gray-700 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <button class="bg-purple-600 text-white px-6 py-3 rounded-r-full shadow-md hover:bg-purple-700 hover:shadow-lg transition duration-300">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </section>
    <main class="container mx-auto px-6 py-16">
        <h1 class="text-4xl font-bold mb-10 text-white text-center">Featured Courses</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php  foreach ($courses as $course): ?>
            <div class="bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl overflow-hidden transform hover:scale-105 transition duration-300">
                <img src="<?= $course["thumbnail"]?>" alt="Course Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-4 text-white"><?= $course["title"]?></h2>
                    <p class="text-gray-400 mb-6"><?= $course["description"]?></p>
                    <div class="flex justify-between items-center">
                        <span class="text-purple-400 font-bold text-xl">$49.99</span>
                        <a href="index.php?action=CourseDetails&id=<?= $course["id"]?>" class="bg-purple-600 text-white px-6 py-2 rounded-full shadow-md hover:bg-purple-700 hover:shadow-lg transition duration-300">View Details</a>
                    </div>
                </div>
            </div>
            <?php  endforeach; ?>
        </div>
        <div class="flex justify-center mt-16">
            <nav class="inline-flex rounded-full shadow-lg overflow-hidden">
                <a href="#" class="px-6 py-3 bg-gray-800 text-white hover:bg-purple-500 transition duration-300">Previous</a>
                <a href="#" class="px-6 py-3 bg-gray-800 text-white hover:bg-purple-500 transition duration-300">1</a>
                <a href="#" class="px-6 py-3 bg-purple-600 text-white font-bold">2</a>
                <a href="#" class="px-6 py-3 bg-gray-800 text-white hover:bg-purple-500 transition duration-300">3</a>
                <a href="#" class="px-6 py-3 bg-gray-800 text-white hover:bg-purple-500 transition duration-300">Next</a>
            </nav>
        </div>
    </main>
    <?php include("footer.php")?>
</body>
</html>
