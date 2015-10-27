<?php
/**
 * Created by jopes
 * Date: 2015-10-26
 * Time: 18:43
 */

namespace view;


class PageView extends View {


    // Init values
    private static $SUBMIT_INPUT_NAME = 'submit';
    private static $HEADER_INPUT_NAME = 'header';
    private static $CONTENT_INPUT_NAME = 'content';
    private static $PAGE_ID_INPUT_NAME = 'pageId';

    // Constructor
    public function __construct()
    {

    }

    // Public methods
    public function LoadPage($page, $editMode = false)
    {
        $pageArray = [
            'pageId' => $page->GetPageId(),
            'header' => $page->GetHeader(),
            'content' => $page->GetContent(),
            'pageIdFieldName' => self::$PAGE_ID_INPUT_NAME,
            'headerFieldName' => self::$HEADER_INPUT_NAME,
            'contentFieldName' => self::$CONTENT_INPUT_NAME,
            'submitFieldName' => self::$SUBMIT_INPUT_NAME
        ];

        $this->output .= $this->LoadTemplate(
            $editMode ? 'PageEditTpl' : 'PageTpl',
            $pageArray
        );
    }

    public function LoadCreatePage()
    {
        $pageArray = [
            'pageIdFieldName' => self::$PAGE_ID_INPUT_NAME,
            'headerFieldName' => self::$HEADER_INPUT_NAME,
            'contentFieldName' => self::$CONTENT_INPUT_NAME,
            'submitFieldName' => self::$SUBMIT_INPUT_NAME
        ];

        $this->output .= $this->LoadTemplate('PageCreateTpl', $pageArray);
    }

    public function GetPageInfo()
    {
        // Return array with info.
        return array(
            'pageId' => (isset($_POST[self::$PAGE_ID_INPUT_NAME]) ? $_POST[self::$PAGE_ID_INPUT_NAME] : 0),
            'header' => $_POST[self::$HEADER_INPUT_NAME],
            'content' => $_POST[self::$CONTENT_INPUT_NAME]
        );
    }
}