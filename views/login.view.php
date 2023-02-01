<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>
<div class="flex justify-center py-20 border-b border-black">

    <form class="flex flex-col  w-1/2 max-w-2xl space-y-2" action="<?php echo $_GET['path']; ?>" method="POST">
        <div>
            <label class="text-sm" for="email">Email</label>
            <br>
            <input class="border <?= !empty($emailErr) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="email" name="email" id="email">
            <p class="text-xs text-red-500 h-2"> <?= $emailErr ?> </p>
        </div>
        <div>

            <label class="text-sm" for="password">Password</label>
            <br>
            <input class="border <?= !empty($pwErr) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="password" name="password" id="password">
            <p class="text-xs text-red-500 h-2"> <?= $pwErr ?> </p>
        </div>

        <input class="border border-black cursor-pointer h-10 bg-black text-white hover:opacity-75" type="submit" value="Sign in">
        <p class="text-sm text-semibold text-red-500"><?= $invalid_err ?></p>

        <a class="hover:underline text-violet-500 font-semibold" href="/app/registration">New here? <span class="block md:inline">Sign up!</span> </a>
        <a class="hover:underline text-violet-500 font-semibold" href="/app/request_password">Reset your password</a>
    </form>
</div>














<?php require(__DIR__ . "\\partials\\footer.php"); ?>