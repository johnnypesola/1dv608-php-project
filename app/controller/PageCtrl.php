<?php
/**
 * Created by jopes
 * Date: 2015-10-25
 * Time: 21:23
 */

namespace controller;


use model\Page;

class PageCtrl extends Controller
{
    public function Index()
    {
        $this->Show();
    }

    public function Show()
    {
        // Create view
        $pageView = $this->ctrlHelper->CreateView('PageView');

        // Load file dependencies
        $this->ctrlHelper->LoadBLLModel('Page');
        $this->ctrlHelper->LoadDALModel('PageDAL');
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');

        $auth = $this->ctrlHelper->CreateService('AuthService');


        if($this->ctrlHelper->DoesUrlParamsExist())
        {
            // Get specific page
            $page = new Page(null, "En specifik sida", "Men specifik innehåll");
        }
        else
        {
            // Get startpage
            $page = new Page(null, "På gång", "Här händer det grejer");
        }

        // Load page output
        $pageView->LoadPage($page, $auth->IsUserLoggedIn());

        // Get output
        $output = $pageView->GetOutput();

        // Render page
        $this->ctrlHelper->htmlView->Render($output);
    }
} 