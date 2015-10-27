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
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');

        $pages = $this->ctrlHelper->CreateDALModel('PageDAL');

        $auth = $this->ctrlHelper->CreateService('AuthService');


        if($this->ctrlHelper->DoesUrlParamsExist())
        {
            // Get specific page
            $page = new Page(null, "En specifik sida", "Men specifik innehåll");
        }
        else
        {
            // Get startpage
            $page = $pages->Get('start');
        }

        // Load page output
        $pageView->LoadPage($page, $auth->IsUserLoggedIn());

        // Get output
        $output = $pageView->GetOutput();

        // Render page
        $this->ctrlHelper->htmlView->Render($output, $auth->IsUserLoggedIn());
    }


    public function Save()
    {
        // Create view
        $pageView = $this->ctrlHelper->CreateView('PageView');

        // Load file dependencies
        $this->ctrlHelper->LoadBLLModel('Page');
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');

        $pages = $this->ctrlHelper->CreateDALModel('PageDAL');
        $auth = $this->ctrlHelper->CreateService('AuthService');

        if($auth->IsUserLoggedIn())
        {
            $pageInfoArray = $pageView->GetPageToSave();

            // Get logged in user
            $user = $auth->GetLoggedInUser();

            // Create new page
            $page = new \model\Page(
                $pageInfoArray['pageId'],
                $pageInfoArray['header'],
                $pageInfoArray['content'],
                $user->GetUsername(),
                $this->ctrlHelper->urlParameters[0]
            );

            $pages->Save($page);

            \model\FlashMessageService::Add("Page sucessfully saved");

            $this->ctrlHelper->RedirectTo($this);
        }
    }
}