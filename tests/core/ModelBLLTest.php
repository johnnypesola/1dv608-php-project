<?php
/**
 * Created by jopes
 * Date: 2015-10-28
 * Time: 00:09
 */

namespace model;

require_once 'app/core/ModelBLL.php';
require_once 'app/model/ValidationService.php';

class ModelBLLTest extends \PHPUnit_Framework_TestCase {

    public function testIsValidBool()
    {
        // Clear validations
        \model\ValidationService::Clear();

        $modelBll = new ModelBLL();

        // Assert string value
        $this->assertEquals(false, $modelBll->IsValidBool("someName", "string"));

        // Assert int value
        $this->assertEquals(false, $modelBll->IsValidBool("someName", 1));

        // Assert float value
        $this->assertEquals(false, $modelBll->IsValidBool("someName", 1.5));

        // Assert object value
        $this->assertEquals(false, $modelBll->IsValidBool("someName", new \stdClass()));

        // Assert bool value
        $this->assertEquals(true, $modelBll->IsValidBool("someName", false));

        // Assert null value
        $this->assertEquals(false, $modelBll->IsValidBool("someName", null));

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();
    }

    public function testIsValidFloat()
    {
        // Clear validations
        \model\ValidationService::Clear();

        $modelBll = new ModelBLL();

        // Assert string value
        $this->assertEquals(false, $modelBll->IsValidFloat("someName", "not a bool"));

        // Assert int value
        $this->assertEquals(false, $modelBll->IsValidFloat("someName", 1));

        // Assert float value
        $this->assertEquals(true, $modelBll->IsValidFloat("someName", 1.5));

        // Assert object value
        $this->assertEquals(false, $modelBll->IsValidFloat("someName", new \stdClass()));

        // Assert bool value
        $this->assertEquals(false, $modelBll->IsValidFloat("someName", false));

        // Assert null value
        $this->assertEquals(false, $modelBll->IsValidFloat("someName", null));

        // Assert options
        $this->assertEquals(false, $modelBll->IsValidFloat("someName", 1.6, ['minValue' => 1.7]));
        $this->assertEquals(false, $modelBll->IsValidFloat("someName", 2.2, ['maxValue' => 1.1]));

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();
    }

    public function testIsValidInt()
    {
        // Clear validations
        \model\ValidationService::Clear();

        $modelBll = new ModelBLL();

        // Assert string value
        $this->assertEquals(false, $modelBll->IsValidInt("someName", "string"));

        // Assert int value
        $this->assertEquals(true, $modelBll->IsValidInt("someName", 1));

        // Assert float value
        $this->assertEquals(false, $modelBll->IsValidInt("someName", 1.5));

        // Assert object value
        $this->assertEquals(false, $modelBll->IsValidInt("someName", new \stdClass()));

        // Assert bool value
        $this->assertEquals(false, $modelBll->IsValidInt("someName", false));

        // Assert null value
        $this->assertEquals(false, $modelBll->IsValidInt("someName", null));

        // Assert options
        $this->assertEquals(false, $modelBll->IsValidInt("someName", 1, ['minValue' => 2]));
        $this->assertEquals(false, $modelBll->IsValidInt("someName", 2, ['maxValue' => 1]));

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());
    }

    public function testIsValidString()
    {
        // Clear validations
        \model\ValidationService::Clear();

        $modelBll = new ModelBLL();

        // Assert string value
        $this->assertEquals(true, $modelBll->IsValidString("someName", "string"));

        // Assert int value
        $this->assertEquals(true, $modelBll->IsValidString("someName", 1));

        // Assert float value
        $this->assertEquals(true, $modelBll->IsValidString("someName", 1.5));

        // Assert object value
        $this->assertEquals(false, $modelBll->IsValidString("someName", new \stdClass()));

        // Assert bool value
        $this->assertEquals(false, $modelBll->IsValidString("someName", false));

        // Assert null value
        $this->assertEquals(false, $modelBll->IsValidString("someName", null));

        // Assert options
        $this->assertEquals(false, $modelBll->IsValidString("someName", "string", ['maxLength' => 2]));
        $this->assertEquals(false, $modelBll->IsValidString("someName", "string", ['minLength' => 20]));
        $this->assertEquals(false, $modelBll->IsValidString("someName", "<>>><><£$@£"));
        $this->assertEquals(false, $modelBll->IsValidString("someName", "abc123", ['regex' => '/[^a-z]/i']));

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());
    }
}

