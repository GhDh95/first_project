<?php

session_start();
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/image.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/product.model.php");


$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

/* contains unique prod_ids no duplicates */

//get data and images for each item in filtered cart

$cart_data = array();
foreach ($cart as $id) {
    $img = Image_Model::get_images($id);
    $prod_info = Product_Model::get_prod_info_by_ID($id);
    $prod_info = array_merge($prod_info, ['product_images' => $img]);
    array_push($cart_data, $prod_info);
}




header('Content-Type: application/json');
echo json_encode($cart_data);
