<?php

class User_Model
{

    public static function add_new_user(&$username, &$email, &$password_hash)
    {
        /* filter inputs */
        $username = htmlspecialchars($username);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $password_hash = htmlspecialchars($password_hash);


        /* SQL insert into DB statement */
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "INSERT INTO users (username, email, password_hash) VALUES ('{$username}', '{$email}', '{$password_hash}')";
        if (!$con->query($sql)) {
            die('Error: ' . $con->error);
        }
        $con->close();
    }

    public static function login($input_email, $input_password, &$input_error)
    {
        /* filter the inputs */
        $email = filter_var($input_email, FILTER_VALIDATE_EMAIL);
        $password = htmlspecialchars($input_password);

        /* Check if user already exists in DB */
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT * FROM users WHERE email = '{$email}'";
        $result = $con->query($sql);
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $pw_hash = $user['password_hash'];
            if (password_verify($password, $pw_hash)) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_email'] = $input_email;
                header("location: /app/controllers/profile_page.php");
                exit();
            } else {

                $input_error = "Wrong Email or Password!*";
            }
        }

        $con->close();
    }

    public static function log_out()
    {
        session_unset();
        session_destroy();
        header("location: /app/controllers/login.php");
        exit();
    }

    public static function user_not_logged_in(&$user_id)
    {
        if (!isset($user_id)) {
            header("location: /app/controllers/login.php");
            exit();
        }
    }

    public static function user_isAdmin(&$user_email)
    {
        if ($user_email == "admin@test.de") {
            header("location: /app/controllers/admin_profile.php");
            exit();
        }
    }

    public static function get_account_info(&$user_id, $column)
    {
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT $column FROM users WHERE id = '{$user_id}';";
        $result = $con->query($sql);
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }
        $info = $result->fetch_assoc();
        $con->close();

        return $info[$column];
    }
    public static function change_name($user_name, &$user_id)
    {
        $user_name = htmlspecialchars($user_name);
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "UPDATE users SET username = ('{$user_name}') WHERE id = ('{$user_id}')";
        if (!$con->query($sql)) {
            die('Error: ' . $con->error);
        }
        $con->close();
    }
    public static function change_password(&$password, &$user_id)
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "UPDATE users SET password_hash = ('{$password_hash}') WHERE id = ('{$user_id}')";
        if (!$con->query($sql)) {
            die('Error: ' . $con->error);
        }
        $con->close();
    }
}
