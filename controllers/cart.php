<?php

session_start();
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/product.model.php");

$emty_msg = "";
$err_arr = [];
$arr = array();
$qty = 0;
$available_qty_arr = array();
$unavailable_products = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['checkout']) && !isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        $emty_msg = "Cart is Empty!";
        array_push($err_arr, $emty_msg);
    }
    if (isset($_POST['checkout']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {



        $data = Product_Model::get_prod_qty();

        $filtered_cart = array_unique($_SESSION['cart']);

        foreach ($filtered_cart as $val) {
            $arr_of_duplicates = array_filter($_SESSION['cart'], function ($item) use ($val) {
                return $item == $val;
            });
            $qty = count($arr_of_duplicates);
            $available_qty_arr = array_filter($data, function ($item) use ($val) {
                return $item['product_id'] == $val;
            });

            foreach ($available_qty_arr as $key => $val) {
                $available_qty_arr = $available_qty_arr[$key];
            }

            if ($qty > $available_qty_arr['product_quantity']) {
                array_push($unavailable_products, ['product_name' => $available_qty_arr['product_name'], 'product_quantity' => $available_qty_arr['product_quantity']]);
            }
        }

        if (count($unavailable_products) <= 0) {
            header("location: /app/payment");
            exit();
        } else {
            foreach ($unavailable_products as $key => $val) {
                $emty_msg = "Product: '{$val['product_name']}' (only {$val['product_quantity']} units available!)";
                array_push($err_arr, $emty_msg);
            }
        }
    }
}


require($_SERVER['DOCUMENT_ROOT'] . "/app/views/cart.view.php");
