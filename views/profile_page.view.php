<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>
<div class="flex flex-col items-center space-y-20 pt-20">
    <p class="text-teal-600 pt-10 font-semibold text-xl md:text-2xl">Welcome back, <?= $_SESSION['username'] ?>.</p>
    <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-2 md:px-32 md:px-36 ">
        <a href="/app/account_settings">
            <div class=" border border-black bg-indigo-50 flex items-center justify-center  transition ease-in-out delay-150 md:hover:-translate-y-1 md:hover:translate-x-0 hover:translate-x-1 hover:-translate-y-1">


                <div class="flex items-center justify-center space-x-3 ">



                    <span class="material-symbols-outlined ">
                        manage_accounts
                    </span>



                    <p class="font-Montserrat">Personal details</p>

                </div>


            </div>
        </a>
        <a href="/app/rate">
            <div class=" border border-black bg-indigo-50 flex items-center justify-center   transition ease-in-out delay-150 md:hover:-translate-y-1 md:hover:translate-x-0 hover:translate-x-1 hover:-translate-y-1">

                <div class="flex items-center justify-center space-x-3    ">



                    <span class="material-symbols-outlined">
                        rate_review
                    </span>



                    <p>Rate product</p>

                </div>

            </div>
        </a>
        <a href="/app/orders">
            <div class=" border border-black bg-indigo-50 flex items-center justify-center   transition ease-in-out delay-150 md:hover:translate-y-1 md:hover:translate-x-0 hover:translate-x-1 hover:-translate-y-1">


                <div class="flex items-center justify-center space-x-3   ">



                    <span class="material-symbols-outlined">
                        receipt_long
                    </span>



                    <p>Orders</p>

                </div>


            </div>
        </a>
        <a href="">
            <div class=" border border-black bg-indigo-50 flex items-center justify-center  transition ease-in-out delay-150 md:hover:translate-y-1 md:hover:translate-x-0 hover:translate-x-1 hover:-translate-y-1">


                <div class="flex items-center justify-center space-x-3   ">


                    <span class="material-symbols-outlined">
                        support_agent
                    </span>



                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" class="">



                        <button type="submit" name="set" class="  cursor-pointer hover:opacity-75 border-r border-black px-2">Sub to Newsletter</button>

                    </form>
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" class="">



                        <button type="submit" name="unset" class="  cursor-pointer hover:opacity-75 border-r border-black px-2">Unsub from Newsletter</button>

                    </form>



                </div>


            </div>
        </a>

    </div>

    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" class="">



        <button type="submit" name="log_out" class="px-2 border border-black  cursor-pointer bg-black text-white hover:opacity-75">Log out</button>

    </form>

    <p x-data="{
        remove_msg(){
                if(document.getElementById('err_msg').innerText !== null){

                    setTimeout(() => {
                        document.getElementById('err_msg').innerText = '';
                    }, 3000);
                }
            }
    }" id="err_msg" x-init="remove_msg()" class="text-semibold text-lg text-green-600"><?= $msg ?></p>

</div>





<?php require(__DIR__ . "\\partials\\footer.php"); ?>