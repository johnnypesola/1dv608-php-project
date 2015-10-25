<?php
/**
 * Created by jopes
 * Date: 2015-10-22
 * Time: 00:33
 */

namespace model;


class CtrlHelperService {

    private $appSettingsObj,
            $appObj;

// Constructor
    public function __construct($appObj, $appSettingsObj)
    {
        $this->appObj = $appObj;
        $this->appSettingsObj = $appSettingsObj;
    }

// Private methods
    private function parseObjName($string)
    {
        return ucfirst(preg_replace("/[^A-Za-z]/","",$string));
    }

    private function getController($controllerStr)
    {
        // Parse string
        $controllerStr = $this->parseObjName($controllerStr) . 'Ctrl';

        // Create controller object
        $controllerObj = $this->createController($controllerStr);

        // If desired controller was not found, create default controller
        if(!$controllerObj)
        {
            $controllerObj = $this->createController($this->appSettingsObj->GetDefaultController());
        }

        return $controllerObj;
    }

    private function getMethod($controllerObj, $methodStr)
    {
        // Parse string
        $methodStr = $this->parseObjName($methodStr);

        // Check if method exists, then we will use that method
        if(method_exists($controllerObj, $methodStr))
        {
            return $methodStr;
        }

        return $this->appSettingsObj->GetDefaultMethod();
    }

    private function parseUrlToArray($url)
    {
        $returnArray = [];

        if(isset($url)) {

            // Remove excess whitespace and slashes
            $url = rtrim($url);
            $url = ltrim($url, "/");

            // Sanitize url.
            $url = filter_var($url, FILTER_SANITIZE_URL);

            $returnArray = explode('/', $url);
        }

        return $returnArray;
    }

// Public methods
    public function processUrl($urlStr)
    {
        $urlArray = $this->parseUrlToArray($urlStr);

        // Assign controller
        $this->appObj->controllerObj = $this->getController($urlArray[0]);

        // Unset array key, for collecting leftover params later.
        unset($urlArray[0]);

        // Assign method
        if(isset($urlArray[1]))
        {
            // Assign method
            $this->appObj->methodStr = $this->getMethod($this->appObj->controllerObj, $urlArray[1]);

            unset($urlArray[1]);
        }
        else
        {
            $this->appObj->methodStr = $this->appSettingsObj->GetDefaultMethod();
        }

        // Assign the rest of the url as parameters with index starting at 0.
        $this->parameters = isset($urlArray[2]) ? array_values($urlArray) : [];
    }

    public function executeController($controllerObj, $methodStr, $parametersArray)
    {
        // Call the controllers method with parameters.
        call_user_func_array([$controllerObj, $methodStr], $parametersArray);
    }

// Create methods
    public function CreateController($controllerName)
    {
        $fileLocation = $this->appSettingsObj->GetControllerPath() . $controllerName . '.php';

        if(file_exists($fileLocation))
        {
            require_once $fileLocation;

            $controllerStr = $this->appSettingsObj->GetControllerNamespace() . $controllerName;
            return new $controllerStr($this);
        }

        return false;
    }

    public function CreateBLLModel($modelName)
    {
        $fileLocation = $this->appSettingsObj->GetModelPath() . 'BLL/' . $modelName . '.php';

        if(file_exists($fileLocation))
        {
            require_once $fileLocation;

            $modelStr = $this->appSettingsObj->GetModelNamespace() . $modelName;
            return new $modelStr;
        }

        return false;
    }

    public function CreateDALModel($modelName)
    {
        $fileLocation = $this->appSettingsObj->GetModelPath() . 'DAL/' . $modelName . '.php';

        if(file_exists($fileLocation))
        {
            require_once $fileLocation;

            $modelStr = $this->appSettingsObj->GetModelNamespace() . $modelName;
            return new $modelStr;
        }

        return false;
    }

    public function CreateService($serviceName)
    {
        $fileLocation = $this->appSettingsObj->GetModelPath() . $serviceName . '.php';

        if(file_exists($fileLocation))
        {
            require_once $fileLocation;

            $serviceStr = $this->appSettingsObj->GetModelNamespace() . $serviceName;
            return new $serviceStr;
        }

        return false;
    }

    public function CreateView($viewName, $data = [])
    {
        $fileLocation = $this->appSettingsObj->GetViewPath() . $viewName . '.php';

        if(file_exists($fileLocation))
        {
            require_once $fileLocation;

            $viewStr = $this->appSettingsObj->GetViewNamespace() . $viewName;
            return new $viewStr;
        }

        return false;
    }

} 