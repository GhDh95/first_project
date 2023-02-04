<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>





<div class="bg-gray-100 p-10">
    <div class="container mx-auto py-10">
        <div class="flex space-x-4">
            <h1 class="text-2xl font-bold mb-4">Product Ratings</h1>
            <a class="pt-1" href="/app/profile_page">
                <span class="material-symbols-outlined">
                    settings
                </span>
            </a>
        </div>
        <table class="w-full text-left table-collapse">
            <thead>
                <tr class="bg-gray-200 border border-gray-400">
                    <th class="py-4 px-6 font-medium text-sm ">Recently bought Products</th>
                    <th class="py-4 px-6 font-medium text-sm">Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='bg-white'>
                    <td class='py-4 px-6 border border-gray-400'>" . $row['product_name'] . "</td>
                    <td class='py-4 px-6 border border-gray-400'>
                        <form action='/app/rate' method='post'>
                        <input type='hidden' name='product_name' value='" . $row['product_name'] . "'>
                            <select name='rating' class='bg-gray-100 border border-gray-400 p-2'>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                            </select>
                            <input type='submit' value='Rate'
                                class='bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded hover:cursor-pointer'>
                        </form>
                    </td>
                </tr>";
                    }
                } else {
                    echo "<tr class='bg-white'>
                    <td class='py-4 px-6 border border-gray-400' colspan='2'>There are no products available to rate.
                    </td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<p class="text-center text-green-500 text-2xl"><?= $rate_msg ?></p>