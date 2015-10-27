<?php
/**
 * Created by jopes
 * Date: 2015-10-22
 * Time: 01:18
 */

namespace model;


class AppSettings  extends ModelBLL {

// Init variables
    private $defaultController;
    private $defaultMethod;
    private $controllerPath;
    private $controllerNamespace;
    private $modelPath;
    private $modelNamespace;
    private $viewPath;
    private $viewNamespace;

    private static $constraints = [
        'defaultController' => [
            'maxLength' => 30,
        ],
        'defaultMethod' => [
            'maxLength' => 30,
        ],
        'controllerPath' => [
            'regex' => '/[^a-z_\-0-9\/\.]/i'
        ],
        'controllerNamespace' => [
            'regex' => '/[^a-z_\-0-9\/\\\]/i'
        ],
        'modelPath' => [
            'regex' => '/[^a-z_\-0-9\/\.]/i'
        ],
        'modelNamespace' => [
            'regex' => '/[^a-z_\-0-9\/\\\]/i'
        ],
        'viewPath' => [
            'regex' => '/[^a-z_\-0-9\/\.]/i'
        ],
        'viewNamespace' => [
            'regex' => '/[^a-z_\-0-9\/\\\]/i'
        ]
    ];

// Constructor
    public function __construct(
        $settingsArray
    ) {
        $this->SetDefaultController($settingsArray['defaultController']);
        $this->SetDefaultMethod($settingsArray['defaultMethod']);
        $this->SetControllerPath($settingsArray['controllerPath']);
        $this->SetControllerNamespace($settingsArray['controllerNamespace']);
        $this->SetModelPath($settingsArray['modelPath']);
        $this->SetModelNamespace($settingsArray['modelNamespace']);
        $this->SetViewPath($settingsArray['viewPath']);
        $this->SetViewNamespace($settingsArray['viewNamespace']);
    }

// Getters and Setters

    # DefaultController
    private function SetDefaultController($value) {

        // Check if value is valid
        if($this->IsValidString("defaultController", $value, self::$constraints["defaultController"])) {

            // Set value
            $this->defaultController = trim($value);

            return true;
        }

        return false;
    }

    public function GetDefaultController() {
        return $this->defaultController;
    }

    # DefaultMethod
    private function SetDefaultMethod($value) {

        // Check if value is valid
        if($this->IsValidString("defaultMethod", $value, self::$constraints["defaultMethod"])) {

            // Set value
            $this->defaultMethod = trim($value);

            return true;
        }

        return false;
    }

    public function GetDefaultMethod() {
        return $this->defaultMethod;
    }

    # ControllerPath
    private function SetControllerPath($value) {

        // Check if value is valid
        if($this->IsValidString("controllerPath", $value, self::$constraints["controllerPath"])) {

            // Set value
            $this->controllerPath = trim($value);

            return true;
        }

        return false;
    }

    public function GetControllerPath() {
        return $this->controllerPath;
    }


    # ControllerNamespace
    private function SetControllerNamespace($value) {

        // Check if value is valid
        if($this->IsValidString("controllerNamespace", $value, self::$constraints["controllerNamespace"])) {

            // Set value
            $this->controllerNamespace = trim($value);

            return true;
        }

        return false;
    }

    public function GetControllerNamespace() {
        return $this->controllerNamespace;
    }

    # ModelPath
    private function SetModelPath($value) {

        // Check if value is valid
        if($this->IsValidString("modelPath", $value, self::$constraints["modelPath"])) {

            // Set value
            $this->modelPath = trim($value);

            return true;
        }

        return false;
    }

    public function GetModelPath() {
        return $this->modelPath;
    }

    # ModelNamespace
    private function SetModelNamespace($value) {

        // Check if value is valid
        if($this->IsValidString("modelNamespace", $value, self::$constraints["modelNamespace"])) {

            // Set value
            $this->modelNamespace = trim($value);

            return true;
        }

        return false;
    }

    public function GetModelNamespace() {
        return $this->modelNamespace;
    }

    # ViewPath
    private function SetViewPath($value) {

        // Check if value is valid
        if($this->IsValidString("viewPath", $value, self::$constraints["viewPath"])) {

            // Set value
            $this->viewPath = trim($value);

            return true;
        }

        return false;
    }

    public function GetViewPath() {
        return $this->viewPath;
    }

    # ViewNamespace
    private function SetViewNamespace($value) {

        // Check if value is valid
        if($this->IsValidString("viewNamespace", $value, self::$constraints["viewNamespace"])) {

            // Set value
            $this->viewNamespace = trim($value);

            return true;
        }

        return false;
    }

    public function GetViewNamespace() {
        return $this->viewNamespace;
    }

// Private Methods

} 