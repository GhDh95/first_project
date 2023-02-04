<?php


class Image_Model
{

    public static function add_image_by_prod_id($prod_id, $image_path)
    {

        $image_path = htmlspecialchars(trim($image_path));
        $prod_id = htmlspecialchars(trim($prod_id));
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "INSERT INTO images (product_id, image_path) VALUES('{$prod_id}','{$image_path}');";
        if (!$con->query($sql)) {
            die('Error: ' . $con->error);
        }
        $con->close();
    }

    public static function get_image_path_by_id($id)
    {

        $images = [];

        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT image_id, image_path FROM images WHERE product_id = '{$id}'";
        $result = $con->query($sql);
        if (!$result) { //
            die('Error: ' . $con->error);
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $images[] = array($row['image_id'] => $row['image_path']);
            }
        }
        $con->close();

        return $images;
    }

    /*  public static update_image_path($path, $product_id){
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "UPDATE images SET image_path = '{$path}' WHERE product_id = '{$product_id}' AND image_path = '{}' ";
    } */

    public static function update_image_path($product_id, $image_id, $image_path, &$err_msg)
    {
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "UPDATE images SET image_path = '{$image_path}' WHERE image_id = '{$image_id}'  AND product_id ='{$product_id}' ";
        try {
            if ($con->query($sql)) {
                $err_msg = "Image was updated successfully.";
            }
        } catch (Exception $e) {
            $err_msg = "Image update failed";
        }
        $con->close();
    }

    public static function get_images($id)
    {

        $images = [];

        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT image_path FROM images WHERE product_id = '{$id}'";

        $result = $con->query($sql);
        if (!$result) {
            die('Error: ' . $con->error);
        }


        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($images, $row['image_path']);
            }
        }
        $con->close();


        return $images;
    }
}
