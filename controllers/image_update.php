<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/image.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/validation.php");

if (!Validation::is_Admin($_SESSION['user_email'])) {
    header("location: /app/profile_page");
    exit();
}

User_Model::user_not_logged_in($_SESSION['user_id']);

$prod_id_err = $image_path_err = "";
$err_msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['update_image'])) {

        $validation = Validation::validate_prod_id($_POST['product_id'], $prod_id_err)
            & Validation::name_validator($_POST['image_path'], $image_path_err);

        if ($validation) {
            Image_Model::update_image_path($_POST['product_id'], $_POST['current_image_id'], $_POST['image_path'], $err_msg);
        }
    }
}



















require($_SERVER['DOCUMENT_ROOT'] . "/app/views/image_update.view.php");
