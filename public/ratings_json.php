<?php


session_start();

require($_SERVER['DOCUMENT_ROOT'] . "/app/models/ratings.model.php");
$ratings = Ratings_model::return_all_ratings();




header('Content-Type: application/json');
echo json_encode($ratings);
