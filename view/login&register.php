<?php include("header.php") ?>
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md text-gray-300">
        <h1 id="auth-title" class="text-2xl font-bold mb-6 text-center text-purple-400">Log in to Your Account</h1>
        <form id="login-form" action="?action=logincheck" method="POST">
            <div class="mb-4">
                <label for="login-email" class="block text-gray-400 font-semibold mb-2">Email Address</label>
                <input  type="email" id="login-email"  name="email" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-400 text-gray-200"  required >
            </div>
            <div class="mb-4">
                <label for="login-password" class="block text-gray-400 font-semibold mb-2">Password</label>
                 <input  type="password"  id="login-password"  name="password"  class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-400 text-gray-200"  required >
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" id="remember" name="remember" class="mr-2 bg-gray-700 focus:ring-purple-400">
                <label for="remember" class="text-gray-300">Remember Me</label>
            </div>

            <button 
                type="submit" class="w-full bg-purple-500 text-white py-2 px-4 rounded-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-gray-800">
                Log In
            </button>

            <p class="mt-4 text-center text-gray-400">
                Don't have an account? 
                <a href="#" class="text-purple-400 hover:underline" id="switch-to-register">Sign up now</a>.
            </p>
        </form>

        <!-- Register Form -->
        <form id="register-form" action="?action=register" method="POST" class="hidden">
            <div class="mb-4">
                <label for="register-name" class="block text-gray-400 font-semibold mb-2">Full Name</label>
                <input type="text" id="register-name" name="name" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-400 text-gray-200"  required>
            </div>

            <div class="mb-4">
                <label for="register-email" class="block text-gray-400 font-semibold mb-2">Email Address</label>
                <input type="email" id="register-email" name="email" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-400 text-gray-200" required>
            </div>
            

            <div class="mb-4">
                <label for="register-password" class="block text-gray-400 font-semibold mb-2">Password</label>
                <input type="password" id="register-password" name="password"  class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-400 text-gray-200"  required>
            </div>

            <div class="mb-6">
                <label for="role" class="block text-gray-400 font-semibold mb-2">Select Role</label>
                <select  id="role"  name="role"  class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-400 text-gray-200"   required >
                    <option value="" disabled selected>Select your role</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
            </div>
            <button  type="submit" class="w-full bg-purple-500 text-white py-2 px-4 rounded-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-gray-800" >
                Create Account
            </button>
            <p class="mt-4 text-center text-gray-400">
                Already have an account? 
                <a href="#" class="text-purple-400 hover:underline" id="switch-to-login">Log in</a>.
            </p>
        </form>
    </div>
</div>
<script>
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const authTitle = document.getElementById("auth-title");

    document.getElementById("switch-to-register").addEventListener("click", (e) => {
        e.preventDefault();
        loginForm.classList.add("hidden");
        registerForm.classList.remove("hidden");
        authTitle.textContent = "Create Your Account";
    });

    document.getElementById("switch-to-login").addEventListener("click", (e) => {
        e.preventDefault();
        registerForm.classList.add("hidden");
        loginForm.classList.remove("hidden");
        authTitle.textContent = "Log in to Your Account";
    });
</script>
</body>
</html>
