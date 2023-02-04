<?php

$emailErr = $pwErr = $pwErrNew = $pwErrConfirm = $nameErr = "";
session_start();
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/mail.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/validation.php");

$msg = "";

if (!isset($_SESSION["user_id"])) {
    header("location: /app/login");
    exit();
}

$username = User_Model::get_account_info($_SESSION["user_id"], "username");

$email = User_Model::get_account_info($_SESSION["user_id"], "email");

if (isset($_POST["submitName"])) {
    $validation = Validation::name_validator($_POST['username'], $nameErr);

    if ($validation) {
        User_Model::change_name($_POST["username"], $_SESSION["user_id"]);
        $username = User_Model::get_account_info($_SESSION["user_id"], "username");
        $_SESSION['username'] = $username;
        $msg = "Update successful";
    }
}

/* Bei Emailänderung wird eine Bestätigungsmail an die neue Adresse geschickt. 
   $email = $_POST["email"] damit die neue Email angezeigt wird, obwohl sie noch nicht in der DB steht*/
if (isset($_POST["submitEmail"])) {
    $validation = Validation::email_check($_POST['email'], $emailErr) &
        Validation::email_validator($_POST['email'], $emailErr);
    $email = $_POST["email"];

    if ($validation) {
        $email = $_POST["email"];
        $emailErr = "Please verify your new email using the link in the email we sent you.";
        Mail_Model::request_change_email($_POST["email"], $_SESSION["user_id"]);
        $msg = "changed";
    }
}

/* Altes und neues Passwort wird auf Korrektheit überprüft*/
if (isset($_POST["submitPw"])) {

    $validation = Validation::password_validator($_POST['old_password'], $pwErr);

    if ($validation) {
        if (!(password_verify($_POST["old_password"], User_Model::get_account_info($_SESSION["user_id"], "password_hash")))) {
            $pwErr = "Wrong password";
        } else {
            $secondValidation = Validation::password_validator($_POST['new_password'], $pwErrNew) &
                Validation::password_validator($_POST['confirm_password'], $pwErrConfirm);

            if ($secondValidation) {
                if ($_POST['new_password'] == $_POST['confirm_password']) {
                    User_Model::change_password($_POST['new_password'], $_SESSION["user_id"]);
                    $msg = "changed";
                } else {
                    $pwErrConfirm = "Password does not match";
                }
            }
        }
    }
}















require($_SERVER['DOCUMENT_ROOT'] . "/app/views/account_settings.view.php");
