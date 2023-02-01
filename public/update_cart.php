<?php

session_start();

require($_SERVER['DOCUMENT_ROOT'] . "/app/models/product.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/image.model.php");


$products_info = array();
if (isset($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $id) {
        $prod_info = Product_Model::get_prod_info_by_ID($id);
        $images_by_id = Image_Model::get_images($id);
        $p = $prod_info + array('image_path' => $images_by_id);
        array_push($products_info, $p);
    }
}


header('Content-Type: application/json');
echo json_encode($products_info);
