<?php require(__DIR__ . "//partials//header.php"); ?>
<?php require(__DIR__ . "//partials//navigation.php"); ?>
<div class="flex justify-center py-20 border-b border-black">

    <form class="flex flex-col  w-1/2 max-w-2xl space-y-2" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="code" value="<?php echo $code; ?>">
        <div>
            <label class="text-sm" for="name">Neues Passwort</label>
            <br>
            <input class="border <?= !empty($pwErrNew) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="password" name="new_password" id="new_password">
            <p class="text-xs text-red-500 h-2"> <?= $pwErrNew ?> </p>
        </div>
        <div>
            <label class="text-sm" for="name">Passwort bestätigen</label>
            <br>
            <input class="border <?= !empty($pwErrConfirm) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="password" name="confirm_password" id="confirm_password">
            <p class="text-xs text-red-500 h-2"> <?= $pwErrConfirm ?> </p>
        </div>
        <input class="border border-black cursor-pointer h-10 bg-black text-white hover:opacity-75" type="submit" name="submitPw" value="Passwort ändern">
    </form>


</div>














<?php require(__DIR__ . "//partials//footer.php"); ?>