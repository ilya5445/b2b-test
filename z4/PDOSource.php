<?php

namespace z4;

use PDO;
use PDOException;

class PDOSource {

    public static function connToDB() {

		$user = $_ENV['DB_USERNAME'];
		$pass = $_ENV['DB_PASSWORD'];
		$host = $_ENV['DB_HOST'];
		$db   = $_ENV['DB_DATABASE'];

        try {
            $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
			
			return $conn;

        } catch (PDOException $e) {
        	echo "Ошибка подключения к базе данных";
			die();
        }
	}

}
