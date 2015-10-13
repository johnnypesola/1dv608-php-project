<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 13:22
 */

namespace controller;

class AppCtrl
{
    protected $controllerObj, $parameters, $url;
    protected $controllerStr = 'PortalCtrl';
    protected $methodStr = 'Index';
    protected $navigationView;

    // Constructor
    public function __construct()
    {
        // Setup navigation view
        $this->navigationView = new \view\NavigationView();

        // Get url from navigationView
        $this->url = $this->navigationView->GetUrl();

        // Parse and process url
        $this->processUrl($this->parseUrlToArray($this->url));

        // Execute controller
        $this->executeController($this->controllerStr, $this->methodStr, $this->parameters);
    }

    // Public methods
    public function parseUrlToArray($url)
    {
        $returnArray = [];

        if(isset($url)) {

            // Remove excess whitespace and slashes
            $url = rtrim($url);

            // Sanitize url.
            $url = filter_var($url, FILTER_SANITIZE_URL);

            $returnArray = explode('/', $url);
        }

        return $returnArray;
    }


    // Private methods
    private function executeController($controllerStr, $methodStr, $parametersArray)
    {
        // Call the controllers method with parameters.

        $this->printDebugInfo();
        call_user_func_array([$this->controllerObj, $methodStr], $parametersArray);
    }

    private function processUrl($urlArray)
    {
        // Assign controller
        if(isset($urlArray[0]))
        {
            // Parse value
            $this->controllerStr = $this->parseObjName($urlArray[0]) . 'Ctrl';
        }

        // Create controller object
        $this->createController($this->controllerStr);

        // Unset array key, for collecting leftover params later.
        unset($urlArray[0]);

        // Assign method
        if(isset($urlArray[1]))
        {

            // Parse value
            $methodStr = $this->parseObjName($urlArray[1]);

            // Check if method exists, then we will use that method
            if(method_exists($this->controllerObj, $methodStr))
            {
                // Assign method
                $this->methodStr = $methodStr;

                // Unset array key, for collecting leftover params later.
                unset($urlArray[1]);
            }
        }

        // Assign the rest of the url as parameters with index starting at 0.
        $this->parameters = isset($urlArray[2]) ? array_values($urlArray) : [];
    }

    private function createController($controllerStr)
    {
        // Check if controllers exists, then we will use that controller
        if(file_exists('../app/controller/' . $controllerStr . '.php')) {
            // Require controller
            require_once '../app/controller/' . $controllerStr . '.php';

            // Create controller
            $this->controllerObj = new $this->controllerStr;
        }
    }

    private function parseObjName($string)
    {
        return ucfirst(preg_replace("/[^A-Za-z]/","",$string));
    }

    private function printDebugInfo()
    {
        echo '<h3>Controller</h3><pre>';
        print_r($this->controllerObj);
        echo '</pre>';
        echo '<h3>Method</h3><pre>';
        print_r($this->methodStr);
        echo '</pre>';
        echo '<h3>Parameters</h3><pre>';
        print_r($this->parameters);
        echo '</pre>';
    }
}