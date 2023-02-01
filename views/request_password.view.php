<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>
<div class="flex justify-center py-20 border-b border-black">


    <form class="flex flex-col  w-1/2 max-w-2xl space-y-4" action="<?php echo $_GET['path']; ?>" method="POST">
        <div>
            <label class="text-sm" for="name">Email</label>
            <br>
            <input class="border <?= !empty($emailErr) ?  "border-red-500" : "border-black hover:ring-1 hover:ring-black" ?> w-full h-10  focus:outline-none px-2 " type="email" name="email" id="email">
            <p class="text-xs text-red-500 "> <?= $emailErr ?> </p>
        </div>
        <input class="border border-black cursor-pointer h-10 bg-black text-white hover:opacity-75" type="submit" name="submitEmail" value="Reset Password">
    </form>

</div>














<?php require(__DIR__ . "\\partials\\footer.php"); ?>