<?php


class Product_Model
{
    public static function add_product($prod_name, $prod_categ, $prod_price, $prod_qty, $prod_desc)
    {

        /* Filtering input */
        $prod_name = htmlspecialchars(trim($prod_name));
        $prod_categ = htmlspecialchars(trim($prod_categ));
        $prod_price = htmlspecialchars(trim($prod_price));
        $prod_qty = htmlspecialchars(trim($prod_qty));
        $prod_desc = htmlspecialchars(trim($prod_desc));

        /* SQL */
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "INSERT INTO products (product_name,product_category, product_price, product_quantity, product_description) VALUES('{$prod_name}','{$prod_categ}','{$prod_price}','{$prod_qty}','{$prod_desc}')";
        if (!$con->query($sql)) {
            die('Error: ' . $con->error);
        }
        $con->close();
    }

    /* Used to display list of products in "update product" page */
    public static function get_product_info()
    {
        $product = [];
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT * FROM products";
        $result = $con->query($sql);
        if (!$result) {
            die('Error: ' . $con->error);
        }
        $con->close();
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $product[] = $row;
            }
        }

        return $product;
    }


    public static function update_product()
    {

        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");

        /* used to save values from Post */
        $columns = [
            'product_id' => '', 'product_name' => '', 'product_category' => '', 'product_price' => '', 'product_quantity' => '', 'product_description' => ''
        ];


        $sql = "UPDATE products SET ";

        /* removes the last 2 inputs as they are not needed for SQL*/
        if (isset($_POST)) {
            $_POST = array_splice($_POST, 0, -1);

            foreach ($_POST as $key => $value) {
                $columns[$key] = $value;
            }
        }
        /* checks if prod id exists in DB, if not return false */
        if (!self::id_exists($columns['product_id'])) {
            return false;
        }
        /* this is building SQL statement one iteration at a time */
        foreach ($columns as $key => $val) {
            if (empty($val)) {
                continue;
            }
            $sql .= "{$key} = '{$val}', ";
        }

        $sql = substr($sql, 0, strlen($sql) - 2);

        $sql .= " WHERE product_id = {$columns['product_id']};";

        $result = $con->query($sql);
        if (!$result) {
            die('Error: ' . $con->error);
        }
        /* if there is a change in DB, as in the update was successful */
        if (mysqli_affected_rows($con) > 0) {
            $con->close();
            return true;
        }

        $con->close();
        return false;
    }




    public static function get_prod_info_by_ID($id)
    {
        $id = htmlspecialchars($id);

        $product = [];
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT * FROM products WHERE product_id = '{$id}'";

        $result = $con->query($sql);
        if (!$result) {
            die('Error: ' . $con->error);
        }
        $con->close();


        if (mysqli_num_rows($result) > 0) {
            $product = $result->fetch_assoc();
        }
        return $product;
    }

    public static function id_exists($id)
    {
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT * FROM products WHERE product_id = '{$id}';";
        $result = $con->query($sql);
        $con->close();
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    public static function delete_product($id)
    {
        $id = htmlspecialchars(trim($id));
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "DELETE FROM products WHERE product_id = '{$id}';";
        $result = $con->query($sql);
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }
        $rows = mysqli_affected_rows($con);
        $con->close();
        if ($rows > 0) {

            return true;
        }
        return false;
    }

    public static function get_prod_qty()
    {
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "SELECT product_id, product_quantity, product_name FROM products;";
        $result = $con->query($sql);
        $res = [];
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }

        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $res[] = $row;
            }
        }

        $con->close();
        return $res;
    }

    public static function delete_correspoding_imgs($id)
    {
        $id = htmlspecialchars(trim($id));
        $con = require($_SERVER['DOCUMENT_ROOT'] . "/app/public/connect.php");
        $sql = "DELETE FROM images WHERE product_id = '{$id}';";
        $result = $con->query($sql);
        if (!$result) {
            die('Error: could not run query: ' . $con->error);
        }
        $rows = mysqli_affected_rows($con);
        $con->close();
        if ($rows > 0) {

            return true;
        }
        return false;
    }
}
