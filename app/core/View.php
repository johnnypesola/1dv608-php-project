<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 21:28
 */

namespace view;

class View
{
    protected $output = '';

    protected function LoadTemplate($templateName, $data = [])
    {
        // Start output buffer
        ob_start();

        // Get template content
        require_once '../app/view/template/' . basename($templateName) . '.php';

        // Get output and return it
        return ob_get_clean();
    }

    public function GetOutput()
    {
        return $this->output;
    }
}