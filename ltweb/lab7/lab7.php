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
        echo delete_car($car_id);
        break;
    case 'update':
        $old_id = $_POST['old_id'];
        $id = $_POST['car_id'];
        $name = $_POST['car_name'];
        $year = $_POST['car_year'];
        echo update_car($old_id, $id, $name, $year);
        break;
    case 'insert':
        $id = $_POST['car_id'];
        $name = $_POST['car_name'];
        $year = $_POST['car_year'];
        echo insert_car($id, $name, $year);
        break;
}

function delete_car($car_id)
{
    return json_encode(Cars::delete_car($car_id));
}

function get_all_cars()
{
    return json_encode(Cars::get_all_cars());
}

function update_car($old_id, $id, $name, $year)
{
    return json_encode(Cars::update_car($old_id, $id, $name, $year));
}

function insert_car($id, $name, $year)
{
    return json_encode(Cars::insert_car($id, $name, $year));
}