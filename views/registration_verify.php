<?php require(__DIR__ . "//partials//header.php"); ?>
<?php require(__DIR__ . "//partials//navigation.php"); ?>


<div class=" flex flex-col space-y-20 items-center border-b border-black py-36">

    <p class="text-red-600 text-3xl">Please verify your account using the link in the email we sent you.</p>

    <div class="grid grid-cols-2 gap-x-2">

        <a class="border  px-9 py-2 border-black text-center align-middle bg-black text-white hover:opacity-75" href="/app/login">Sign in!</a>
        <a class="border  px-9 py-2 border-black text-center align-middle bg-black text-white hover:opacity-75" href="/app/shop">Shop</a>
    </div>

</div>


<?php require(__DIR__ . "//partials//footer.php"); ?>