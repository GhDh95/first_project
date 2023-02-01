<?php include(dirname(__FILE__) . "\\partials\\header.php"); ?>

<?php include(dirname(__FILE__) . "\\partials\\navigation.php"); ?>


<p class="text-2xl text-center p-20">Admin Page</p>
<div class="p-20 bg-slate-50 border border-black flex flex-col items-center md:space-y-3 md:items-start ">
    <div class="">
        <a href="/app/product_upload">
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
        <a href="/app/product_update">
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
        <a href="/app/image_upload">
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
        <a href="/app/image_update">
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
    <form action="<?php echo $_GET['path']; ?>" method="POST" class="flex space-x-2">



        <button x-data="{
            remove_msg(){
                if(document.getElementById('err_msg').innerText !== null){

                    setTimeout(() => {
                        document.getElementById('err_msg').innerText = '';
                }, 3000);
                }
            }
        }" type="submit" name="newsletter" class="hover:pointer text-[16px]" x-init="remove_msg()">Send Newsletter</button>
        <span class="material-symbols-outlined">
            share
        </span>
    </form>
    <form action="<?php echo $_GET['path']; ?>" method="POST" class="">



        <button type="submit" name="log_out" class="border border-black  cursor-pointer hover:opacity-75 px-5 mt-3">Log out</button>

    </form>
</div>

<p id="err_msg" class="text-semibold text-green-500 text-center text-2xl py-10"><?= $msg ?></p>



<?php include(dirname(__FILE__) . "\\partials\\footer.php"); ?>