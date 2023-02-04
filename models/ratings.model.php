<?php
class Ratings_model
{

    public static function return_all_ratings()
    {
        $ratings = array();

        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT product_id, rating FROM ratings;";
        $result = $con->query($sql);
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($ratings, $row);
            }
        }
        return $ratings;
    }
}
