<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 21:28
 */

namespace view;

class View
{
    protected function LoadTemplate($templateName, $data = [])
    {
        require_once '../app/view/template/' . $templateName . '.php';
    }
}