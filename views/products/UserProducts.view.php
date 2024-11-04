<?php require BASEPATH('views/partials/head.php') ?>
<?php require BASEPATH('views/partials/navbar.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="/products/create" class="inline-block px-4 py-2 bg-green-500 text-white font-bold rounded hover:bg-green-600">+ Add New Product</a>
        </div>

        <?php if ($products): ?>
            <?php foreach ($products as $product): ?>
                <div class="mb-8 p-6 border rounded-lg shadow-sm">
                    <h1 class="text-2xl font-bold mb-4"><?= htmlspecialchars($product['full_name']) ?></h1>
                    <p class="mb-2"><strong>Price:</strong> <?= htmlspecialchars($product['price']) ?></p>
                    <p class="mb-4"><strong>Description:</strong> <?= htmlspecialchars($product['description'] ?? 'No description available.') ?></p>
                    <a href="/products/update?id=<?php echo $product['id']; ?>" class="text-blue-500 underline">EDIT</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500">No products available.</p>
        <?php endif; ?>

        <a href="/home" class="text-blue-500 underline">Back to products</a>
    </div>
</main>

<?php require BASEPATH('views/partials/footer.php') ?>
