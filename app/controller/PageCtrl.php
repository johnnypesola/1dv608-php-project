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
        if($this->ctrlHelper->DoUrlParamsExist())
        {
            // Get specific page
        }
        else
        {
            // Get startpage
            
        }
    }
} 