<?php

declare(strict_types=1);
namespace App\Database;

use PDO;

class Connection{
    private static ?PDO $instance = null;

    public static function getConnection(): PDO{
        if(self::$instance === null){
            $config = require __DIR__ . '/../../config/database.php';
            self::$instance = new PDO(
                    dsn: "pgsql:host=".$config['host'].
                        ";port=".$config['port'].
                        ";dbname=".$config['database']
                    ,
                    username: $config['user'],
                    password: $config['password'],
                    options: [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                        PDO::ATTR_STRINGIFY_FETCHES => false,
                    ],

                );
        }
        return self::$instance;
    }
}