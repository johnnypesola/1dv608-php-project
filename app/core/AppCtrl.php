<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 13:22
 */

namespace controller;

use model\CtrlHelperService;
use model\AppSettings;
use view\HtmlView;

class AppCtrl extends Controller
{
    public      $htmlView,
                $controllerObj,
                $controllerStr,
                $methodStr,
                $parameters = [];


    # App settings
    private static $APP_SETTINGS_ARRAY = [
        'defaultController' => 'PageCtrl',
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
        // Setup html view
        $this->htmlView = new HtmlView();
        $this->htmlView->pageTitle = 'Fagersta Klätterklubb';
        $this->htmlView->pageHeader = 'Välkommen till Fagersta Klätterklubb';

        // Setup app helper service
        $this->ctrlHelper = new CtrlHelperService(
            $this,
            new AppSettings(self::$APP_SETTINGS_ARRAY)
        );

        // Load global requirements
        $this->ctrlHelper->LoadBLLModel('Page');
        $this->ctrlHelper->LoadDALModel('PageDAL');

        // Setup navigation view
        //$this->navigationView = $this->ctrlHelper->CreateView('NavigationView');

        // Parse and process url
        $this->ctrlHelper->ProcessUrl($this->htmlView->GetUrl());

        // Execute controller
        $this->ctrlHelper->ExecuteController($this->controllerObj, $this->methodStr, $this->parameters);
    }

    // Public methods

    // Private methods
}