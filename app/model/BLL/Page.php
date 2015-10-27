<?php
/**
 * Created by jopes
 * Date: 2015-10-25
 * Time: 21:48
 */

namespace model;


class Page extends ModelBLL {

// Init variables
    private $pageId;
    private $header;
    private $content;
    private $authorName;
    private $slug;
    private $created;
    private $modified;

    private static $constraints = [
        'pageId' => ['minValue' => 0, 'allowNull' => true],
        'header' => ['maxLength' => 100],
        'content' => ['maxLength' => 65535],
        'authorName' => ['maxLength' => 30],
        'slug' => ['maxLength' => 100, 'minLength' => 0],
        'created' => ['classType' => 'DateTime'],
        'modified' => ['classType' => 'DateTime'],
    ];

// Constructor
    public function __construct(
        $pageId = null,
        $header = "",
        $content = "",
        $authorName = "",
        $slug = "",
        $created = null,
        $modified = null
    ) {
        $this->SetPageId($pageId);
        $this->SetHeader($header);
        $this->SetContent($content);
        $this->SetAuthorName($authorName);
        $this->SetSlug($slug);
    }

// Getters and Setters

    # pageId
    public function SetPageId($value) {

        if($this->IsValidInt("pageId", $value, self::$constraints["pageId"]))
        {
            // Set value
            $this->pageId = (int) $value;
        }
    }

    public function GetPageId() {
        return $this->pageId;
    }

    # header
    public function SetHeader($value) {

        // Check if value is valid
        if($this->IsValidString("header", $value, self::$constraints["header"])) {

            // Set value
            $this->header = trim($value);
        }
    }

    public function GetHeader() {
        return $this->header;
    }

    # content
    public function SetContent($value) {

        // Check if value is valid
        if($this->IsValidString("content", $value, self::$constraints["content"])) {

            // Set username
            $this->content = trim($value);
        }
    }

    public function GetContent() {
        return $this->content;
    }

    # authorName
    public function SetAuthorName($value) {

        // Check if value is valid
        if($this->IsValidString("authorName", $value, self::$constraints["authorName"])) {

            // Set value
            $this->authorName = trim($value);
        }
    }

    public function GetAuthorName() {
        return $this->authorName;
    }

    # created
    public function SetCreated($value) {

        // Check if value is valid
        if($this->IsClassType("created", $value, self::$constraints["created"])) {

            // Set value
            $this->created = $value;
        }
    }

    public function GetCreated() {
        return $this->created;
    }

    # slug
    public function SetSlug($value) {

        // Check if value is valid
        if($this->IsValidString("slug", $value, self::$constraints["slug"])) {

            // Set value
            $this->slug = $value;
        }
    }

    public function GetSlug() {
        return $this->slug;
    }

    # modified
    public function SetModified($value) {

        // Check if value is valid
        if($this->IsClassType("modified", $value, self::$constraints["modified"])) {

            // Set value
            $this->modified = $value;
        }
    }

    public function GetModified() {
        return $this->modified;
    }

// Private Methods

// Public Methods

    public function GenerateSlug()
    {
        $string = $this->GetHeader();

        # special accents
        $svSpecial = array('å','ä','ö','Å','Ä','Ö','é','É','ó','Ó');
        $svReplacement = array('a','a','o','a','a','o','e','e','o','o');
        $string = strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace($svSpecial, $svReplacement, $string)));

        // Set slug
        $this->SetSlug($string);
    }
}