<?php

session_start();

require($_SERVER['DOCUMENT_ROOT'] . "/app/models/product.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/validation.php");

if (!Validation::is_Admin($_SESSION['user_email'])) {
    header("location: /app/profile_page");
    exit();
}

$update_info = "";

$products = Product_Model::get_product_info();

User_Model::user_not_logged_in($_SESSION['user_id']);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['update_prod'])) {
        $validation = Validation::validate_prod_num_inputs($_POST['product_price'])
            & Validation::validate_prod_num_inputs($_POST['product_quantity'])
            & Validation::id_validator($_POST['product_id']);


        if ($validation && Product_Model::update_product()) {
            $update_info = "Update successfull";
            header("refresh: 2");
        } else {
            $update_info = "Update failed";
        }
    }

    if (isset($_POST['delete_prod'])) {
        $validation = Validation::id_validator($_POST['product_id']);
        if ($validation && Product_Model::delete_product($_POST['product_id'])) {
            $del_img = Product_Model::delete_correspoding_imgs($_POST['product_id']);
            $update_info = "Product (and its correspondings fotos) was deleted.";
            header("refresh: 2");
        } else {
            $update_info = "Product was not deleted!";
        }
    }
}












require($_SERVER['DOCUMENT_ROOT'] . "/app/views/product_update.view.php");
