<?php


session_start();


require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/mail.model.php");


User_Model::user_not_logged_in($_SESSION['user_id']);


$msg = "";
if (isset($_POST['log_out'])) {
    echo "success";
    User_Model::log_out();
}
if (isset($_POST["newsletter"])) {
    Mail_Model::sendNewsletter();
    $msg = "Newsletter sent";
}




















require($_SERVER['DOCUMENT_ROOT'] . "/app/views/admin_profile.view.php");
