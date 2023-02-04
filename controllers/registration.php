
<?php
session_start();

require($_SERVER['DOCUMENT_ROOT'] . "/app/models/mail.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/models/user.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/validation.php");


$nameErr = $emailErr = $pwErr = $password_hash = $duplicate_error = $logged_in_err = "";

if (isset($_POST['submit'])) {




    /* this checks if all inputs are valid or not, sets the error messages, returns true if all valid */
    $validation = Validation::name_validator($_POST['username'], $nameErr) &
        Validation::email_validator($_POST['email'], $emailErr) &
        Validation::password_validator($_POST['password'], $pwErr) &
        Validation::email_check($_POST['email'], $emailErr) &
        Validation::must_logout_validation($logged_in_err);


    /* if valid try to add user */
    if ($validation) {
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        try {
            User_Model::add_new_user($_POST['username'], $_POST['email'], $password_hash);
            Mail_Model::sent_verification_link($_POST['email']);
            header("location: /app/registration_verify");
        } catch (Exception $e) {
            if ($e->getcode() === 1062) {
                $duplicate_error = "Email already taken*";
            }
        }
    }
}



require($_SERVER['DOCUMENT_ROOT'] . "/app/views/register.view.php");
