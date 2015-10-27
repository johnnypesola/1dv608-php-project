<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 14:41
 */

namespace controller;

use model\AuthService;
use view\LoginView;

class LoginCtrl extends Controller
{
    private $loginView,
            $htmlView,
            $auth;


    public function Index()
    {
        // Create view
        $this->loginView = $this->ctrlHelper->CreateView('LoginView');

        // Get output
        $output = $this->loginView->GetOutput();

        // Render page
        $this->ctrlHelper->htmlView->Render($output);
    }

    public function Attempt()
    {
        // Create view
        $this->loginView = $this->ctrlHelper->CreateView('LoginView');

        // Load file dependencies
        $this->ctrlHelper->LoadBLLModel('User');
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');
        $this->ctrlHelper->LoadService('UserClientService');

        // Create Auth service
        $this->auth = $this->ctrlHelper->CreateService('AuthService');

        // If user is already logged in
        if($this->auth->IsUserLoggedIn())
        {
            $this->ctrlHelper->RedirectTo("User");
        }

        // If user wants to login
        if($this->loginView->UserWantsToLogin())
        {
            // Get login attempt
            $loginAttemptArray = $this->loginView->GetLoginAttempt();

            // Create new user from login attempt
            $loginAttemptUser = new \model\User(NULL, $loginAttemptArray['username'], $loginAttemptArray['password'], false);

            // If there are no validation errors, proceed.
            if(\model\ValidationService::IsValid()) {

                // Try to authenticate user
                if ($user = $this->auth->Authenticate($loginAttemptUser)) {

                    // Store logged in user object in sessions cookie
                    $this->auth->KeepUserLoggedInForSession($user);

                    $this->ctrlHelper->RedirectTo("User");

                } else {

                    // The user was denied access
                    \model\FlashMessageService::Add("Wrong username or password", "warning");
                }
            }
            else
            {
                // Move errors to flash messages, witch will be displayed for user.
                \model\ValidationService::ConvertErrorsToFlashMessages();
            }
        }

        $this->ctrlHelper->RedirectTo($this);
    }
}