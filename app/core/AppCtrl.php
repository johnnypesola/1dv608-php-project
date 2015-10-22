<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 13:22
 */

namespace controller;

use model\CtrlHelperService;
use model\AppSettings;

class AppCtrl extends Controller
{
    protected   $navigationView,
                $urlService;

    public      $controllerObj,
                $controllerStr,
                $methodStr,
                $parameters = [];


    # App settings
    private static $APP_SETTINGS_ARRAY = [
        'defaultController' => 'PortalCtrl',
        'defaultMethod' => 'Index',
        'controllerPath' => '../app/controller/',
        'controllerNamespace' => 'controller\\',
        'modelPath' => '../app/model/',
        'modelNamespace' => 'model\\',
        'viewPath' => '../app/view/',
        'viewNamespace' => 'view\\'
    ];

    // Constructor
    public function __construct()
    {
        // Setup app helper service
        $this->appHelper = new CtrlHelperService(
            $this,
            new AppSettings(self::$APP_SETTINGS_ARRAY)
        );

        // Setup navigation view
        $this->navigationView = new \view\NavigationView();

        // Parse and process url
        $this->appHelper->processUrl($this->navigationView->GetUrl());

        // Execute controller
        $this->appHelper->executeController($this->controllerObj, $this->methodStr, $this->parameters);
    }

    // Public methods


    // Private methods
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