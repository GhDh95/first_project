<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
require($_SERVER['DOCUMENT_ROOT'] . "/app/public/validation.php");

if (isset($_SESSION['user_email'])) {
    if (Validation::is_Admin($_SESSION['user_email'])) {
        header('location: /app/admin_profile');
        exit;
    }
}

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit;
}

$sql = "SELECT orders.id, products.product_name, orders.quantity, orders.created_at FROM orders
        INNER JOIN products ON orders.product_id = products.product_id
        WHERE user_id = {$_SESSION['user_id']}";

$result = $con->query($sql);


require($_SERVER['DOCUMENT_ROOT'] . "/app/views/orders.view.php");
