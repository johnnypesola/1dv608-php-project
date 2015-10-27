<?php

namespace model;


abstract class FlashMessageService {

// Init variables
    private static $SESSION_COOKIE_NAME = 'flash_messages';


// Public Methods
    static public function DoesExist(){
        return isset($_SESSION[self::$SESSION_COOKIE_NAME]);
    }

    static public function GetAll(){

        $returnValue = false;

        assert(isset($_SESSION[self::$SESSION_COOKIE_NAME]));

        if(isset($_SESSION[self::$SESSION_COOKIE_NAME])) {

            $returnValue = $_SESSION[self::$SESSION_COOKIE_NAME];

            unset($_SESSION[self::$SESSION_COOKIE_NAME]);
        }

        return $returnValue;
    }

    static public function Add($message, $type = 'success') {
        $_SESSION[self::$SESSION_COOKIE_NAME][] = [
            'message' => $message,
            'type' => $type
        ];
    }
} 