<?php

/**
 * Created by PhpStorm.
 * User: hungle.info
 * Date: 4/11/14
 * Time: 12:10 AM
 */
class Database
{
    public $host = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "examples";
    public $table = "cars";

    private $db_handle;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->db_handle = mysql_connect($this->host, $this->username, $this->password)
        or die("Unable to connect to MySQL");
        mysql_select_db($this->database, $this->db_handle);
    }

    public function get_all_cars()
    {
        $query = "SELECT id, name, year FROM $this->table";
        $result = mysql_query($query);
        $data = array();
        while ($row = mysql_fetch_assoc($result)) {
            $data[] = json_encode($row).PHP_EOL;
        }
        return $data;
    }
}