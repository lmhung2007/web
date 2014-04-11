<?php
/**
 * Created by PhpStorm.
 * User: bkand1909
 * Date: 4/10/14
 * Time: 3:35 PM
 */

require_once("Cars.php");

if (!isset($_POST['type'])) {
    die;
}

$type = $_POST['type'];
switch ($type) {
    case "listing":
        echo get_all_cars();
        break;
    case 'delete':
        $car_id = $_POST['car_id'];
        delete_car($car_id);
        break;
}

function delete_car($car_id)
{
    $db = new Cars();
    $db->delete_car($car_id);
}

function get_all_cars()
{
    $db = new Cars();
    return json_encode($db->get_all_cars());
}