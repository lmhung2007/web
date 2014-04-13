<?php

/**
 * Created by PhpStorm.
 * User: hungle.info
 * Date: 4/11/14
 * Time: 12:10 AM
 */
class Cars
{
    public static $host = "localhost";
    public static $username = "root";
    public static $password = "";
    public static $database = "examples";
    public static $table = "cars";

    private static function encode_data($data)
    {
        return array("data" => $data, "success" => true);
    }

    private static function encode_error($error)
    {
        return array("error" => $error, "success" => false);
    }

    private static function execute($query)
    {
        $mysqli = @mysqli_connect(self::$host, self::$username, self::$password, self::$database);
        if (!$mysqli) {
            return self::encode_error(mysqli_connect_error());
        }
        if ($data = $mysqli->query($query)) {
            return self::encode_data($data);
        } else {
            return self::encode_error($mysqli->error);
        }
    }

    public static function get_all_cars()
    {
        $query = "SELECT id, name, year FROM " . self::$table;
        $result = self::execute($query);
        if ($result['success']) {
            $data = array();
            $cursor = $result['data'];
            while ($row = $cursor->fetch_assoc()) {
                $data[] = $row;
            }
            return self::encode_data($data);
        } else {
            return $result;
        }
    }

    public static function delete_car($id)
    {
        $id = addslashes($id);
        $query = "DELETE FROM " . self::$table . " WHERE id = " . $id;
        return self::execute($query);
    }

    private static function check_valid($id, $name, $year)
    {
        if (!is_numeric($id)) {
            return "id must be a number";
        }
        if (strlen($name) < 5 || strlen($name) > 40) {
            return "name must be 5-40 characters in length";
        }
        if (!is_numeric($year)) {
            return "year must be a number";
        }
        if ((int) $year < 1990 || (int) $year > 2013) {
            return "year must be between 1990 and 2013";
        }
        return null;
    }

    public static function update_car($old_id, $id, $name, $year)
    {
        $year = addslashes($year);
        $name = addslashes($name);
        $id = addslashes($id);
        $old_id = addslashes($old_id);
        if ($err = self::check_valid($id, $name, $year)) {
            return self::encode_error($err);
        }
        $query = "UPDATE " . self::$table . " SET id = $id, name = '$name', year = '$year' WHERE id = " . $old_id;
        return self::execute($query);
    }

    public static function insert_car($id, $name, $year)
    {
        $year = addslashes($year);
        $name = addslashes($name);
        $id = addslashes($id);
        if ($err = self::check_valid($id, $name, $year)) {
            return self::encode_error($err);
        }
        $query = "INSERT INTO " . self::$table . " VALUES ($id, '$name', '$year')";
        return self::execute($query);
    }
}

//var_dump(Cars::insert_car(0, "Hưng Lê", 1991));
//var_dump(Cars::get_all_cars());
//CArs::get_all_cars();
//var_dump(Cars::delete_car(1000));
//var_dump(Cars::update_car(200, "Hưng ' Lê", 1991));