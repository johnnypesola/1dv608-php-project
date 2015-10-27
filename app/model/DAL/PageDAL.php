<?php
/**
 * Created by jopes
 * Date: 2015-10-25
 * Time: 22:55
 */

namespace model;


class PageDAL extends ModelDAL
{

// Init variables
    private static $DB_TABLE_NAME = 'page';

    private static $DB_QUERY_ERROR = 'Error getting pages from database';
    private static $DB_GET_ERROR = 'Error getting page from database';
    private static $DB_INSERT_ERROR = 'Error adding page to database';
    private static $DB_UPDATE_ERROR = 'Error updating page in database';
    private static $DB_DELETE_ERROR = 'Error removing page from database';

// Constructor

// Private Methods

    private function Add(Page $page)
    {
        try {
            // Prepare db statement
            $statement = self::$db->prepare(
                'INSERT INTO ' . self::$DB_TABLE_NAME  .
                '(page_id, header, content, author_name, slug, created, modified)' .
                ' VALUES ' .
                '(NULL, :header, :content, :author_name, :slug, NOW(), NOW())'
            );

            // Prepare input array
            $inputArray = [
                'header' => $page->GetHeader(),
                'content' => $page->GetContent(),
                'author_name' => $page->GetAuthorName(),
                'slug' => $page->GetSlug()
            ];

            // Execute db statement
            $statement->execute($inputArray);

            // Check if db insertion was successful
            return self::$db->lastInsertId();

        } catch (\Exception $exception) {
            throw new \Exception(self::$DB_INSERT_ERROR);
        }
    }

    private function Update(Page $page)
    {
        // Assert that page has id
        assert(!is_null($page->GetPageId()));

        try {
            // Prepare db statement
            $statement = self::$db->prepare(
                'UPDATE ' . self::$DB_TABLE_NAME .
                ' SET ' .
                '`header` = :header, ' .
                '`content` = :content, ' .
                '`author_name` = :author_name, ' .
                '`slug` = :slug, ' .
                '`modified` = NOW() ' .
                ' WHERE page_id = :pageId' .
                ' LIMIT 1'
            );

            // Prepare input array
            $inputArray = [
                'pageId' => $page->GetPageId(),
                'header' => $page->GetHeader(),
                'content' => $page->GetContent(),
                'author_name' => $page->GetAuthorName(),
                'slug' => $page->GetSlug()
            ];

            // Execute db statement
            $statement->execute($inputArray);

            // Check if db deletion was successful
            return $statement->rowCount() == 1;

        } catch (\Exception $exception) {
            throw new \Exception(self::$DB_UPDATE_ERROR);
        }
    }

// Public Methods

    public function GetAll() {

        try {

            $returnArray = [];

            // Get data from database
            foreach(self::$db->query('SELECT * FROM `' . self::$DB_TABLE_NAME  . '`') as $row ) {

                // Create new object from database row
                $returnArray[] = new Page(
                    $row['page_id'],
                    $row['header'],
                    $row['content'],
                    $row['author_name'],
                    $row['slug'],
                    $row['created'],
                    $row['modified']
                );
            }

            return $returnArray;

        } catch (\Exception $exception) {
            throw new \Exception(self::$DB_QUERY_ERROR);
        }

    }

    public function Get($id = 0) {

        try {

            // Prepare db statement
            $statement = self::$db->prepare(
                'SELECT * FROM ' . self::$DB_TABLE_NAME .
                ' WHERE ' . ($id != 0 ? '`page_id` = :pageId' : '1') .
                ' LIMIT 1'
            );

            // Prepare input array
            $inputArray = [
                'pageId' => $id
            ];

            // Execute db statement
            $statement->execute($inputArray);

            // Fetch rows
            $row = $statement->fetch();

            // Return found user or false
            if (sizeof($row) > 0) {

                // Create new object
                return new Page(
                    $row['page_id'],
                    $row['header'],
                    $row['content'],
                    $row['author_name'],
                    $row['slug'],
                    $row['created'],
                    $row['modified']
                );
            }

            return false;

        } catch (\Exception $exception) {

            throw new \Exception(self::$DB_GET_ERROR);
        }

    }

    public function Save(Page $page)
    {
        // Add page if ID is missing, update otherwise
        if(is_null($page->GetPageId()) || $page->GetPageId() == 0)
        {
            // Return insert id
            return $this->Add($page);
        }
        else
        {
            $this->Update($page);

            // Return page id
            return $page->GetPageId();
        }
    }



    public function Delete(Page $page)
    {
        // Assert that page has id
        assert(!is_null($page->GetPageId()));

        try {
            // Prepare db statement
            $statement = self::$db->prepare(
                'DELETE FROM ' . self::$DB_TABLE_NAME  .
                ' WHERE page_id = :pageId' .
                ' LIMIT 1'
            );

            // Prepare input array
            $inputArray = [
                'pageId' => $page->GetPageId()
            ];

            // Execute db statement
            $statement->execute($inputArray);

            // Check if db deletion was successful
            return $statement->rowCount() == 1;

        } catch (\Exception $exception) {
            throw new \Exception(self::$DB_DELETE_ERROR);
        }
    }


} 