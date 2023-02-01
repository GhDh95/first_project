<?php

session_start();

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['action']) && isset($data['product_id']) && isset($_SESSION['cart'])) {
    switch ($data['action']):
        case "add":
            array_push($_SESSION['cart'], $data['product_id']);
            break;
        case "minus":
            foreach ($_SESSION['cart'] as $key => $val) {
                if ($_SESSION['cart'][$key] == $data['product_id']) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
            break;
        case "delete":
            $_SESSION['cart'] = array_diff($_SESSION['cart'], [$data['product_id']]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            break;

    endswitch;
}

header('Content-Type: application/json');
echo json_encode($_SESSION['cart']);
