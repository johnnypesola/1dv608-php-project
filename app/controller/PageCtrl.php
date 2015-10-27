<?php
/**
 * Created by jopes
 * Date: 2015-10-25
 * Time: 21:23
 */

namespace controller;


class PageCtrl extends Controller
{
    public function Index()
    {
        $this->Show();
    }

    public function Show()
    {
        if($this->ctrlHelper->DoesUrlParamsExist())
        {
            // Get specific page
            echo 'params';
        }
        else
        {
            // Get startpage
            echo 'no params';
        }
    }
} 