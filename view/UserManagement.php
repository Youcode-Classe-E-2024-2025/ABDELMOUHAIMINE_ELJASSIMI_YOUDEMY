<?php
include("header.php") ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center text-purple-600">User Management</h1>
    

    <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-900 text-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-gray-800 divide-y divide-gray-600">
                <?php foreach($users as $user): ?>
                <tr class="hover:bg-gray-700 transition duration-300">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-100"><?= $user["username"] ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-400"><?= $user["email"] ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-400"><?= $user["role"] ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                         <?= $user["status"] ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-green-500 hover:text-green-700 transition duration-300 mr-3">Active</button>
                        <button class="text-yellow-500 hover:text-yellow-700 transition duration-300 mr-3">Suspend</button>
                        <button class="text-red-500 hover:text-red-700 transition duration-300">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
