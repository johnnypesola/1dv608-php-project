<?php


namespace view;

class HtmlView extends View {

// Init variables
    public $pageTitle = '';
    public $pageCharset = 'utf-8';
    public $pageHeader = '';

// Constructor

// Public Methods

    public function GetUrl()
    {

        return isset($_GET['url']) ? $_GET['url'] : '';
    }

    public function HasUserPostedData()
    {
        return sizeof($_POST) > 0;
    }

    public function GetPostedData()
    {
        return $_POST;
    }

    public function Render($output, $isAuthorized = false)
    {

        // Render page header
        $this->RenderHeader();

        $this->RenderMsg();

        $this->RenderNavigation($isAuthorized);

        // Render page output
        echo $output;

        // Render page footer
        $this->RenderFooter();
    }


// Private Methods
    private function RenderHeader()
    {
        echo $this->LoadTemplate('HeaderTpl');
    }


    private function RenderNavigation($isAuthorized = false)
    {
        $pages = new \model\PageDAL();

        // Add all pages to navigation array
        foreach($pages->GetAll() as $page)
        {
            $navigationArray[] = [
                'name' => $page->GetHeader(),
                'href' => 'page/show/' . $page->GetPageId() . '/' . $page->GetSlug()
            ];
        }

        // Add extra pages when authenticated
        if($isAuthorized)
        {
            $navigationArray[] = ['name' => 'Skapa sida', 'href' => 'page/create'];
            $navigationArray[] = ['name' => 'Lista användare', 'href' => 'user'];
            $navigationArray[] = ['name' => 'Logga ut', 'href' => 'auth/logout'];
        }
        else
        {
            $navigationArray[] = ['name' => 'Logga in', 'href' => 'auth'];
        }



        echo $this->LoadTemplate('NavigationTpl', $navigationArray);
    }





    private function RenderMsg()
    {
        // Get exception messages if there are any.
        if(\model\ExceptionsService::HasExceptions()) {

            echo $this->LoadTemplate(
                'MessageTpl',
                \model\ExceptionsService::GetLastExceptionMessage()
            );
        }

        // Get validations errors if there are any
        else if(\model\FlashMessageService::DoesExist())
        {
            echo $this->LoadTemplate(
                'MessageTpl',
                \model\FlashMessageService::GetAll()
            );
        }
    }

    private function RenderFooter()
    {
        echo $this->LoadTemplate('FooterTpl');
    }
}
