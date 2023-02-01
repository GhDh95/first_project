<?php

session_start();

require($_SERVER['DOCUMENT_ROOT'] . "/app/public/validation.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/product.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/image.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");

User_Model::user_not_logged_in($_SESSION['user_id']);




if (!Validation::is_Admin($_SESSION['user_email'])) {
    header("location: /app/profile_page");
    exit();
}

$prod_id_err = $image_path_err = $upload_failed_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //check if product id is not in DB or input fields are empty 

    $validation = Validation::validate_prod_id($_POST['product_id'], $prod_id_err)
        & Validation::name_validator($_POST['image_path'], $image_path_err);

    if ($validation) {

        if (Product_Model::id_exists($_POST['product_id'])) {


            try {
                Image_Model::add_image_by_prod_id($_POST['product_id'], $_POST['image_path']);
                $upload_failed_err = "Image upload Successful!";
            } catch (Exception $e) {
                $upload_failed_err = "Image Upload was not Successful*";
            }
        } else {
            $upload_failed_err = "Product Key not in DB*";
        }
    }
}


















require($_SERVER['DOCUMENT_ROOT'] . "/app/views/image_upload.view.php");
