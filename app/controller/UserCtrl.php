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
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');
        $this->auth = $this->ctrlHelper->CreateService('AuthService');

        if($this->auth->IsUserLoggedIn())
        {
            echo 'user is logged in<br />';
        }
        else
        {
            echo 'user is NOT logged in<br />';
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