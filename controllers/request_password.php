<?php
$emailErr = "";

require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/mail.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/validation.php");


/* Verschickt Email zum ändern des Passworts, falls vergessen. User wird nicht informiert, wenn die Email keinem Nutzer zugeschrieben ist */
if (isset($_POST["submitEmail"])) {
    $Validation = Validation::email_validator($_POST['email'], $emailErr);

    if ($Validation) {
        Mail_Model::request_change_password($_POST["email"]);
        $emailErr = "We have sent you a link to your email if this exists to change your password.";
    }
}










require($_SERVER['DOCUMENT_ROOT'] . "/app/views/request_password.view.php");
