<?php include(dirname(__FILE__) . "\\partials\\header.php"); ?>

<?php include(dirname(__FILE__) . "\\partials\\navigation.php"); ?>


<p class="text-2xl text-center p-20">Admin Page</p>
<div class="p-20 bg-slate-50 border border-black flex flex-col items-center md:space-y-3 md:items-start ">
    <div class="">
        <a href="/app/controllers/product_upload.php">
            <div class="flex space-x-2">

                <p>
                    Upload Products
                </p>
                <span class="material-symbols-outlined">
                    upload
                </span>
            </div>
        </a>
    </div>

    <div class="">
        <a href="/app/controllers/product_update.php">
            <div class="flex space-x-2">

                <p>
                    Update Products
                </p>
                <span class="material-symbols-outlined">
                    update
                </span>
            </div>
        </a>
    </div>
    <div class="">
        <a href="/app/controllers/image_upload.php">
            <div class="flex space-x-2">

                <p>
                    Upload Product images
                </p>
                <span class="material-symbols-outlined">
                    image
                </span>
            </div>
        </a>
    </div>
    <div class="">
        <a href="/app/controllers/image_update.php">
            <div class="flex space-x-2">

                <p>
                    Update Product images
                </p>
                <span class="material-symbols-outlined">
                    tune
                </span>
            </div>
        </a>
    </div>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" class="flex space-x-2">



        <button type="submit" name="newsletter" class="hover:pointer text-[16px]">Send Newsletter</button>
        <span class="material-symbols-outlined">
            share
        </span>
    </form>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" class="">



        <button type="submit" name="log_out" class="border border-black  cursor-pointer hover:opacity-75 px-5 mt-3">Log out</button>

    </form>
</div>





<?php include(dirname(__FILE__) . "\\partials\\footer.php"); ?>