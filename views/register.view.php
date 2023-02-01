<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>

<div class="flex justify-center py-20 border-b border-black">

    <form class="flex flex-col  w-1/2 max-w-2xl space-y-2" action="<?php echo $_GET['path']; ?>" method="POST">
        <div>

            <label class="text-sm" for="username">Username</label>
            <br>
            <input class="border <?= !empty($nameErr) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="text" name="username" id="username" placeholder="username">
            <p class="text-xs text-red-500 h-2"><?= $nameErr ?></p>
        </div>
        <div>

            <label class="text-sm" for="email">Email</label>
            <br>
            <input class="border <?= !empty($emailErr) ?  "border-red-500 " : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10 focus:outline-none px-2 " type="email" name="email" id="email" placeholder="email">
            <p class="text-xs text-red-500 h-2"><?= $emailErr ?></p>
        </div>
        <div>

            <label class="text-sm" for="password">Password</label>
            <br>
            <input class="border <?= !empty($pwErr) ?  "border-red-500 " : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="password" name="password" id="password" placeholder="password">
            <p class="text-xs text-red-500 h-2"><?= $pwErr ?></p>
        </div>

        <input class="border border-black cursor-pointer h-10 bg-black text-white hover:opacity-75" type="submit" name="submit" value="Register">


        <p class="text-sm text-semibold text-red-500"><?= $duplicate_error ?></p>
        <p class="text-sm text-semibold text-red-500"><?= $logged_in_err ?></p>

        <a class="hover:underline text-violet-500 font-semibold" href="/app/login">Already have an account? <span class="block md:inline">Sign in!</span> </a>
    </form>

</div>





<?php require(__DIR__ . "\\partials\\footer.php"); ?>