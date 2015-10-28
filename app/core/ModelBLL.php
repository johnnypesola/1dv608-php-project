<?php

namespace model;


class ModelBLL {

    public function IsValidString($stringName, $stringContent, $constraints = []) {

        // Default values
        if(!isset($constraints['minLength'])) {
            $constraints['minLength'] = 1;
        }
        if(!isset($constraints['maxLength'])) {
            $constraints['maxLength'] = 100;
        }
        if(!isset($constraints['regex'])) {
            $constraints['regex'] = '/[^a-z_\-0-9åäöÅÄÖ!?#$@%&\=´`~^éèëÊËÈÉ+\/.,_*\'" ]/i';
        }
        // Do not throw exception as default
        if(!isset($constraints['throwException'])) {
            $constraints['throwException'] = false;
        }

        // Default messages
        if(!isset($constraints['emptyMsg'])) {
            $constraints['emptyMsg'] = "$stringName is missing";
        }
        if(!isset($constraints['minLengthMsg'])) {
            $constraints['minLengthMsg'] = "$stringName has too few characters, should be at least " . $constraints['minLength'] . " characters.";
        }
        if(!isset($constraints['maxLengthMsg'])) {
            $constraints['maxLengthMsg'] = "$stringName is too long. Max length is " . $constraints['maxLength'] . " characters.";
        }
        if(!isset($constraints['regexMsg'])) {
            $constraints['regexMsg'] = "$stringName contains invalid characters.";
        }

        // Check if $stringContent is an object
        if(is_object($stringContent)) {

            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['regexMsg']);
            }

            ValidationService::AddValidationError($constraints['regexMsg']);

            return false;
        }

        // Check if $stringContent is empty
        if($constraints['minLength'] == 1 && trim(strlen($stringContent)) == 0) {

            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['emptyMsg']);
            }

            ValidationService::AddValidationError($constraints['emptyMsg']);

            return false;
        }

        // Check if $stringContent is too short
        if($constraints['minLength'] > 1 && trim(strlen($stringContent)) < $constraints['minLength']) {

            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['minLengthMsg']);
            }

            ValidationService::AddValidationError($constraints['minLengthMsg']);

            return false;
        }

        // Check if $stringContent is too long
        if(strlen($stringContent) > $constraints['maxLength']) {

            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['maxLengthMsg']);
            }

            ValidationService::AddValidationError($constraints['maxLength']);

            return false;
        }

        // Check if $stringContent is valid
        if(preg_match($constraints['regex'], $stringContent)) {

            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['regexMsg']);
            }

            ValidationService::AddValidationError($constraints['regexMsg']);

            return false;
        }

        return true;
    }

    public function IsValidInt($intName, $intContent, $constraints = []) {

        // Default values
        if(!isset($constraints['minValue'])) {
            $constraints['minValue'] = ~PHP_INT_MAX; // PHP_INT_MAX is available in php 7.0.0<
        }
        if(!isset($constraints['maxValue'])) {
            $constraints['maxValue'] = PHP_INT_MAX;
        }
        // Do not throw exception as default
        if(!isset($constraints['throwException'])) {
            $constraints['throwException'] = false;
        }
        if(!isset($constraints['allowNull'])) {
            $constraints['allowNull'] = false;
        }


        // Default messages
        if(!isset($constraints['minValueMsg'])) {
            $constraints['minValueMsg'] = "$intName value is too low. " . $constraints['minValue'] . " is the lowest allowed value.";
        }
        if(!isset($constraints['maxValueMsg'])) {
            $constraints['maxValueMsg'] = "$intName value is too large. " . $constraints['maxValue'] . " is the largest allowed value.";
        }
        if(!isset($constraints['notNumericMsg'])) {
            $constraints['notNumericMsg'] = "$intName should be a number.";
        }

        // Check if $intContent is not numeric
        if(!($constraints['allowNull'] && is_null($intContent)) && !is_numeric($intContent) || is_float($intContent)) {

            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['notNumericMsg']);
            }

            ValidationService::AddValidationError($constraints['notNumericMsg']);

            return false;
        }

        // Check if $intContent is too low
        if($intContent < $constraints['minValue']) {

            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['minValueMsg']);
            }

            ValidationService::AddValidationError($constraints['minValueMsg']);

            return false;
        }

        // Check if $intContent is too large
        if($intContent > $constraints['maxValue']) {

            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['maxValueMsg']);
            }

            ValidationService::AddValidationError($constraints['maxValueMsg']);

            return false;
        }

        return true;
    }

    public function IsValidFloat($floatName, $floatContent, $constraints = []) {

        // Default values
        if(!isset($constraints['minValue'])) {
            $constraints['minValue'] = ~PHP_INT_MAX; // PHP_INT_MAX is available in php 7.0.0< & No specific float min value available in php
        }
        if(!isset($constraints['maxValue'])) {
            $constraints['maxValue'] = PHP_INT_MAX; // No specific float max value available in php
        }
        // Do not throw exception as default
        if(!isset($constraints['throwException'])) {
            $constraints['throwException'] = false;
        }

        // Default messages
        if(!isset($constraints['minValueMsg'])) {
            $constraints['minValueMsg'] = "$floatName value is too low. " . $constraints['minValue'] . " is the lowest allowed value.";
        }
        if(!isset($constraints['maxValueMsg'])) {
            $constraints['maxValueMsg'] = "$floatName value is too large. " . $constraints['maxValue'] . " is the largest allowed value.";
        }
        if(!isset($constraints['notFloatMsg'])) {
            $constraints['notFloatMsg'] = "$floatName should be a decimal value.";
        }

        // Check if $floatContent is not a float
        if(!is_float($floatContent)) {

            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['notFloatMsg']);
            }

            ValidationService::AddValidationError($constraints['notFloatMsg']);

            return false;
        }

        // Check if $floatContent is too low
        if($floatContent < $constraints['minValue']) {

            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['minValueMsg']);
            }

            ValidationService::AddValidationError($constraints['minValueMsg']);

            return false;
        }

        // Check if $stringContent is too large
        if($floatContent > $constraints['maxValue']) {

            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['maxValueMsg']);
            }

            ValidationService::AddValidationError($constraints['maxValueMsg']);

            return false;
        }

        return true;
    }

    public function IsValidBool($boolName, $boolContent, $constraints = [])
    {
        // Default messages
        if(!isset($constraints['notBoolMsg'])) {
            $constraints['notBoolMsg'] = "$boolName should be a boolean value.";
        }
        // Do not throw exception as default
        if(!isset($constraints['throwException'])) {
            $constraints['throwException'] = false;
        }

        // Check if its a valid bool
        if(!is_bool($boolContent))
        {
            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['notBoolMsg']);
            }

            ValidationService::AddValidationError($constraints['notBoolMsg']);

            return false;
        }

        return true;
    }

    protected function IsClassType($objName, $objContent, $constraints = [])
    {
        // Return false if classType is not defined
        if(!isset($constraints['classType'])) {
            $constraints['classType'] = 'Unspecified';
        }
        // Default settings
        if(!isset($constraints['allowNull'])) {
            $constraints['allowNull'] = false;
        }

        // Do not throw exception as default
        if(!isset($constraints['throwException'])) {
            $constraints['throwException'] = false;
        }

        // Default messages
        if(!isset($constraints['notClassTypeMsg'])) {
            $constraints['notClassTypeMsg'] = "$objName should be an object of type: " . $constraints['classType'];
        }


        // Check if its a valid class
        if(!($constraints['allowNull'] && is_null($objContent)) && !($objContent instanceof $constraints['classType']))
        {
            // Throw exception if specified
            if($constraints['throwException']) {
                throw new \Exception($constraints['notClassTypeMsg']);
            }

            ValidationService::AddValidationError($constraints['notClassTypeMsg']);

            return false;
        }

        return true;
    }
} 