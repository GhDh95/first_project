<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>


<div class="">
    <div class="flex px-20 py-10 justify-center space-x-2">
        <p class="text-center text-2xl">Update product</p>
        <a class="pt-1" href="/app/admin_profile">
            <span class="material-symbols-outlined">
                settings
            </span>
        </a>
    </div>
    <div class=" bg-slate-100 ">
        <form action="<?php echo $_GET['path']; ?>" method="POST" class="">

            <div class=" grid grid-cols-1  md:grid md:grid-cols-8 space-y-2 md:space-y-0 md:ml-28 md:py-20 p-5">

                <input class="border border-black border-black hover:ring-1 hover:ring-black focus:outline-none px-0 md:px-2 truncate" type="text" name="product_id" id="" placeholder="product id">
                <input class="border border-black border-black hover:ring-1 hover:ring-black focus:outline-none px-0 md:px-2 truncate" type="text" name="product_name" id="" placeholder="product name">
                <select class="border border-black bg-white border-black hover:ring-1 hover:ring-black focus:outline-none px-0 md:px-2 truncate" name="product_category" id="">
                    <option value="" selected="true" disabled="disabled">Category</option>
                    <option value="Watch">Watch</option>
                    <option value="Wallet">Wallet</option>
                    <option value="Jewlry">Jewelry</option>
                </select>
                <input class="border border-black border-black hover:ring-1 hover:ring-black focus:outline-none px-0 md:px-2 truncate" type="text" name="product_price" id="" placeholder="product price">
                <input class="border border-black border-black hover:ring-1 hover:ring-black focus:outline-none px-0 md:px-2 truncate" type="text" name="product_quantity" id="" placeholder="product quantity">
                <input class="border border-black border-black hover:ring-1 hover:ring-black focus:outline-none px-0 md:px-2 truncate" type="text" name="product_description" id="" placeholder="product description">
                <input class="border border-black cursor-pointer hover:ring-1 hover:ring-black bg-black text-white hover:opacity-75 text-center px-0 md:px-2 truncate" type="submit" value="Update" name="update_prod">
                <button type="submit" name="delete_prod" class="pt-0 md:pt-2 px-0 md:px-2 md:w-fit">
                    <span class="material-symbols-outlined">
                        close
                    </span>
                </button>

            </div>




        </form>
        <p class="text-center text-red-600"><?= $update_info ?></p>
    </div>

    <div class="overflow-auto px-20 py-28 h-56 grid grid-cols-1 md:grid-cols-6 border border-black ">
        <p class="text-center py-3 font-semibold hidden md:block">Product id</p>
        <p class="text-center py-3 font-semibold hidden md:block">Product name</p>
        <p class="text-center py-3 font-semibold hidden md:block">Product category</p>
        <p class="text-center py-3 font-semibold hidden md:block">Product price</p>
        <p class="text-center py-3 font-semibold hidden md:block">Product quantity</p>
        <p class="text-center py-3 font-semibold hidden md:block">Product description</p>
        <?php foreach (array_reverse($products) as $product) : ?>
            <p class="border border-black text-center mb-2 text-teal-300 font-semibold "><?= $product['product_id'] ?></p>
            <p class="border border-black text-center mb-2 "><?= $product['product_name'] ?></p>
            <p class="border border-black text-center mb-2 "><?= $product['product_category'] ?></p>
            <p class="border border-black text-center mb-2 "><?= $product['product_price'] ?></p>
            <p class="border border-black text-center mb-2 "><?= $product['product_quantity'] ?></p>
            <p class="border border-black text-center mb-2 truncate md:py-0 py-5 "><?= $product['product_description'] ?></p>
        <?php endforeach; ?>
    </div>


</div>










<?php require(__DIR__ . "\\partials\\footer.php"); ?>