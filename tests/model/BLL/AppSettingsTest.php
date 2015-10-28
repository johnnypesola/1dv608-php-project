<?php
/**
 * Created by jopes
 * Date: 2015-10-28
 * Time: 02:03
 */

namespace model;

require_once 'app/core/ModelBLL.php';
require_once 'app/model/BLL/AppSettings.php';

class AppSettingsTest extends \PHPUnit_Framework_TestCase {


    public function testConstructor()
    {
        // Clear validations
        \model\ValidationService::Clear();

        $appSettings = new AppSettings(
            [
                'defaultController' => 'SomeCtrlerjaoijaiowjeioawjieojawoijtioajwirjaiwjeipajwpejapwepoawopr',
                'defaultMethod' => 'Index',
                'controllerPath' => '../app/controller/',
                'controllerNamespace' => 'controller\\',
                'modelPath' => '../app/model/',
                'modelNamespace' => 'model\\',
                'viewPath' => '../app/view/',
                'viewNamespace' => 'view\\'
            ]
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();

        $appSettings = new AppSettings(
            [
                'defaultController' => 'SomeCtrl',
                'defaultMethod' => 'Indexrjaoijaiowjeioawjieojawoijtioajwirjaiwjeipajwpejapwepoawopr',
                'controllerPath' => '../app/controller/',
                'controllerNamespace' => 'controller\\',
                'modelPath' => '../app/model/',
                'modelNamespace' => 'model\\',
                'viewPath' => '../app/view/',
                'viewNamespace' => 'view\\'
            ]
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();

        $appSettings = new AppSettings(
            [
                'defaultController' => 'SomeCtrl',
                'defaultMethod' => 'Index',
                'controllerPath' => '/var/temp/someEvilfile.php',
                'controllerNamespace' => 'controller\\',
                'modelPath' => '/etc/passwd',
                'modelNamespace' => 'model\\',
                'viewPath' => '/etc/sudoers.d',
                'viewNamespace' => 'view\\'
            ]
        );

        // Should be valid but still secure
        $this->assertTrue(\model\ValidationService::IsValid());

        $this->assertEquals('../app/someEvilfile.php/', $appSettings->GetControllerPath());
        $this->assertEquals('../app/passwd/', $appSettings->GetModelPath());
        $this->assertEquals('../app/sudoers.d/', $appSettings->GetViewPath());

        // Check that the rest of the get methods return correct values
        $this->assertEquals('SomeCtrl', $appSettings->GetDefaultController());
        $this->assertEquals('Index', $appSettings->GetDefaultMethod());
        $this->assertEquals('controller\\', $appSettings->GetControllerNamespace());
        $this->assertEquals('model\\', $appSettings->GetModelNamespace());
        $this->assertEquals('view\\', $appSettings->GetViewNamespace());
    }
}
 