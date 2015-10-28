<?php
/**
 * Created by jopes
 * Date: 2015-10-25
 * Time: 14:42
 */

namespace model;


class GroupDAL extends ModelDAL {

    // Init variables
    private static $DB_TABLE_NAME = 'group';

    private static $DB_QUERY_ERROR = 'Fel vid hämtning av grupper från databasen';
    private static $DB_GET_ERROR = 'Fel vid hämtning av grupp från databasen';
    private static $DB_INSERT_ERROR = 'Fel vid addering av grupp till databasen';
    private static $DB_UPDATE_ERROR = 'Fel vid uppdatering av grupp till databasen';
    private static $DB_GROUP_NAME_EXISTS = 'En grupp med detta namn existerar redan, Var god välj ett annat namn.';

    private static $MAX_REGISTRATIONS_PER_HOUR = 30;

// Constructor

// Public Methods

    public function GetAll() {

        try {

            $returnArray = [];

            // Get data from database
            foreach(self::$db->query('SELECT `group_id`, `group_name` FROM `' . self::$DB_TABLE_NAME  . '`') as $row ) {

                // Create new object from database row
                $returnArray[] = new Group($row['group_id'], $row['group_name']);
            }

            return $returnArray;

        } catch (\Exception $exception) {
            throw new \Exception(self::$DB_QUERY_ERROR);
        }

    }

    public function GetGroupByName($groupName) {

        try {

            // Prepare db statement
            $statement = self::$db->prepare(
                'SELECT * FROM ' . self::$DB_TABLE_NAME .
                ' WHERE `user_name` = :userName'
            );

            // Prepare input array
            $inputArray = [
                'userName' => $username
            ];

            // Execute db statement
            $statement->execute($inputArray);

            // Fetch rows
            $userRowsArray = $statement->fetchAll();

            // Assert that there is no more than 1 users in database
            assert(sizeof($userRowsArray) <= 1);

            // Return found user or false
            if (sizeof($userRowsArray) > 0) {

                // Create new user
                return new \model\User(
                    $userRowsArray[0]['user_id'],
                    $userRowsArray[0]['user_name'],
                    $userRowsArray[0]['user_password'],
                    false,
                    false,
                    $userRowsArray[0]['user_token_hash'],
                    false
                );
            }

            return false;

        } catch (\Exception $exception) {

            throw new \Exception(self::$DB_GET_ERROR);
        }

    }

    public function Add(\model\Group $group){

        if($this->GetRegistrationsForHour() > self::$MAX_REGISTRATIONS_PER_HOUR) {
            throw new \Exception("Max number of registrations per hour reached. Please try again in 30-60 minutes.");
        }


        // Throw exception if username is taken
        if($this->GetUserByUsername($user->GetUserName())) {

            throw new \Exception(self::$DB_USERNAME_EXISTS);
        }

        try {
            // Prepare db statement
            $statement = self::$db->prepare(
                'INSERT INTO ' . self::$DB_TABLE_NAME  .
                '(user_id, user_name, user_password, created)' .
                ' VALUES ' .
                '(NULL, :userName, :password, NOW())'
            );

            // Prepare input array
            $inputArray = [
                'userName' => $user->GetUserName(),
                'password' => $user->GetPassword()
            ];

            // Execute db statement
            $statement->execute($inputArray);

            // Check if db insertion was successful
            return $statement->rowCount() == 1;

        } catch (\Exception $exception) {
            throw new \Exception(self::$DB_INSERT_ERROR);
        }

    }

} 