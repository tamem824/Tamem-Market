<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/" class="<?= CheckUrl('/') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        <a href="/about" class="<?= CheckUrl('/about') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">About</a>
                        <a href="/products/show" class="<?= CheckUrl('/products') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Products</a>
                        <?php if (isset($_SESSION['user-id'])): ?>
                            <a href="/my-products" class="<?= CheckUrl('/my-products') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">My Products</a>
                            <!-- Update Profile Button -->
                            <a href="/update-profile" class="<?= CheckUrl('/update-profile') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Update Profile</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <?php if (isset($_SESSION['user-id'])): ?>
                        <form method="POST" action="/logout" aria-label="Logout">
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button class="text-white px-3 py-2 rounded-md text-sm font-medium">Log Out</button>
                        </form>
                    <?php else: ?>
                        <a href="/register" class="<?= CheckUrl('/register') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                        <a href="/login" class="<?= CheckUrl('/login') ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 px-3 py-2 rounded-md text-sm font-medium">Log In</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>
