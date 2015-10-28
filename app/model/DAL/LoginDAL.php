<?php
/**
 * Created by jopes
 * Date: 2015-10-25
 * Time: 14:26
 */

namespace model;


class LoginDAL extends ModelDAL
{

// Init variables
    private static $DB_TABLE_NAME = 'login';

    private static $DB_QUERY_ERROR = 'Fel vid hämntning av logins från databasen';
    private static $DB_GET_ERROR = 'Fel vid hämtning av login från databasen';
    private static $DB_INSERT_ERROR = 'Fel vid addering av login till databasen';
    private static $DB_UPDATE_ERROR = 'Fel vid uppdatering login i databasen';

// Constructor

// Public Methods


    public function Add(\model\User $user) {

        try {
            // Prepare db statement
            $statement = self::$db->prepare(
                'INSERT INTO ' . self::$DB_TABLE_NAME  .
                '(login_id, user_name, created)' .
                ' VALUES ' .
                '(NULL, :userName, NOW())'
            );

            // Prepare input array
            $inputArray = [
                'userName' => $user->GetUserName()
            ];

            // Execute db statement
            $statement->execute($inputArray);

            // Check if db insertion was successful
            return $statement->rowCount() == 1;

        } catch (\Exception $exception) {
            throw new \Exception(self::$DB_INSERT_ERROR);
        }
    }

    public function GetUserLoginsForHour(\model\User $user) {

        try {

            $returnArray = [];

            // Prepare db statement
            $statement = self::$db->prepare(
                'SELECT * FROM ' . self::$DB_TABLE_NAME .
                ' WHERE `user_name` = :userName AND ' .
                ' `created` LIKE \'' . date("Y-m-d H") . '%\''
            );

            // Prepare input array
            $inputArray = [
                'userName' => $user->GetUserName()
            ];

            // Execute db statement
            $statement->execute($inputArray);

            // Fetch rows
            $userRowsArray = $statement->fetchAll();

            return sizeOf($userRowsArray);

        } catch (\Exception $exception) {
            throw new \Exception(self::$DB_QUERY_ERROR);
        }

    }




} 