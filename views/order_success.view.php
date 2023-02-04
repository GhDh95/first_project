<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>


<div class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-md w-1/3 text-center">
        <h1 class="text-2xl font-bold mb-4">Successful Order</h1>
        <p class="mb-4">Thank you for your order. We will process it as soon as possible. A confirmation email has been
            sent to your email address.</p>
        <div class="flex justify-between w-full">
            <a href="/app/shop" class="bg-indigo-500 text-white p-2 rounded-lg hover:bg-indigo-600 mr-2">Return
                to
                Homepage</a>
            <a href="/app/shop" class="bg-indigo-500 text-white p-2 rounded-lg hover:bg-indigo-600">Continue Shopping</a>
        </div>
    </div>
</div>



<?php require(__DIR__ . "\\partials\\footer.php"); ?>