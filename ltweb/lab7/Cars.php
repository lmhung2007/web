<?php

/**
 * Created by PhpStorm.
 * User: hungle.info
 * Date: 4/11/14
 * Time: 12:10 AM
 */
class Cars
{
    public $host = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "examples";
    public $table = "cars";

    private $db_handle;
    private $mysqli;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->database)
        or die("Unable to connect to MySQL");
    }

    public function get_all_cars()
    {
        $query = "SELECT id, name, year FROM " . $this->table;
        $result = mysqli_query($this->mysqli, $query);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function delete_car($car_id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = " . $car_id;
        mysqli_query($this->mysqli, $query);
    }
}

$db = new Cars();
$db->get_all_cars();