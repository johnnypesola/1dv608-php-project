<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 13:33
 */

namespace controller;

class PortalCtrl extends Controller
{
    public function Index($name = 'brax', $yup = 'yeah')
    {
        echo 'portal/index<br>';

        echo $name . " " . $yup;
    }
}