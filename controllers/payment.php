<?php
session_start();

require($_SERVER['DOCUMENT_ROOT'] . "/app/models/mail.model.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");

if (!isset($_SESSION['user_id'])) {
    header('location: /app/login');
    exit;
}

$timestamp = time();
$today = date("Y-m-d", $timestamp);
$user_id = $_SESSION['user_id'];
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : []; //fixed by Ghassen 

$mailquery = "SELECT email FROM users WHERE id = $user_id";
$mailresult = mysqli_query($con, $mailquery);

if (mysqli_num_rows($mailresult) > 0) {

    $row = mysqli_fetch_assoc($mailresult);
    $user_mail = $row['email'];
}

$msg_err = "";
$val = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['order_now'])) {
        $zipcode = $_POST["zipcode"];
        $country = $_POST["country"];
        $city = $_POST["city"];
        $street = $_POST["street"];
        $housenumber = $_POST["housenumber"];
        if (!isset($zipcode) || !isset($country) || !isset($city) || !isset($street) || !isset($housenumber)) {
            $val = false;
            $msg_err = "Please fill all fields";
        }

        if ($val) {
            try {
                $check_query2 = "SELECT * FROM adress WHERE user_id = $user_id";
                $check_result2 = mysqli_query($con, $check_query2);
                if (mysqli_num_rows($check_result2) > 0) {
                    $adress_update_query = "UPDATE adress SET zipcode = '$zipcode', country = '$country', city = '$city', street = '$street', housenumber = '$housenumber' 
                WHERE user_id = $user_id";
                    mysqli_query($con, $adress_update_query);
                } else {
                    $insert_query = "INSERT INTO adress (zipcode, country, city, street, housenumber, user_id) 
                VALUES ($zipcode, '$country', '$city', '$street', $housenumber, $user_id)";
                    mysqli_query($con, $insert_query);
                }
            } catch (mysqli_sql_exception $e) {
                throw $e;
            }

            if (isset($cart)) {
                $cart = array_values($cart);
                for ($i = 0; $i < count($cart); $i++) {
                    $product_id = $cart[$i];
                    $quantity = 1;
                    try {
                        $check_query = "SELECT * FROM orders WHERE user_id = $user_id AND product_id = $product_id";
                        $check_result = $con->query($check_query);
                        if (mysqli_num_rows($check_result) > 0) {
                            $update_query = "UPDATE orders SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id";
                            mysqli_query($con, $update_query);
                        } else {
                            $insert_query = "INSERT INTO orders (quantity, user_id, product_id, created_at) VALUES ($quantity, $user_id, $product_id, '$today')";
                            mysqli_query($con, $insert_query);
                        }

                        $update_query2 = "UPDATE products SET product_quantity = product_quantity - $quantity WHERE product_id = $product_id";
                        mysqli_query($con, $update_query2);
                    } catch (mysqli_sql_exception $e) {
                        throw $e;
                    }
                }
            }


            unset($_SESSION['cart']);
            Mail_Model::order_success_email($user_id, $user_mail);
            header("Location: /app/order_success");
        }
    }
}
?>


<?php require($_SERVER['DOCUMENT_ROOT'] . "/app/views/payment.view.php"); ?>