<?php

class Validation
{
    public static function name_validator($name, &$error_msg)
    {
        $name = htmlspecialchars(trim($name));
        if (empty($name)) {
            $error_msg = "Filed required*";
            return false;
        }
        return true;
    }

    public static function email_validator($email, &$error_msg)
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_msg = "Invalid Email*";
            return false;
        }
        return true;
    }

    public static function password_validator($password, &$error_msg)
    {
        if (strlen($password) < 5 || !preg_match("/[a-z]/i", $password)) {
            $error_msg = "Invalid Password: must contain 5 or more characters, 1 letter*";
            return false;
        }
        return true;
    }

    /* used to stop user from making a new account if logged in  */
    public static function must_logout_validation(&$logged_in_err)
    {
        if (isset($_SESSION['user_id'])) {
            $logged_in_err = "Must log out*";
            return false;
        }
        return true;
    }

    public static function input_isNumeric($input, &$err)
    {
        $input = htmlspecialchars($input);
        if (isset($input) && is_numeric($input) && $input >= 0) {
            return true;
        }
        $err = "Invalid input: must be numeric*";
        return false;
    }

    public static function text_area_validator($input, &$err)
    {
        $input = htmlspecialchars(trim($input));
        if (isset($input) & self::text_length($input)) {
            return true;
        }
        $err = "Invalid length: must contain 1 - 1000 characters*";
        return false;
    }

    public static function text_length($text, $min = 1, $max = 1000)
    {
        if (strlen($text) >= $min && strlen($text) <= $max) {
            return true;
        }
        return false;
    }

    public static function id_validator(&$id)
    {
        if (isset($id) && is_numeric($id)) {
            return true;
        }
        return false;
    }

    public static function validate_prod_num_inputs(&$input)
    {
        if (!isset($input) || empty($input)) {
            return true;
        }

        if (is_numeric($input) & $input >= 0) {
            return true;
        }
        return false;
    }

    public static function validate_category(&$category, &$prod_categ_err)
    {
        if (!isset($category)) {
            $prod_categ_err = "Please choose a category*";
            return false;
        }
        return true;
    }


    /* validation for upload and update images pages*/

    public static function validate_prod_id($input, &$err)
    {
        if (!isset($input) | !is_numeric($input)) {
            $err = "Invalid input*";
            return false;
        }
        return true;
    }
    public static function email_check($email, &$error_msg)
    {
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $con->query($sql);
        $con->close();

        if (mysqli_num_rows($result) > 0) {
            $error_msg = "Email already exists*";
            return false;
        }

        return true;
    }

    public static function is_Admin(&$email)
    {
        if ($email == "admin@test.de") {
            return true;
        }
        return false;
    }
}
