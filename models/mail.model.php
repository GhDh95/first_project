<?php

require($_SERVER['DOCUMENT_ROOT'] . "/app/PHPMailer/includes/PHPMailer.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/PHPMailer/includes/SMTP.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/PHPMailer/includes/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail_Model
{
    //Aktiviert den Newsletter und versendet an Userid gegnüpften Rabattcode. Überprüft zunächst, ob ein User bereits in der Vergangenheit sich zum Newsletter registriert hat. Der Rabattcode wird nur erstellt, wenn checkSubscription() not_subscribed ausgibt. Bei unsubscribed wurde schon einmal ein Rabattcode erstellt
    public static function activateNewsletter($id, $username, $email)
    {
        if ((Mail_Model::checkSubscription($id) == "unsubscribed") || (Mail_Model::checkSubscription($id) == "subscribed")) {
            Mail_Model::setSubscription($id);
        } else {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->Username = "webshopprojekt22.23@gmail.com";
            $mail->Password = "qzvvakfjitpgcxhb";
            $mail->Subject = "Newsletter";
            $mail->setFrom("webshopprojekt22.23@gmail.com");
            $mail->isHTML(true);
            $email_template = $_SERVER['DOCUMENT_ROOT'] . "/app/public/Newsletter_activation.html";
            $message = file_get_contents($email_template);
            $message = str_replace('%username%', $username, $message);
            $message = str_replace('%code%', Mail_Model::createNewsletterCode($id), $message);
            $mail->MsgHTML($message);
            $mail->addAddress($email);
            $mail->send();
            $mail->smtpClose();
            Mail_Model::setSubscription($id);
        }
    }

    //Erstellt einen 10-stelligen Code
    private static function createNewsletterCode($id)
    {
        $length = 10;
        $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
        Mail_Model::addCodetoDB($id, $code);
        return $code;
    }

    //Fügt den Rabattcode für genau eine Userid hinzu
    private static function addCodetoDB($id, $code)
    {
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "INSERT INTO discount_codes (user_id, code, discount) VALUES ('{$id}', '{$code}', 10)";
        if (!$con->query($sql)) {
            die('Error: ' . $con->error);
        }
        $con->close();
    }

    //Setzt den Status auf subscribed. Standardwert ist not_subscribed
    public static function setSubscription($id)
    {
        $status = "subscribed";
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "UPDATE users SET newsletter = ('{$status}') WHERE id = ('{$id}')";
        if (!$con->query($sql)) {
            die('Error: ' . $con->error);
        }
        $con->close();
    }

    //Setzt den Status auf unsubscribed, dieser kann wieder in subscribed umgewandelt werden, nicht jedoch in not_subscribed, dadurch kann ein User nur 1mal den Rabattcode anfordern
    public static function unsetSubscription($id)
    {
        $status = "unsubscribed";
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "UPDATE users SET newsletter = ('{$status}') WHERE id = ('{$id}')";
        if (!$con->query($sql)) {
            die('Error: ' . $con->error);
        }
        $con->close();
    }

    //Checkt den Status eines Users, es gibt not_subscribed, subscribed und unsubscribed
    public static function checkSubscription($id)
    {
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT newsletter FROM users WHERE id = '{$id}'";
        $result = $con->query($sql);
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }
        $status = $result->fetch_assoc();
        $con->close();
        return $status["newsletter"];
    }

    //Versendet den Newsletter an alle user mit dem Status subscribed in der Spalte newsletter
    public static function sendNewsletter()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "webshopprojekt22.23@gmail.com";
        $mail->Password = "qzvvakfjitpgcxhb";
        $mail->Subject = "Newsletter";
        $mail->setFrom("webshopprojekt22.23@gmail.com");
        $mail->isHTML(true);
        $email_template = $_SERVER['DOCUMENT_ROOT'] . "/app/public/Newsletter.html";


        $status = "subscribed";
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT email, username FROM users WHERE newsletter = '{$status}'";
        $result = $con->query($sql);
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }
        while ($row = $result->fetch_assoc()) {
            $message = file_get_contents($email_template);
            $message = str_replace('%username%', $row["username"], $message);
            $mail->MsgHTML($message);
            $mail->addAddress($row["email"]);
            $mail->send();
            $mail->clearAllRecipients();
        }
        $mail->smtpClose();
        $con->close();
    }

    public static function sent_verification_link($email)
    {
        $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 25);

        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "UPDATE users SET verify_code = ('{$code}') WHERE email = ('{$email}')";
        if (!$con->query($sql)) {
            die('Error: ' . $con->error);
        }
        $con->close();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "webshopprojekt22.23@gmail.com";
        $mail->Password = "qzvvakfjitpgcxhb";
        $mail->Subject = "Verify";
        $mail->setFrom("webshopprojekt22.23@gmail.com");
        $mail->isHTML(true);
        $mail->Body = "http://localhost/app/public/verify.php?email=" . $email . "&code=" . $code . "";
        $mail->addAddress($email);
        $mail->send();
        $mail->smtpClose();
    }

    public static function setVerification($email, $code)
    {
        $status = "verified";
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT * FROM users WHERE verify_code = ('{$code}')";
        $result = $con->query($sql);
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }
        if ($result->num_rows > 0) {
            $sql = "UPDATE users SET verified = ('{$status}') WHERE email = ('{$email}')";
            if (!$con->query($sql)) {
                die('Error: ' . $con->error);
            }
            $con->close();
            return true;
        }
        $con->close();
        return false;
    }

    public static function request_change_password($email)
    {
        $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 25);
        $status = "verified";

        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        //Prüft, ob User mit dieser Email vorhanden ist und ob dieser auch verifiziert ist. (da verify_code auch für die Registrierung benutzt wird und sonst überschrieben werden würde)
        $sql = "SELECT * FROM users WHERE email = ('{$email}') AND verified = ('{$status}')";
        $result = $con->query($sql);
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }
        if (!($result->num_rows == 0)) {
            $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
            $sql = "UPDATE users SET verify_code = ('{$code}') WHERE email = ('{$email}')";
            if (!$con->query($sql)) {
                die('Error: ' . $con->error);
            }
            $con->close();

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->Username = "webshopprojekt22.23@gmail.com";
            $mail->Password = "qzvvakfjitpgcxhb";
            $mail->Subject = "Change password";
            $mail->setFrom("webshopprojekt22.23@gmail.com");
            $mail->isHTML(true);
            $mail->Body = "http://localhost/app/controllers/reset_password.php?email=" . $email . "&code=" . $code . "";
            $mail->addAddress($email);
            $mail->send();
            $mail->smtpClose();
        } else {
            $con->close();
        }
    }

    public static function request_change_email($new_email, $id)
    {
        $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 25);

        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT * FROM new_emails WHERE user_id = ('{$id}')";
        $result = $con->query($sql);
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }
        if ($result->num_rows == 0) {
            $sql = "INSERT INTO new_emails (user_id, new_email, verify_code) VALUES ('{$id}', '{$new_email}', '{$code}')";
            if (!$con->query($sql)) {
                die('Error: ' . $con->error);
            }
            $con->close();
        } else {
            $sql = "UPDATE new_emails SET verify_code = ('{$code}'), new_email = ('{$new_email}') WHERE user_id = ('{$id}')";
            if (!$con->query($sql)) {
                die('Error: ' . $con->error);
            }
            $con->close();
        }

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "webshopprojekt22.23@gmail.com";
        $mail->Password = "qzvvakfjitpgcxhb";
        $mail->Subject = "Request to change Email";
        $mail->setFrom("webshopprojekt22.23@gmail.com");
        $mail->isHTML(true);
        $mail->Body = "/app/change_email" . $id . "&code=" . $code . "";
        $mail->addAddress($new_email);
        $mail->send();
        $mail->smtpClose();
    }

    public static function order_success_email($id, $email)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "webshopprojekt22.23@gmail.com";
        $mail->Password = "qzvvakfjitpgcxhb";
        $mail->Subject = "Order_success";
        $mail->setFrom("webshopprojekt22.23@gmail.com");
        $mail->isHTML(true);
        $mail->Body = "Vielen Dank für ihre Bestellung! Wir werden Sie auf dem Laufenden halten was den Status ihrer Bestellung angeht!";
        $mail->addAddress($email);
        $mail->send();
        $mail->smtpClose();
    }
}
