<?php

namespace view;


class NavigationView extends view {


// Init variables
    private $appController, $auth;

// Constructor
    public function __construct() {

    }

// Private methods

// Public methods

    public function GetUrl()
    {
        return $_GET;
    }

/*
    public function GetOutput() {

        $output = '';

        // Get logged in header text
        $output .= $this->GetLoggedInOutput();

        // Get navigation output
        $output .= $this->GetNavigationLinkOutput();

        return $output;
    }

    */
}