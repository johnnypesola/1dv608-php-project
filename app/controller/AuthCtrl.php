<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 14:41
 */

namespace controller;

use model\AuthService;
use view\LoginView;

class AuthCtrl extends Controller
{
    public function Index()
    {
        // Create view
        $loginView = $this->ctrlHelper->CreateView('LoginView');

        // Get output
        $output = $loginView->GetOutput();

        // Render page
        $this->ctrlHelper->htmlView->Render($output);
    }

    public function Logout()
    {
        // Load file dependencies
        $this->ctrlHelper->LoadBLLModel('User');
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');
        $this->ctrlHelper->LoadService('UserClientService');

        // Create Auth service
        $auth = $this->ctrlHelper->CreateService('AuthService');

        if($auth->IsUserLoggedIn())
        {
            $auth->ForgetUserLoggedIn();
        }

        $this->ctrlHelper->RedirectTo($this);
    }

    public function Login()
    {
        // Create view
        $loginView = $this->ctrlHelper->CreateView('LoginView');

        // Load file dependencies
        $this->ctrlHelper->LoadBLLModel('User');
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');
        $this->ctrlHelper->LoadService('UserClientService');

        // Create Auth service
        $auth = $this->ctrlHelper->CreateService('AuthService');

        // If user is already logged in
        if($auth->IsUserLoggedIn())
        {
            $this->ctrlHelper->RedirectTo("page");
        }

        // If user wants to login
        if($loginView->UserWantsToLogin())
        {
            // Get login attempt
            $loginAttemptArray = $loginView->GetLoginAttempt();

            // Create new user from login attempt
            $loginAttemptUser = new \model\User(NULL, $loginAttemptArray['username'], $loginAttemptArray['password'], false);

            // If there are no validation errors, proceed.
            if(\model\ValidationService::IsValid()) {

                // Try to authenticate user
                if ($user = $auth->Authenticate($loginAttemptUser)) {

                    // Store logged in user object in sessions cookie
                    $auth->KeepUserLoggedInForSession($user);

                    $this->ctrlHelper->RedirectTo("page");

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