<?php
class Database {
    public static $connection;

    public static function setUpConnection() {
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "USERNAME", "PASSWORD", "newtech", "3306");

            // Check for connection errors
            if (Database::$connection->connect_error) {
                die("Connection failed: " . Database::$connection->connect_error);
            }
        }
    }

    public static function iud($q) {
        Database::setUpConnection();
        if (Database::$connection->query($q)) {
            return true;
        } else {
            // Log the error for debugging
            error_log("Query Error: " . Database::$connection->error);
            return false;
        }
    }

    public static function search($q) {
        Database::setUpConnection();
        $resultset = Database::$connection->query($q);

        // Check for query errors
        if (!$resultset) {
            error_log("Query Error: " . Database::$connection->error);
            return false;
        }

        return $resultset;
    }
}
