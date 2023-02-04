<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


$routes = [

    '/app/' => '/app/controllers/shop.php',
    '/app/cart' => '/app/controllers/cart.php',
    '/app/account_settings' => '/app/controllers/account_settings.php',
    '/app/admin_profile' => '/app/controllers/admin_profile.php',
    '/app/image_update' => '/app/controllers/image_update.php',
    '/app/profile_page' => '/app/controllers/profile_page.php',
    '/app/shop' => '/app/controllers/shop.php',
    '/app/image_upload' => '/app/controllers/image_upload.php',
    '/app/login' => '/app/controllers/login.php',
    '/app/orders' => '/app/controllers/orders.php',
    '/app/payment' => '/app/controllers/payment.php',
    '/app/product_update' => '/app/controllers/product_update.php',
    '/app/product_upload' => '/app/controllers/product_upload.php',
    '/app/rate' => '/app/controllers/rate.php',
    '/app/registration' => '/app/controllers/registration.php',
    '/app/request_password' => '/app/controllers/request_password.php',
    '/app/404_not_found' => '/app/controllers/404_not_found.php',
    '/app/payment' => '/app/controllers/payment.php',
    '/app/order_success' => '/app/controllers/order_success.php',
    '/app/registration_success' => '/app/views/registration_success.php',
    '/app/registration_verify' => '/app/views/registration_verify.php',
    '/app/change_email_success' => '/app/public/change_email_success.php',
    '/app/verification_success' => '/app/views/registration_success.php'

];

if (array_key_exists($uri, $routes)) {
    require($_SERVER['DOCUMENT_ROOT'] . "{$routes[$uri]}");
} else {
    require($_SERVER['DOCUMENT_ROOT'] . "{$routes['/app/404_not_found']}");
}
