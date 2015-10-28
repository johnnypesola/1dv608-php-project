<?php
/**
 * Created by jopes
 * Date: 2015-10-27
 * Time: 00:34
 */

namespace controller;


class UserCtrl extends Controller
{
    private $auth;

    public function Index()
    {
        // Load dependencies
        $this->ctrlHelper->LoadBLLModel('User');
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');

        $auth = $this->ctrlHelper->CreateService('AuthService');

        if($auth->IsUserLoggedIn())
        {
            $userDAL = $this->ctrlHelper->CreateDALModel('UserDAL');
            $usersView = $this->ctrlHelper->CreateView('UsersView');

            $users = $userDAL->GetAll();


            $usersView->LoadUsersTemplate($users);

            // Get output
            $output = $usersView->GetOutput();

            // Render page
            $this->ctrlHelper->htmlView->Render($output, $auth->IsUserLoggedIn());
        }
        else
        {
            $this->ctrlHelper->RedirectTo('login');
        }
    }

    public function Add()
    {
        $this->ctrlHelper->LoadBLLModel('User');
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadService('AuthService');

        $user = new \model\User(
            null,
            "admin",
            "password"
        );

        $userDAL = new \model\UserDAL();

        $userDAL->Add($user);
    }
} 