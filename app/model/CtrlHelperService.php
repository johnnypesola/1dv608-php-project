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

    public  $urlParameters = [],
            $htmlView;
    //public $postedData = [];

// Constructor
    public function __construct($appObj, $appSettingsObj)
    {
        $this->appObj = $appObj;
        $this->appSettingsObj = $appSettingsObj;
        $this->htmlView = $appObj->htmlView;
    }

// Private methods
    private function ParseObjName($string)
    {
        return ucfirst(preg_replace("/[^A-Za-z]/","",$string));
    }

    private function GetController($controllerStr)
    {
        // Parse string
        $controllerStr = $this->ParseObjName($controllerStr) . 'Ctrl';

        // Create controller object
        $controllerObj = $this->createController($controllerStr);

        // If desired controller was not found, create default controller
        if(!$controllerObj)
        {
            $controllerObj = $this->createController($this->appSettingsObj->GetDefaultController());
        }

        return $controllerObj;
    }

    private function GetMethod($controllerObj, $methodStr)
    {
        // Parse string
        $methodStr = $this->ParseObjName($methodStr);

        // Check if method exists, then we will use that method
        if(method_exists($controllerObj, $methodStr))
        {
            return $methodStr;
        }

        return $this->appSettingsObj->GetDefaultMethod();
    }

    private function ParseUrlToArray($url)
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

    private function LoadFile($fileLocation)
    {
        if(file_exists($fileLocation))
        {
            require_once $fileLocation;
            return true;
        }
        return false;
    }

// Public methods

    public function RedirectTo($objOrString)
    {
        if(is_object($objOrString))
        {
            // Remove leading '\controller\' string and trailing 'Ctrl' string
            $ctrlName = strtolower(preg_replace('/^(.*?)(controller\\\)(.*?)(Ctrl)$/', '$3', get_class($objOrString)));
        }
        else
        {
            $ctrlName = strtolower($objOrString);
        }

        header('Location: /' . $ctrlName);
        die();
    }

    public function DoesUrlParamsExist()
    {
        return sizeof($this->urlParameters) > 0;
    }

    public function ProcessUrl($urlStr)
    {
        $urlArray = $this->ParseUrlToArray($urlStr);

        // Assign controller
        $this->appObj->controllerObj = $this->GetController($urlArray[0]);

        // Get and save controller string
        $this->appObj->controllerStr = get_class($this->appObj->controllerObj);

        // Unset array key, for collecting leftover params later.
        unset($urlArray[0]);

        // Assign method
        if(isset($urlArray[1]))
        {
            // Assign method
            $this->appObj->methodStr = $this->GetMethod($this->appObj->controllerObj, $urlArray[1]);

            unset($urlArray[1]);
        }
        else
        {
            $this->appObj->methodStr = $this->appSettingsObj->GetDefaultMethod();
        }

        // Assign the rest of the url as parameters with index starting at 0.
        $this->urlParameters = isset($urlArray[2]) ? array_values($urlArray) : [];
    }

    /*
    public function DoesPostedDataExist()
    {
        return sizeof($this->postedData) > 0;
    }

    public function ProcessPostedData($postedData)
    {
        $this->postedData = $postedData;
    }
    */

    public function ExecuteController($controllerObj, $methodStr, $parametersArray)
    {
        // Call the controllers method with parameters.
        call_user_func_array([$controllerObj, $methodStr], $parametersArray);
    }



// Load methods

    public function LoadController($controllerName)
    {
        return $this->LoadFile($this->appSettingsObj->GetControllerPath() . $controllerName . '.php');
    }

    public function LoadBLLModel($modelName)
    {
        return $this->LoadFile($this->appSettingsObj->GetModelPath() . 'BLL/' . $modelName . '.php');
    }

    public function LoadDALModel($modelName)
    {
        return $this->LoadFile($this->appSettingsObj->GetModelPath() . 'DAL/' . $modelName . '.php');
    }

    public function LoadService($serviceName)
    {
        return $this->LoadFile($this->appSettingsObj->GetModelPath() . $serviceName . '.php');
    }

    public function LoadView($viewName)
    {
        return $this->LoadFile($this->appSettingsObj->GetViewPath() . $viewName . '.php');
    }

// Create methods

    public function CreateController($controllerName)
    {
        if($this->LoadController($controllerName))
        {
            $controllerStr = $this->appSettingsObj->GetControllerNamespace() . $controllerName;
            return new $controllerStr($this);
        }

        return false;
    }

    public function CreateBLLModel($modelName)
    {
        if($this->LoadBLLModel($modelName))
        {
            $modelStr = $this->appSettingsObj->GetModelNamespace() . $modelName;
            return new $modelStr;
        }

        return false;
    }

    public function CreateDALModel($modelName)
    {
        if($this->LoadDALModel($modelName))
        {
            $modelStr = $this->appSettingsObj->GetModelNamespace() . $modelName;
            return new $modelStr;
        }

        return false;
    }

    public function CreateService($serviceName)
    {
        if($this->LoadService($serviceName))
        {
            $serviceStr = $this->appSettingsObj->GetModelNamespace() . $serviceName;
            return new $serviceStr;
        }

        return false;
    }

    public function CreateView($viewName)
    {
        if($this->LoadView($viewName))
        {
            $viewStr = $this->appSettingsObj->GetViewNamespace() . $viewName;
            return new $viewStr;
        }

        return false;
    }

} 