<?php
/**
 * Created by jopes
 * Date: 2015-10-26
 * Time: 18:43
 */

namespace view;


class PageView extends View {

    // Constructor
    public function __construct()
    {
        
    }

    // Public methods
    public function LoadPage($page, $editMode = false)
    {
        $pageArray = [
            'header' => $page->GetHeader(),
            'content' => $page->GetContent()
        ];

        $this->output .= $this->LoadTemplate(
            $editMode ? 'PageEditTpl' : 'PageTpl',
            $pageArray
        );
    }
}