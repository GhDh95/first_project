<?php
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/mail.model.php");


if (isset($_GET["email"]) && isset($_GET["code"])) {
    if (Mail_Model::setVerification(filter_input(INPUT_GET, 'email', FILTER_SANITIZE_URL), filter_input(INPUT_GET, 'code', FILTER_SANITIZE_URL))) {
        header("location: /app/verification_success");
    } else {
        echo "Verification fehlgeschlagen";
    }
} else {
    header("location: /app/registration");
}
