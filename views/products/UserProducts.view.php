<?php require BASEPATH('views/partials/head.php') ?>
<?php require BASEPATH('views/partials/navbar.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="/products/create" class="inline-block px-4 py-2 bg-green-500 text-white font-bold rounded hover:bg-green-600">+ Add New Product</a>
        </div>

        <?php if ($products): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($products as $product): ?>
                    <div class="p-6 border rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <?php if (!empty($product['image_path'])): ?>
                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="Product Image" class="w-full h-48 object-cover rounded mb-4">
                        <?php endif; ?>
                        <h1 class="text-2xl font-bold mb-2"><?= htmlspecialchars($product['full_name']) ?></h1>
                        <p class="mb-2 text-lg"><strong>Price:</strong> <?= htmlspecialchars($product['price']) ?></p>
                        <p class="mb-4 text-gray-700"><strong>Description:</strong> <?= htmlspecialchars($product['description'] ?? 'No description available.') ?></p>
                        <div class="flex space-x-4">
                            <a href="/products/update?id=<?= $product['id'] ?>" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">Edit</a>
                            <a href="/products/show?id=<?= $product['id'] ?>" class="px-4 py-2 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600">View Details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">No products available.</p>
        <?php endif; ?>

        <div class="mt-6">
            <a href="/home" class="text-blue-500 underline hover:text-blue-700">Back to Home</a>
        </div>
    </div>
</main>

<?php require BASEPATH('views/partials/footer.php') ?>
