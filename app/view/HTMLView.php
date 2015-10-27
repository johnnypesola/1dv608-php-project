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

        $this->RenderFlashMsg();

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
        $navigationArray = [
            ['name' => 'På gång', 'href' => ''],
            ($isAuthorized ? ['name' => 'Logga ut', 'href' => 'auth/logout'] : ['name' => 'Logga in', 'href' => 'auth'])
        ];

        echo $this->LoadTemplate('NavigationTpl', $navigationArray);
    }


    private function RenderFlashMsg()
    {
        // Get validations errors if there are any
        if(\model\FlashMessageService::DoesExist())
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
