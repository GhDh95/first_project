<?php

$emailErr = $pwErr =  $invalid_err = "";
session_start();
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/validation.php");




if (isset($_SESSION['user_id'])) {
    header("location: /app/profile_page");
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /* validate input */
    $validation = Validation::email_validator($_POST['email'], $emailErr) & Validation::password_validator($_POST['password'], $pwErr);

    if ($validation) {
        User_Model::login($_POST['email'], $_POST['password'], $invalid_err);
    }
}





require($_SERVER['DOCUMENT_ROOT'] . "/app/views/login.view.php");
