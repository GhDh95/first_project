<?php

$pwErrNew = $pwErrConfirm = "";

require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/mail.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/validation.php");

/* Speichert beim ersten Aufruf die URL Werte in Variablen, die gleichzeitg in einem hidden input Feld (reset_password.view.php)
gespeichert werden, damit diese bei Formularausführung nicht verloren gehen */
if (isset($_GET["email"]) && isset($_GET["code"])) {
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_URL);
    $code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_URL);
} else {
    $email = $_POST["email"];
    $code = $_POST["code"];
}

/* Ruft Funktionen auf, um Passwort zu validieren und zu ändern */
if (isset($_POST["submitPw"])) {
    $Validation = Validation::password_validator($_POST['new_password'], $pwErrNew) &
        Validation::password_validator($_POST['confirm_password'], $pwErrConfirm);
    if ($Validation) {
        if ($_POST['new_password'] == $_POST['confirm_password']) {
            if (user_Model::reset_password($email, $code, password_hash($_POST['new_password'], PASSWORD_DEFAULT))) {
                header("location: /app/login");
            } else {
                die("Something went wrong");
            }
        } else {
            $pwErrConfirm = "Password does not match";
        }
    }
}












require($_SERVER['DOCUMENT_ROOT'] . "/app/views/reset_password.view.php");
