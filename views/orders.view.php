<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>





<div class="md:p-10">



    <body class="bg-gray-100">
        <div class="container mx-auto py-10">
            <div class="flex space-x-5">
                <h1 class="text-2xl font-bold mb-4">Orders</h1>
                <a class="pt-1" href="/app/profile_page">
                    <span class="material-symbols-outlined">
                        settings
                    </span>
                </a>
            </div>
            <table class="w-full text-left table-collapse">
                <thead>
                    <tr class="bg-gray-200 border border-gray-300">
                        <th class="py-4 px-6 font-medium text-sm border-r border-gray-300">Order ID</th>
                        <th class="py-4 px-6 font-medium text-sm border-r border-gray-300">Product</th>
                        <th class="py-4 px-6 font-medium text-sm border-r border-gray-300">Quantity</th>
                        <th class="py-4 px-6 font-medium text-sm">Ordered on</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='bg-white'>
                                    <td class='py-4 px-6 border border-gray-400'>" . $row['id'] . "</td>
                                    <td class='py-4 px-6 border border-gray-400'>" . $row['product_name'] . "</td>
                                    <td class='py-4 px-6 border border-gray-400'>" . $row['quantity'] . "</td>
                                    <td class='py-4 px-6 border border-gray-400'>" . $row['created_at'] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr class='bg-white'>
                                <td class='py-4 px-6 border border-gray-400' colspan='4'>You have no orders.</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</div>
















<?php require(__DIR__ . "\\partials\\footer.php"); ?>