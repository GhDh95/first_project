<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>


<div class="flex px-20 py-10 justify-center space-x-2">
    <p class="text-center text-2xl">Upload product</p>
    <a class="pt-1" href="/app/admin_profile">
        <span class="material-symbols-outlined">
            settings
        </span>
    </a>
</div>


<div class="flex justify-center py-16  bg-slate-100 ">

    <form action="<?php echo $_GET['path']; ?>" method="POST" class="flex flex-col  w-1/2 max-w-2xl space-y-2">
        <div>

            <label class="text-sm" for="product_name">Product name</label>
            <br>
            <input type="text" name="product_name" id="product_name" placeholder="Product name" class="border <?= !empty($prod_name_err) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2">
            <p class="text-xs text-red-500 h-2"><?= $prod_name_err ?></p>
        </div>
        <div>

            <label class="text-sm" for="product_category">Product category</label>
            <br>
            <select name="product_category" id="product_category" class="bg-white border <?= !empty($prod_categ_err) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2">
                <option value="" hidden>Choose category</option>
                <option value="Watch">Watch</option>
                <option value="Wallet">Wallet</option>
                <option value="Jewelry">Jewelry</option>
            </select>

            <p class="text-xs text-red-500 h-2"><?= $prod_categ_err ?></p>
        </div>
        <div>

            <label class="text-sm" for="product_price">Product price</label>
            <br>
            <input type="text" name="product_price" id="product_price" placeholder="Product price" class="border <?= !empty($prod_price_err) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2">
            <p class="text-xs text-red-500 h-2"><?= $prod_price_err ?></p>
        </div>
        <div>

            <label class="text-sm" for="product_quantity">Product quantity</label>
            <br>
            <input type="text" name="product_quantity" id="product_quantity" placeholder="Product quantity" class="border <?= !empty($prod_qty_err) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2">
            <p class="text-xs text-red-500 h-2"><?= $prod_qty_err ?></p>

        </div>

        <div>

            <label class="text-sm" for="product_description">Product description</label>
            <br>
            <textarea name="product_description" id="prdocut_description" rows="5" placeholder="Product description" class=" border <?= !empty($prod_desc_err) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full  focus:outline-none px-2"></textarea>
            <p class="text-xs text-red-500 h-2 pb-10 md:pb-5"><?= $prod_desc_err ?></p>
        </div>

        <input type="submit" value="Add Product" class="border border-black cursor-pointer h-10 bg-black text-white hover:opacity-75">
        <p class="text-green-500 "><?= $Product_added_Succesfully ?></p>

    </form>
</div>










<?php require(__DIR__ . "\\partials\\footer.php"); ?>