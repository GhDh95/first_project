<?php

require($_SERVER['DOCUMENT_ROOT'] . "/app/models/product.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/image.model.php");

$products = Product_Model::get_product_info();
$all_product_ids = [];

/* get products info */
$prduct_info = [];
foreach ($products as $product) {
    array_push($prduct_info, $product);
    array_push($all_product_ids, $product['product_id']);
}


/* get product images */

$images_by_id = array();


foreach ($all_product_ids as $id) {
    $img = Image_Model::get_images($id);
    $arr = array($id => $img);
    array_push($images_by_id, $arr);
}

$res = array(
    "product_info" => $prduct_info,
    "images_info" => $images_by_id
);

header('Content-Type: application/json');
echo json_encode($res);
