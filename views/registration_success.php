<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>


<div class=" flex flex-col space-y-20 items-center border-b border-black py-36">

    <p class="text-green-600 text-3xl">You've signed up Successfully!</p>

    <div class="grid grid-cols-2 gap-x-2">

        <a class="border  px-9 py-2 border-black text-center align-middle bg-black text-white hover:opacity-75" href="/app/login">Sign in!</a>
        <a class="border  px-9 py-2 border-black text-center align-middle bg-black text-white hover:opacity-75" href="/app/login">Shop</a>
    </div>

</div>


<?php require(__DIR__ . "\\partials\\footer.php"); ?>