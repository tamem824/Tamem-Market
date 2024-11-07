<?php
http_response_code(404);
require('partials/head.php');
?>
<?php require('partials/navbar.php'); ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-4">Oops! Page Not Found.</h1>
        <p class="text-gray-600 text-lg">The page you are looking for doesn't exist or has been moved.</p>

        <div class="mt-6">
            <a href="/" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                Go Back Home
            </a>
        </div>
    </div>
</main>

<?php require('partials/footer.php'); ?>
