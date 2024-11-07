<?php require BASEPATH('views/partials/head.php') ?>
<?php require BASEPATH('views/partials/navbar.php') ?>

<main>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div class="text-center">
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">Update Your Product</h2>
            </div>

            <!-- Form for updating a product -->
            <form class="mt-8 space-y-6" action="/products/create" method="POST" enctype="multipart/form-data">
                <div class="-space-y-px rounded-md shadow-sm">
                    <!-- Hidden Input for Product ID -->
                    <input id="id" name="id" type="hidden" >

                    <!-- Product Name -->
                    <div>
                        <label for="name" class="sr-only">Product Name</label>
                        <input id="name" name="name" type="text" required
                               class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Enter a new name">
                    </div>

                    <!-- Product Description -->
                    <div>
                        <label for="description" class="sr-only">Product Description</label>
                        <input id="description" name="description" type="text" required
                               class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Enter a new description">
                    </div>

                    <!-- Product Price -->
                    <div>
                        <label for="price" class="sr-only">Product Price</label>
                        <input id="price" name="price" type="number" step="0.01" required
                               class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Enter a new price">
                    </div>

                    <!-- Product Image -->
                    <div>
                        <label for="image" class="sr-only">Product Image</label>
                        <input id="image" name="image" type="file" accept="image/*"
                               class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Upload an image">
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require BASEPATH('views/partials/footer.php') ?>
