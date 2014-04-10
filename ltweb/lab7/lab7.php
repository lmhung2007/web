<?php
/**
 * Created by PhpStorm.
 * User: bkand1909
 * Date: 4/10/14
 * Time: 3:35 PM
 */

require_once("Database.php");

if (!isset($_POST['type'])) {
    die;
}

$type = $_POST['type'];
switch ($type) {
    case "listing":
        echo get_all_cars();
        break;
    default:
        echo "0";
}

function get_all_cars()
{
    $db = new Database();
    return json_encode($db->get_all_cars());
}