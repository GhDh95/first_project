<?php require(__DIR__ . "//partials//header.php"); ?>
<?php require(__DIR__ . "//partials//navigation.php"); ?>


<div class="flex px-20 pt-10 justify-center space-x-2">
    <p class="text-center text-2xl">Manage account</p>
    <a class="pt-1" href="/app/profile_page">
        <span class="material-symbols-outlined">
            settings
        </span>
    </a>
</div>

<div class="grid grid-cols-1 place-items-center py-20 border-b border-black">

    <form class="flex flex-col  w-1/2 max-w-2xl space-y-2" action="<?php echo $_GET['path']; ?>" method="POST">
        <div>
            <label class="text-sm" for="username">Username</label>
            <br>
            <input class="border <?= !empty($nameErr) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="text" name="username" id="username" value=<?php echo $username; ?>>
            <p class="text-xs text-red-500 h-2"> <?= $nameErr ?> </p>
        </div>
        <input class="border border-black cursor-pointer h-10 bg-black text-white hover:opacity-75" type="submit" name="submitName" value="Name ändern">
    </form>

    <form class="flex flex-col  w-1/2 max-w-2xl space-y-2" action="<?php echo $_GET['path']; ?>" method="POST">
        <div>
            <label class="text-sm" for="name">Email</label>
            <br>
            <input class="border <?= !empty($emailErr) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="email" name="email" id="email" value=<?php echo $email; ?>>
            <p class="text-xs text-red-500 h-2"> <?= $emailErr ?> </p>
        </div>
        <input class="border border-black cursor-pointer h-10 bg-black text-white hover:opacity-75" type="submit" name="submitEmail" value="Email ändern">
    </form>

    <form class="flex flex-col  w-1/2 max-w-2xl space-y-2" action="<?php echo $_GET['path']; ?>" method="POST">
        <div>
            <label class="text-sm" for="name">Old password</label>
            <br>
            <input class="border <?= !empty($pwErr) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="password" name="old_password" id="old_password">
            <p class="text-xs text-red-500 h-2"> <?= $pwErr ?> </p>
        </div>
        <div>
            <label class="text-sm" for="name">New password</label>
            <br>
            <input class="border <?= !empty($pwErrNew) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="password" name="new_password" id="new_password">
            <p class="text-xs text-red-500 h-2"> <?= $pwErrNew ?> </p>
        </div>
        <div>
            <label class="text-sm" for="name">New password</label>
            <br>
            <input class="border <?= !empty($pwErrConfirm) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="password" name="confirm_password" id="confirm_password">
            <p class="text-xs text-red-500 h-2"> <?= $pwErrConfirm ?> </p>
        </div>
        <input class="border border-black cursor-pointer h-10 bg-black text-white hover:opacity-75" type="submit" name="submitPw" value="Passwort ändern">
    </form>

    <p class="text-semibold text-green-400"><?= $msg ?></p>
</div>