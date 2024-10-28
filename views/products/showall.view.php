<?php require BASEPATH('views/partials/head.php') ?>
<?php require BASEPATH('views/partials/navbar.php') ?>
<?php require BASEPATH('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">جميع المنتجات</h1>

        <p class="mb-6">
            <a href="/products" class="text-blue-500 underline">عودة إلى المنتجات...</a>
        </p>

        <table class="min-w-full">
            <thead>
            <tr>
                <th class="px-4 py-2">name</th>
                <th class="px-4 py-2">Price</th>

            </tr>
            </thead>
            <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= htmlspecialchars($product['full_name']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($product['price']) ?> </td>



                        <td class="border px-4 py-2">
                            <a href="/products/show?id=<?= $product['id'] ?>" class="text-blue-500 underline">
                                <?= htmlspecialchars($product['full_name']) ?>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="border px-4 py-2 text-center">NO PRODUCTS</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require BASEPATH('views/partials/footer.php') ?>
