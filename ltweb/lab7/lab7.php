<?php
/**
 * Created by PhpStorm.
 * User: bkand1909
 * Date: 4/10/14
 * Time: 3:35 PM
 */

require_once("Database.php");

//header("Content-Type: application/json");

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
    $db = new CarManager();
    return json_encode($db->get_all_cars());
}