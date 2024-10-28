<?php require BASEPATH('views/partials/head.php'); ?>
<?php require BASEPATH('views/partials/navbar.php'); ?>
<?php require BASEPATH('views/partials/banner.php'); ?>


<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">our products</h1>



        <table class="min-w-full">
            <thead>
            <tr>
                <th class="px-4 py-2">name</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">description</th>

            </tr>
            </thead>
            <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= htmlspecialchars($product['full-name']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($product['price']) ?> </td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($product['description']) ?> </td>



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


<?php require BASEPATH('views/partials/footer.php'); ?>
