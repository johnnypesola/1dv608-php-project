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
} 