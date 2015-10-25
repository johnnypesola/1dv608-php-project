<?php
/**
 * Created by jopes
 * Date: 2015-10-25
 * Time: 10:17
 */

namespace view;


class LoginView extends view
{

    public function __construct()
    {
        $this->LoadTemplate('HeaderTpl');
        $this->LoadTemplate('LoginTpl', ['somedata' => 'yeah']);
        $this->LoadTemplate('FooterTpl');
    }

    public function DisplayHtml()
    {

    }
} 