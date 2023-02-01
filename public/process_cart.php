<?php

session_start();



$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['product_id'])) {

    $p_id = $data['product_id'];
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($p_id) && $p_id !== null) {

    array_push($_SESSION['cart'], $p_id);
}



header('Content-Type: application/json');
echo json_encode($_SESSION['cart']);
