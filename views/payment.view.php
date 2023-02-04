<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>


<div class="flex flex-col  justify-center items-center space-y-3">
    <p class="text-xl font-bold py-10">Please provide your shipping information</p>
    <form action="/app/payment" method="post" class="bg-white p-6 rounded-lg shadow-lg">
        <div class="mb-4">
            <label class="block font-bold mb-2">Zip Code</label>
            <input type="text" name="zipcode" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-2">Country</label>
            <input type="text" name="country" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-2">City</label>
            <input type="text" name="city" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-2">Street</label>
            <input type="text" name="street" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-2">House Number</label>
            <input type="text" name="housenumber" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-2">Telephone Number (optional)</label>
            <input type="text" name="telephone" class="border p-2 w-full">
        </div>
        <p class="mb-2">The telephone number field is optional, but it can be used to inform you in case of any updates
        </p>
        <div class="mb-4">
            <label class="block font-bold mb-2">Payment Method</label>
            <div class="mb-2 flex items-center">
                <input type="radio" name="payment_method" value="invoice" required>
                <span class="ml-2"><img title="Invoice" src="/app/Product_images/1449943.png" alt="Pay by Bill" width="50" height="50"></span>
            </div>
            <div class="mb-2 flex items-center">
                <input type="radio" name="payment_method" value="paypal">
                <img title="Paypal" src="/app/Product_images/paypal-payment-icon-editorial-logo-free-vector.webp" alt="PayPal" width="50" height="50">
            </div>
            <div class="mb-2 flex items-center">
                <input type="radio" name="payment_method" value="credit_card">
                <span class="ml-2"><img title="credit card" src="/app/Product_images/4341764.png" alt="Credit Card" width="50" height="50"></span>
            </div>
        </div>
        <input type="submit" name="order_now" value="order now" class="bg-indigo-500 hover:opacity-75 text-white p-2 mr-2 hover:cursor-pointer">
        <a href="/app/cart" class="hover:opacity-75 float-right bg-red-500 text-white p-2">Back</a>
    </form>
</div>

<p class="text-2xl text-red"><?= $msg_err ?> </p>

<?php include(dirname(__FILE__) . "\\partials\\footer.php"); ?>