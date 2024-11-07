<?php require BASEPATH('views/partials/head.php'); ?>
<?php require BASEPATH('views/partials/navbar.php'); ?>
<?php require BASEPATH('views/partials/banner.php'); ?>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-center mb-6 text-gray-800">Our Products</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-xl">
                            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['full-name']) ?>" class="w-full h-56 object-cover">

                            <div class="p-6">
                                <h2 class="text-2xl font-semibold text-gray-800 hover:text-blue-600"><?= htmlspecialchars($product['full-name']) ?></h2>
                                <p class="text-gray-600 mt-2"><?= htmlspecialchars($product['description']) ?></p>
                                <p class="text-lg font-bold text-green-600 mt-4"><?= htmlspecialchars($product['price']) ?></p>

                                <a href="/product/<?= $product['id'] ?>" class="mt-6 inline-block text-center bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition duration-300">View Details</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="col-span-4 text-center text-gray-600">No Products Available</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

<?php require BASEPATH('views/partials/footer.php'); ?>