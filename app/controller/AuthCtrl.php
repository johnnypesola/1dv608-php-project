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

        // Load file dependencies
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');
        $this->ctrlHelper->LoadService('UserClientService');

        // Create Auth service
        $auth = $this->ctrlHelper->CreateService('AuthService');

        // Get output
        $output = $loginView->GetOutput();

        // If user has a persistent login
        if($loginView->IsLoginSavedOnClient() && !$auth->IsUserLoggedIn())
        {
            // Get client login info
            $userInfoArray = $loginView->GetLoginSavedOnClient();

            // Create new user object
            $user = new \model\User(
                NULL,
                $userInfoArray['username'],
                NULL,
                NULL,
                NULL,
                false,
                false,
                $userInfoArray['token'],
                false
            );

            // Try to auth persistent login user
            if($auth->AuthenticatePersistent($user))
            {
                // Store logged in user object in sessions cookie
                $auth->KeepUserLoggedInForSession($user);

                \model\FlashMessageService::Add("Successfully logged in.");

                $this->ctrlHelper->RedirectTo("page/show");
            }
            else
            {
                // Delete client persistent login data on failed auth
                $loginView->DeleteLoginSavedOnClient();
            }
        }

        // Render page
        $this->ctrlHelper->htmlView->Render($output);
    }

    public function Logout()
    {
        // Create view
        $loginView = $this->ctrlHelper->CreateView('LoginView');

        // Load file dependencies
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');
        $this->ctrlHelper->LoadService('UserClientService');

        // Create Auth service
        $auth = $this->ctrlHelper->CreateService('AuthService');

        if($auth->IsUserLoggedIn())
        {
            // Remove server stored login data
            $auth->ForgetUserLoggedIn();

            // Remove client stored login data
            if($loginView->IsLoginSavedOnClient())
            {
                $loginView->DeleteLoginSavedOnClient();
            }
        }

        \model\FlashMessageService::Add("Successfully logged out.");

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
            $loginAttemptUser = new \model\User(
                NULL,
                $loginAttemptArray['username'],
                "",
                "",
                $loginAttemptArray['password'],
                false
            );

            // If there are no validation errors, proceed.
            if(\model\ValidationService::IsValid()) {

                // Try to authenticate user
                if ($user = $auth->Authenticate($loginAttemptUser)) {

                    // Store logged in user object in sessions cookie
                    $auth->KeepUserLoggedInForSession($user);

                    if($loginView->UserWantsLoginToBeRemembered())
                    {
                        // Save persistent login on server
                        $auth->SaveLoginOnServer($user);

                        $loginView->SaveLoginOnClient($user);
                    }

                    \model\FlashMessageService::Add("Successfully logged in.");

                    $this->ctrlHelper->RedirectTo("page/show");

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