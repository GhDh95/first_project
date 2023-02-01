<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>


<div class="flex flex-col items-center p-20 space-y-14">
    <div class="flex px-20 py-10 justify-center space-x-2">
        <p class="text-center text-2xl">Upload Image</p>
        <a class="pt-1" href="/app/admin_profile">
            <span class="material-symbols-outlined">
                settings
            </span>
        </a>
    </div>

    <form action="<?php echo $_GET['path']; ?>" method="POST" class=" grid grid-cols-1 gap-y-2 md:grid md:grid-cols-5 md:justify-items-center md:items-center bg-slate-50 md:py-20 py-20 px-2">
        <label for="product_id">Product id</label>
        <div class="flex flex-col space-y-2">
            <input type="text" name="product_id" id="product_id" placeholder="product id" class="border border-black hover:ring-1 hover:ring-black h-10  focus:outline-none px-2">
            <p class="text-xs text-red-500"><?= $prod_id_err; ?></p>
        </div>
        <label for="image_path">Image path</label>
        <div class="flex flex-col space-y-2">
            <input class="truncate border border-black hover:ring-1 hover:ring-black h-10  focus:outline-none px-2" type="text" name="image_path" id="image_path" placeholder="ex: \\webshop\\app\\product_images\\category\\name.type">
            <p class="text-xs text-red-500"><?= $image_path_err; ?></p>
        </div>
        <button type="submit" class="border border-black hover:ring-1 hover:ring-black focus:outline-none px-2 w-fit place-self-center" name="upload_image">
            <span class="material-symbols-outlined mt-2">
                add
            </span>
        </button>
    </form>
    <p class="text-red-500 font-semibold"><?= $upload_failed_err; ?></p>
</div>





<?php require(__DIR__ . "\\partials\\footer.php"); ?>