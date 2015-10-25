<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 14:41
 */

namespace controller;

use view\LoginView;

class LoginCtrl extends Controller
{
    private $loginView;

    public function Index()
    {
        $this->loginView = $this->ctrlHelper->CreateView('LoginView');


    }
}