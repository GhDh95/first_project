<?php
session_start();

require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/mail.model.php");

$msg = "";

/* If not logged in, will redirect to login page */
User_Model::user_not_logged_in($_SESSION['user_id']);



/* will redirect to admin page if user email corresponds with that of admin */
User_Model::user_isAdmin($_SESSION['user_email']);

/* If coming from cart.php to login, will be redirected to payment */


if (isset($_POST['log_out'])) {

    User_Model::log_out();
}


if (isset($_POST["set"])) {
    Mail_Model::activateNewsletter($_SESSION['user_id'], $_SESSION['username'], $_SESSION['user_email']);
    $msg = "Subscribed";
}

if (isset($_POST["unset"])) {
    Mail_Model::unsetSubscription($_SESSION['user_id']);
    $msg = "Unsubscribed";
}




require($_SERVER['DOCUMENT_ROOT'] . "/app/views/profile_page.view.php");
