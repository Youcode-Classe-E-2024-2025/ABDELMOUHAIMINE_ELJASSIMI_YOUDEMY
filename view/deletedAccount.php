<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Deleted</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-gray-800 to-gray-900 min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 rounded-xl shadow-lg p-8 max-w-md w-full mx-4">
        <h1 class="text-3xl font-bold mb-4 text-white text-center">Account Deleted</h1>
        <p class="text-gray-400 text-center mb-8">Your account has been deleted. If you believe this is an error, please contact our support team.</p>
        <div class="flex flex-col space-y-4">
            <a href="/contact-support" class="group relative inline-flex items-center justify-center px-6 py-3 overflow-hidden font-bold text-white rounded-lg shadow-2xl bg-gradient-to-br from-purple-600 to-blue-500 hover:from-purple-500 hover:to-blue-400 transition-all duration-300 ease-out">
                <span class="absolute inset-0 w-full h-full bg-gradient-to-br from-purple-600 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-out"></span>
                <span class="relative group-hover:scale-110 transition-transform duration-300">Contact Support</span>
            </a>
            <a href="index.php?action=login" class="group relative inline-flex items-center justify-center px-6 py-3 overflow-hidden font-bold text-white rounded-lg shadow-2xl bg-gradient-to-br from-teal-500 to-green-500 hover:from-teal-400 hover:to-green-400 transition-all duration-300 ease-out">
                <span class="absolute inset-0 w-full h-full bg-gradient-to-br from-teal-500 to-green-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-out"></span>
                <span class="relative group-hover:scale-110 transition-transform duration-300">Create Account</span>
            </a>
        </div>
    </div>
</body>
</html>