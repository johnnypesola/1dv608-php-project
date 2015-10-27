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
    // Init variables
    private static $STARTPAGE_SLUG = 'start';

    public function Index()
    {
        $this->Show();
    }

    public function Show()
    {
        // Create view
        $pageView = $this->ctrlHelper->CreateView('PageView');

        // Load file dependencies
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');

        $pages = $this->ctrlHelper->CreateDALModel('PageDAL');

        $auth = $this->ctrlHelper->CreateService('AuthService');


        if($this->ctrlHelper->DoesUrlParamsExist())
        {
            // Get id
            $id = $this->ctrlHelper->urlParameters[0];

            // Get specific page
            $page = $pages->Get($id);
        }
        else
        {
            // Get startpage
            $page = $pages->Get(self::$STARTPAGE_SLUG);
        }

        // Load page output
        $pageView->LoadPage($page, $auth->IsUserLoggedIn());

        // Get output
        $output = $pageView->GetOutput();

        // Render page
        $this->ctrlHelper->htmlView->Render($output, $auth->IsUserLoggedIn());
    }

    public function Create()
    {
        // Load file dependencies
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');

        $auth = $this->ctrlHelper->CreateService('AuthService');

        if($auth->IsUserLoggedIn())
        {
            // Create view
            $pageView = $this->ctrlHelper->CreateView('PageView');

            // Load page output
            $pageView->LoadCreatePage();

            // Get output
            $output = $pageView->GetOutput();

            // Render page
            $this->ctrlHelper->htmlView->Render($output, $auth->IsUserLoggedIn());
        }
        else
        {
            $this->ctrlHelper->RedirectTo($this);
        }
    }

    public function Save()
    {
        // Create view
        $pageView = $this->ctrlHelper->CreateView('PageView');

        // Load file dependencies
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');

        $pages = $this->ctrlHelper->CreateDALModel('PageDAL');
        $auth = $this->ctrlHelper->CreateService('AuthService');

        if($auth->IsUserLoggedIn())
        {
            // Get page info from view
            $pageInfoArray = $pageView->GetPageInfo();

            // Get logged in user
            $user = $auth->GetLoggedInUser();

            // Create new page
            $page = new \model\Page(
                $pageInfoArray['pageId'],
                $pageInfoArray['header'],
                $pageInfoArray['content'],
                $user->GetUsername()
            );

            // Generate slug
            $page->GenerateSlug();

            $pages->Save($page);

            \model\FlashMessageService::Add("Page successfully saved");

            $ctrlName = $this->ctrlHelper->CtrlToString($this);

            $this->ctrlHelper->RedirectTo($ctrlName . "/show/" . $page->GetPageId() . '/' . $page->GetSlug());
        }
    }

    public function Delete()
    {
        // Load file dependencies
        $this->ctrlHelper->LoadDALModel('UserDAL');
        $this->ctrlHelper->LoadDALModel('LoginDAL');

        $pages = $this->ctrlHelper->CreateDALModel('PageDAL');
        $auth = $this->ctrlHelper->CreateService('AuthService');

        if($auth->IsUserLoggedIn())
        {
            // Get page id from params
            $pageId = $this->ctrlHelper->urlParameters[0];

            $page = new \model\Page($pageId);

            $pages->Delete($page);

            \model\FlashMessageService::Add("Page successfully deleted");

            $this->ctrlHelper->RedirectTo($this);
        }
    }
}