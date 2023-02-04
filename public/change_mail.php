<?php
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");

/* Führt Funktion zum ändern der Email aus, wenn $id und $code übereinstimmen */
if (isset($_GET["id"]) && isset($_GET["code"])) {
    if (user_Model::set_new_mail(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL), filter_input(INPUT_GET, 'code', FILTER_SANITIZE_URL))) {
        header("location: /app/change_email_success");
    } else {
        echo "Email konnte nicht geändert werden";
    }
} else {
    header("location: /app/registration");
}
