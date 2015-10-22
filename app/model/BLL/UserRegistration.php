<?php

namespace model;


class UserRegistration extends ModelBLL {

// Init variables
    private $userName;
    private $password;

    private static $constraints = [
        'username' => [
            'minLength' => 3,
            'maxLength' => 30
        ],
        'password' => [
            'minLength' => 6,
            'maxLength' => 30,
            'doNotMatchMsg' => "Passwords do not match."
        ]
    ];

// Constructor
    public function __construct(
        $username,
        $password = "",
        $passwordRepeat = ""
    ) {
        $this->SetUserName($username);
        $this->SetPassword($password, $passwordRepeat);
    }

// Getters and Setters

    # Username
    public function SetUserName($value) {

        // Check if username is valid
        if($this->IsValidString("Username", $value, self::$constraints["username"])) {

            // Set username
            $this->userName = trim($value);

            return true;
        }

        return false;
    }

    public function GetUserName() {
        return $this->userName;
    }

    # Password
    public function SetPassword($value, $repeatValue) {

        // Check if passwords match
        if($value != $repeatValue) {
            ValidationService::AddValidationError(self::$constraints['password']['doNotMatchMsg']);

            return false;
        }

        // Check if password is valid
        if ($this->IsValidString("Password", $value, self::$constraints["password"])) {

            // Set password
            $this->password = trim($value);

            return true;
        }

        return false;
    }

    public function GetPassword() {
        return $this->password;
    }


// Private Methods

}