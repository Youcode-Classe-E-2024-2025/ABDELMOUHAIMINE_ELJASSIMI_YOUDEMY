<?php 
if(empty($_SESSION['user_id'])){
    header("location:?action=login");
    exit;
}

if($_SESSION['user_status'] == 'suspended' ){
    header("location: index.php?action=suspended");
    exit;
}else if($_SESSION['user_status'] == 'deleted'){
    header("location: index.php?action=deleted");
    exit;
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : 'visiteur'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Navigation</title>
    <script src="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/dist/boxicons.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
</head>
<body class="bg-gray-800">

<header class="bg-gray-800 shadow-lg sticky top-0 z-50">
    <nav class="w-full">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="index.php" class="text-3xl font-bold text-white hover:opacity-90 transition duration-300">
                Youdemy
            </a>

            <!-- Mobile Menu Button -->
            <button 
                class="block text-white lg:hidden focus:outline-none" 
                id="menu-btn"
                onclick="toggleMenu()"
            >
                <box-icon name="menu" class="text-white" size="md"></box-icon>
            </button>

            <!-- Navigation Links -->
            <ul class="hidden lg:flex space-x-6 items-center" id="menu">
                <li><a href="?action=home" class="text-white hover:text-purple-400 transition">Catalogue</a></li>
                <?php if ($role === 'visiteur'): ?>
                    <li><a href="index.php?action=login" class="text-white hover:text-purple-400 transition">Login</a></li>
                <?php elseif ($role === 'student'): ?>
                    <li><a href="index.php?action=mesCours" class="text-white hover:text-purple-400 transition">Mes Cours</a></li>
                    <li><a href="profile.php" class="text-white hover:text-purple-400 transition">Profil</a></li>
                <?php elseif ($role === 'teacher'): ?>
                    <li><a href="index.php?action=addCourse" class="text-white hover:text-purple-400 transition">Ajouter un cours</a></li>
                    <li><a href="index.php?action=manageCourses" class="text-white hover:text-purple-400 transition">Gérer mes cours</a></li>
                    <li><a href="index.php?action=TeacherStats" class="text-white hover:text-purple-400 transition">Statistiques</a></li>
                <?php elseif ($role === 'admin'): ?>
                    <li><a href="index.php?action=manageUsers" class="text-white hover:text-purple-400 transition">Gérer utilisateurs</a></li>
                    <li><a href="index.php?action=manageContent" class="text-white hover:text-purple-400 transition">Gérer contenu</a></li>
                    <li><a href="index.php?action=adminstats" class="text-white hover:text-purple-400 transition">Statistiques globales</a></li>
                <?php endif; ?>
                <?php if ($role !== 'visiteur'): ?>
                    <li><a href="?action=logout" class="text-red-400 hover:text-red-600 transition">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Mobile Dropdown Menu -->
        <ul class="lg:hidden hidden flex-col space-y-4 bg-gray-700 p-4 w-full" id="mobile-menu">
            <li><a href="?action=home" class="text-white hover:text-purple-400 transition">Catalogue</a></li>
            <?php if ($role === 'visiteur'): ?>
                <li><a href="index.php?action=login" class="text-white hover:text-purple-400 transition">Login</a></li>
            <?php elseif ($role === 'student'): ?>
                <li><a href="index.php?action=mesCours" class="text-white hover:text-purple-400 transition">Mes Cours</a></li>
                <li><a href="profile.php" class="text-white hover:text-purple-400 transition">Profil</a></li>
            <?php elseif ($role === 'teacher'): ?>
                <li><a href="index.php?action=addCourse" class="text-white hover:text-purple-400 transition">Ajouter un cours</a></li>
                <li><a href="index.php?action=manageCourses" class="text-white hover:text-purple-400 transition">Gérer mes cours</a></li>
                <li><a href="index.php?action=TeacherStats" class="text-white hover:text-purple-400 transition">Statistiques</a></li>
            <?php elseif ($role === 'admin'): ?>
                <li><a href="index.php?action=manageUsers" class="text-white hover:text-purple-400 transition">Gérer utilisateurs</a></li>
                <li><a href="index.php?action=manageContent" class="text-white hover:text-purple-400 transition">Gérer contenu</a></li>
                <li><a href="index.php?action=adminstats" class="text-white hover:text-purple-400 transition">Statistiques globales</a></li>
            <?php endif; ?>
            <?php if ($role !== 'visiteur'): ?>
                <li><a href="?action=logout" class="text-red-400 hover:text-red-600 transition">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<div class="certificat">
    <div class="certificate bg-white w-full max-w-4xl shadow-2xl rounded-lg overflow-hidden mx-auto mt-10 relative">
        <div class="absolute inset-0 bg-purple-600 opacity-10 z-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="none" stroke="currentColor" stroke-width="4" vector-effect="non-scaling-stroke"></path>
                <path d="M0,0 C25,50 75,50 100,100" fill="none" stroke="currentColor" stroke-width="2" vector-effect="non-scaling-stroke"></path>
                <path d="M0,100 C25,50 75,50 100,0" fill="none" stroke="currentColor" stroke-width="2" vector-effect="non-scaling-stroke"></path>
            </svg>
        </div>
        
        <div class="relative z-10 p-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-purple-600 mb-2 font-serif">Certificat de Complétion</h1>
                <p class="text-2xl text-gray-800">Youdemy</p>
            </div>
            
            <div class="text-gray-800 text-center mb-8">
                <p class="text-xl mb-4">Ce certificat est fièrement décerné à</p>
                <h2 id="nomEtudiant" class="text-5xl font-bold mb-6 text-purple-600 font-serif"><?= $Cours["student_name"]?></h2>
                <p class="text-xl mb-4">pour avoir brillamment complété le cours</p>
                <h3 id="nomCours" class="text-3xl font-semibold mb-6"><?= $Cours["title"]?></h3>
                <p class="text-xl">Date de début : <span id="dateDebut" class="font-semibold"><?= $Cours["enrolled_at"]?></span></p>
            </div>
            
            <div class="flex justify-between items-center mt-12">
                <div class="w-32 h-32 rounded-full bg-purple-600 flex items-center justify-center transform rotate-12 shadow-lg">
                    <span class="text-white text-4xl font-bold font-serif">YD</span>
                </div>
            </div>
            
            <div class="absolute top-4 left-4 w-16 h-16 border-t-4 border-l-4 border-purple-600 opacity-50"></div>
            <div class="absolute bottom-4 right-4 w-16 h-16 border-b-4 border-r-4 border-purple-600 opacity-50"></div>
        </div>
    </div>
</div>
    
<div class="text-center mt-4">
    <button onclick="generatePDF()" class="bg-purple-600 text-white px-6 py-2 rounded-lg shadow hover:bg-purple-700">
        Générer le PDF
    </button>
</div>

<script>
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }

    function generatePDF() {
        const element = document.querySelector('.certificate');
        const opt = {
            filename:     'certificate.pdf',
            image:        { type: 'jpeg', quality: 1 },
            html2canvas:  { dpi: 192, letterRendering: true },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf(element, opt);
    }
</script>

</body>
</html>
