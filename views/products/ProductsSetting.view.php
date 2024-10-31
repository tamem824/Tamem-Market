<?php require BASEPATH('views/partials/head.php') ?>
<?php require BASEPATH('views/partials/navbar.php') ?>

<main>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                     alt="Your Company">
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">update your products</h2>
            </div>

            <form class="mt-8 space-y-6" action="/products/update" method="POST">
                <div class="-space-y-px rounded-md shadow-sm">

                    <div>
                        <label for="id" class="sr-only"></label>
                        <input id="id" name="id" type="hidden" value="<?= $product['id'] ?>"
                               class="relative block w-full appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               >
                    </div>
                    <div>
                        <label for="name" class="sr-only">name</label>
                        <input id="name" name="name" type="text" value="<?= $product['name'] ?>" required
                               class="relative block w-full appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="enter a new name">
                    </div>

                    <div>
                        <label for="description" class="sr-only">description</label>
                        <input id="description" name="description" type="text" value="<?=$product['description'] ?>" required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Enter a new description">
                    </div>
                    <div>
                        <label for="price" class="sr-only">price</label>
                        <input id="price" name="price" type="text" value="<?=$product['price'] ?>" required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                               placeholder="Enter a new description">
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Login
                    </button>
                </div>


            </form>
        </div>
    </div>
</main>

<?php require BASEPATH('views/partials/footer.php') ?>
