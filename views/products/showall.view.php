<?php require BASEPATH('views/partials/head.php') ?>
<?php require BASEPATH('views/partials/navbar.php') ?>
<?php require BASEPATH('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">All Products</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="bg-white border rounded-lg shadow-lg overflow-hidden hover:scale-105 transform transition duration-300">
                        <?php if (!empty($product['image_url'])): ?>
                            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['full_name']) ?>" class="w-full h-56 object-cover">
                        <?php else: ?>
                            <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                        <?php endif; ?>

                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-gray-800 hover:text-indigo-600"><?= htmlspecialchars($product['full_name']) ?></h2>
                            <p class="text-gray-600 mt-2"><?= htmlspecialchars($product['description']) ?></p>
                            <p class="text-lg font-bold text-green-600 mt-4"><?= htmlspecialchars($product['price']) ?> USD</p>

                            <a href="/products/show?id=<?= $product['id'] ?>" class="mt-4 inline-block text-center bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">View Details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-span-4 text-center text-gray-600">No Products Available</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require BASEPATH('views/partials/footer.php') ?>
