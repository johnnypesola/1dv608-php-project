<?php
/**
 * Created by jopes
 * Date: 2015-10-25
 * Time: 10:17
 */

namespace view;


class LoginView extends view
{
    // Init values
    private static $SUBMIT_INPUT_NAME = 'submit';
    private static $USERNAME_INPUT_NAME = 'username';
    private static $PASSWORD_INPUT_NAME = 'password';
    private static $REMEMBER_INPUT_NAME = 'remember';
    private static $COOKIE_VALID_DAYS = 30;
    private static $COOKIE_ID = 'remember_login';

    // Constructor
    public function __construct()
    {
        $this->LoadLoginTemplate();
    }

    // Private methods
    private function LoadLoginTemplate()
    {
        // Prepare data
        $fieldNamesArray = [
            'username' => self::$USERNAME_INPUT_NAME,
            'password' => self::$PASSWORD_INPUT_NAME,
            'submit' => self::$SUBMIT_INPUT_NAME,
            'remember' => self::$REMEMBER_INPUT_NAME
        ];

        $this->output .= $this->LoadTemplate('LoginTpl', ['fieldNames' => $fieldNamesArray]);
    }

    // Public methods
    public function GetLoginAttempt()
    {
        // Assert that user actually wants to login.
        assert($this->UserWantsToLogin());

        // Return array with login info.
        return array(
            'username' => $_POST[self::$USERNAME_INPUT_NAME],
            'password' => $_POST[self::$PASSWORD_INPUT_NAME]
        );
    }

    public function UserWantsToLogin() {
        return isset($_POST[self::$USERNAME_INPUT_NAME]) && isset($_POST[self::$PASSWORD_INPUT_NAME]);
    }

    public function UserWantsLoginToBeRemembered(){
        return isset($_POST[self::$REMEMBER_INPUT_NAME]) ? true : false;
    }

    public function SaveLoginOnClient(\model\User $user) {

        // Prepare values
        $cookieValues = implode(':', array($user->GetUserName(), $user->GetToken(), $user->GetSignature()));

        // Save values in cookie (expires in 30 days)
        return setcookie(self::$COOKIE_ID, $cookieValues, time() + 60 * 60 * 24 * self::$COOKIE_VALID_DAYS);
    }

    public function DeleteLoginSavedOnClient() {

        // Assert that cookie exists
        assert($this->IsLoginSavedOnClient());

        // Remove cookie, set expiration date to past.
        setcookie (self::$COOKIE_ID, "", time() - 3600);
    }

    public function IsLoginSavedOnClient() {
        return isset($_COOKIE[self::$COOKIE_ID]);
    }

    public function GetLoginSavedOnClient() {

        // Assert that cookie exists
        assert($this->IsLoginSavedOnClient());

        $cookieArray = explode(':', $_COOKIE[self::$COOKIE_ID]);

        // Check that cookie is ok
        if(sizeof($cookieArray) !== 3) {
            throw new \Exception('Wrong information in cookies');
        }

        // Create correct variables from array
        list($username, $token, $signature) = $cookieArray;

        // Return array with data
        return [
            "username" => $username,
            "token" => $token,
            "signature" => $signature
        ];
    }
} 