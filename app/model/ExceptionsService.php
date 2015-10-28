<?php

namespace model;


class ExceptionsService {

// Init variables
    private static $exceptions = [];

// Constructor

// Getters and Setters

// Private Methods

// Public Methods
    static public function AddException(\Exception $exception) {
        self::$exceptions[] = $exception;
    }

    static public function GetLastExceptionMessage() {
        $exception = end(self::$exceptions);

        return [
            'message' => $exception->getMessage(),
            'type' => 'error'
        ];

    }

    static public function GetAllExceptionMessages() {
        $messagesArray = [];

        foreach (self::$exceptions as $exception) {
            $messagesArray[] = [
                'message' => $exception->getMessage(),
                'type' => 'error'
            ];;
        }

        return $messagesArray;
    }

    static public function HasExceptions() {
        return sizeof(self::$exceptions) > 0;
    }
} 