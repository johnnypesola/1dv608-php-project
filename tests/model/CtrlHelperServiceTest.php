<?php
/**
 * Created by jopes
 * Date: 2015-10-28
 * Time: 03:52
 */

namespace controller;

require_once 'app/model/CtrlHelperService.php';
require_once 'app/model/BLL/AppSettings.php';
require_once 'app/core/Controller.php';
require_once 'app/controller/PageCtrl.php';
require_once 'app/model/FlashMessageService.php';

class DummyClass {
    public static $shared;

    public function DummyMethod ($arg = "")
    {
        \model\FlashMessageService::Add("something");
    }
}

class CtrlHelperServiceTest extends \PHPUnit_Framework_TestCase {

    private function setupAppsettings()
    {
        return new \model\AppSettings(
            [
                'defaultController' => 'PageCtrl',
                'defaultMethod' => 'Index',
                'controllerPath' => 'app/controller/',
                'controllerNamespace' => 'controller\\',
                'modelPath' => 'app/model/',
                'modelNamespace' => 'model\\',
                'viewPath' => 'app/view/',
                'viewNamespace' => 'view\\'
            ]
        );
    }

    public function testConstructor()
    {
        // Clear validations
        \model\ValidationService::Clear();

        $appSettings = $this->setupAppsettings();

        // Create app mockup object with properties
        $appMockup = new \stdClass();
        $appMockup->htmlView = new \stdClass();

        // Create ctrl helper class
        $ctrlHelper = new \model\CtrlHelperService($appMockup, $appSettings);

        // Check that values are correct
        $this->assertEquals($appMockup->htmlView, $ctrlHelper->htmlView);
    }

    public function testMethods()
    {

        // Clear validations
        \model\ValidationService::Clear();

        $appSettings = $this->setupAppsettings();

        // Create app mockup object with properties
        $appMockup = new \stdClass();
        $appMockup->htmlView = new \stdClass();

        // Create ctrl helper class
        $ctrlHelper = new \model\CtrlHelperService($appMockup, $appSettings);

        // Ctrl to string method
        $CtrlString = $ctrlHelper->CtrlToString(new \controller\PageCtrl($ctrlHelper));

        $this->assertEquals("page", $CtrlString);



        // ProcessUrl method
        // $ctrlHelper->ProcessUrl('/page/leading/somewhere'); Not testable

        // Execute controller method
        $ctrlHelper->ExecuteController(new DummyClass(), "DummyMethod", ["someParam"]);

        // A new flashmessage should be added.
        $this->assertTrue(\model\FlashMessageService::DoesExist());

        // Clear flashmessage
        \model\FlashMessageService::Clear();


        $riskyFile = '/etc/passwd';

        // Load methods
        $this->assertFalse($ctrlHelper->LoadController($riskyFile));
        $this->assertFalse($ctrlHelper->LoadBLLModel($riskyFile));
        $this->assertFalse($ctrlHelper->LoadDALModel($riskyFile));
        $this->assertFalse($ctrlHelper->LoadService($riskyFile));
        $this->assertFalse($ctrlHelper->LoadView($riskyFile));

        // Create methods
        $this->assertFalse($ctrlHelper->CreateController($riskyFile));
        $this->assertFalse($ctrlHelper->CreateBLLModel($riskyFile));
        $this->assertFalse($ctrlHelper->CreateDALModel($riskyFile));
        $this->assertFalse($ctrlHelper->CreateService($riskyFile));
        $this->assertFalse($ctrlHelper->CreateView($riskyFile));
    }
}
 