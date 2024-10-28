<?php require BASEPATH('views/partials/head.php') ?>
<?php require BASEPATH('views/partials/navbar.php') ?>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6"><?= htmlspecialchars($product['full_name']) ?></h1>

            <p class="mb-4"><strong>Price:</strong> <?= htmlspecialchars($product['price']) ?></p>
            <p class="mb-4"><strong>Description:</strong> <?= htmlspecialchars($product['description'] ?? 'No description available.') ?></p>

            <a href="/" class="text-blue-500 underline">Back to products</a>
        </div>
    </main>

<?php require BASEPATH('views/partials/footer.php') ?>