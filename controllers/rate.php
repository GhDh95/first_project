<?php

require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/validation.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: /app/login');
    exit;
}

if (isset($_SESSION['user_email'])) {
    if (Validation::is_Admin($_SESSION['user_email'])) {
        header('location: /app/admin_profile');
        exit;
    }
}
$rate_msg = "";
$user_id = $_SESSION['user_id'];

$sql = "SELECT DISTINCT product_name FROM Orders JOIN Products ON Orders.product_id = Products.product_id 
    WHERE $user_id = user_id";

$result = $con->query($sql);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $rating = (int) $_POST['rating'];
    $product_name = (string) $_POST['product_name'];

    $sql2 = "SELECT product_id FROM products WHERE product_name = '$product_name'";

    $result2 = mysqli_query($con, $sql2);
    $row = mysqli_fetch_assoc($result2);
    $product_id = $row["product_id"];

    try {
        $check_query = "SELECT * FROM ratings WHERE user_id = $user_id AND product_id = $product_id";
        $check_result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            $update_query = "UPDATE ratings SET rating = $rating WHERE user_id = $user_id AND product_id = $product_id";
            mysqli_query($con, $update_query);
        } else {
            $insert_query = "INSERT INTO ratings (rating, user_id, product_id) VALUES ($rating, $user_id, $product_id)";
            mysqli_query($con, $insert_query);
        }
        $rate_msg = "Product rated!";
    } catch (mysqli_sql_exception $e) {
        throw $e;
    }
}
?>

<?php require($_SERVER['DOCUMENT_ROOT'] . "/app/views/rate.view.php"); ?>