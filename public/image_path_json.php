<?php

require($_SERVER['DOCUMENT_ROOT'] . "/app/models/image.model.php");

/* this is used to access the value sent from the js script */
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$p_id = $data['val'];

/* this returns an array containing all relative paths assigned to the id */
$images_link = Image_Model::get_image_path_by_id($p_id);



header('Content-Type: application/json');
echo json_encode($images_link);
