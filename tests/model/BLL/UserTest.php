<?php
/**
 * Created by jopes
 * Date: 2015-10-28
 * Time: 02:50
 */

namespace model;

require_once 'app/core/ModelBLL.php';
require_once 'app/model/AuthService.php';
require_once 'app/model/BLL/User.php';


class UserTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        // Clear validations
        \model\ValidationService::Clear();

        $user = new User(
            10, // Id
            "someusername",
            "firstname",
            "surname",
            "password",
            true, // Hash password
            true, // Check password, should be false when its hashed already. Then it will exceed the limit of 30 chars.
            "", // Token
            true // Hash token
        );

        // Check if password is hashed
        $this->assertTrue(password_verify("password", $user->GetPassword()));

        // Check other values
        $this->assertEquals("someusername", $user->GetUserName());
        $this->assertEquals("firstname", $user->GetFirstName());
        $this->assertEquals("surname", $user->GetSurName());
        $this->assertTrue($user->IsTokenHashed());
        $this->assertNotEmpty($user->GetToken());
        $this->assertTrue($user->IsPasswordHashed());

        // Should be valid
        $this->assertTrue(\model\ValidationService::IsValid());
    }

    public function testConstructorWithFaultyValues()
    {
        $user = new User(
            "not an int", // Id
            "someusername",
            "firstname",
            "surname",
            "password",
            true, // Hash password
            true, // Check password, should be false when its hashed already. Then it will exceed the limit of 30 chars.
            "", // Token
            true // Hash token
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();


        $user = new User(
            12, // Id
            "someusernameweawioeawioeuawoiduioawuoiawioeawoidjioawjeoiawjdoiajwoe",
            "firstname",
            "surname",
            "password",
            true, // Hash password
            true, // Check password, should be false when its hashed already. Then it will exceed the limit of 30 chars.
            "", // Token
            true // Hash token
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();


        $user = new User(
            12, // Id
            "someusername",
            "firstnameweawioeawioeuawoiduioawuoiawioeawoidjioawjeoiawjdoiajwoe",
            "surname",
            "password",
            true, // Hash password
            true, // Check password, should be false when its hashed already. Then it will exceed the limit of 30 chars.
            "", // Token
            true // Hash token
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();


        $user = new User(
            12, // Id
            "someusername",
            "firstnameweawioeawioeuawoiduioawuoiawioeawoidjioawjeoiawjdoiajwoe",
            "surname",
            "password",
            true, // Hash password
            true, // Check password, should be false when its hashed already. Then it will exceed the limit of 30 chars.
            "", // Token
            true // Hash token
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();

        $user = new User(
            12, // Id
            "someusername",
            "firstname",
            "surnameweawioeawioeuawoiduioawuoiawioeawoidjioawjeoiawjdoiajwoe",
            "password",
            true, // Hash password
            true, // Check password, should be false when its hashed already. Then it will exceed the limit of 30 chars.
            "", // Token
            true // Hash token
        );


        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();

        $user = new User(
            12, // Id
            "someusername",
            "firstname",
            "surname",
            "passwordweawioeawioeuawoiduioawuoiawioeawoidjioawjeoiawjdoiajwoe",
            true, // Hash password
            true, // Check password, should be false when its hashed already. Then it will exceed the limit of 30 chars.
            "", // Token
            true // Hash token
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();
    }
}
 