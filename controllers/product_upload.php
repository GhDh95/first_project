<?php

session_start();

require($_SERVER['DOCUMENT_ROOT'] . "/app/models/product.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/validation.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");

User_Model::user_not_logged_in($_SESSION['user_id']);

if (!Validation::is_Admin($_SESSION['user_email'])) {
    header("location: /app/profile_page");
    exit();
}


$prod_name_err = "";
$prod_categ_err = "";
$prod_price_err = "";
$prod_qty_err = "";
$prod_desc_err = "";
$Product_added_Succesfully = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $validator = Validation::validate_category($_POST['product_category'], $prod_categ_err)
        & Validation::name_validator($_POST['product_name'], $prod_name_err)
        & Validation::input_isNumeric($_POST['product_price'], $prod_price_err)
        & Validation::input_isNumeric($_POST['product_quantity'], $prod_qty_err)
        & Validation::text_area_validator($_POST['product_description'], $prod_desc_err);

    if ($validator) {
        $prod_name = $_POST['product_name'];
        $prod_categ = $_POST['product_category'];
        $prod_price = $_POST['product_price'];
        $prod_qty = $_POST['product_quantity'];
        $prod_desc = $_POST['product_description'];


        try {
            Product_Model::add_product($prod_name, $prod_categ, $prod_price, $prod_qty, $prod_desc);
            $Product_added_Succesfully = "Product was successfully added to Database.";
        } catch (Exception $e) {
            $Product_added_Succesfully = "Upload was unsuccessful!";
        }
    }
}

require($_SERVER['DOCUMENT_ROOT'] . "/app/views/product_upload.view.php");
