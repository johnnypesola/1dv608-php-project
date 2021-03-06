<?php

namespace model;


abstract class ModelDAL {

// Init variables

    private static $DB_SETTINGS = [
        "type" => "mysql",
        "name" => "fagerstaklatterklubb",
        "username" => "climber",
        "password" => "3tzEnDQsVnBVGzWF",
        "charset" => "utf8",
        "host" => "localhost"
    ];

    private static $DB_CONNECT_ERROR = 'Fel vid anslutning till databasen. Var vänligt kontakta sidansvarig.';

    protected static $db;

// Constructor
    public function __construct() {

        // Setup pdo
        $this->SetupDB();
    }

// Getters and Setters


// Private methods
    private static function SetupDB() {

        try {
            // Setup DSN string
            $dsn = self::$DB_SETTINGS['type'] . ':dbname=' . self::$DB_SETTINGS['name'] . ';host=' . self::$DB_SETTINGS['host'] . ';charset=' . self::$DB_SETTINGS['charset'];

            // Connect to an ODBC database using driver invocation
            self::$db = new \PDO(
                $dsn,
                self::$DB_SETTINGS['username'],
                self::$DB_SETTINGS['password']
            );

            // Set error mode to silent
            self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);

        } catch (\Exception $exception) {
            throw new \PDOException(self::$DB_CONNECT_ERROR);
        }
    }
}

