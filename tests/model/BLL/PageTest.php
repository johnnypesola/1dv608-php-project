<?php
/**
 * Created by jopes
 * Date: 2015-10-28
 * Time: 03:15
 */

namespace model;

require_once 'app/core/ModelBLL.php';
require_once 'app/model/BLL/Page.php';


class PageTest extends \PHPUnit_Framework_TestCase {

    public function testConstructor()
    {
        // Clear validations
        \model\ValidationService::Clear();

        $dateTimeObj1 = new \DateTime("now");
        $dateTimeObj2 = new \DateTime("2000-01-01");

        $page = new Page(
            12,
            'header',
            'content',
            'authorName',
            'slug',
            $dateTimeObj1, // DateTime obj
            $dateTimeObj2 // DateTime obj
        );

        $this->assertTrue(\model\ValidationService::IsValid());

        // Check values
        $this->assertEquals(12, $page->GetPageId());
        $this->assertEquals("header", $page->GetHeader());
        $this->assertEquals("content", $page->GetContent());
        $this->assertEquals("authorName", $page->GetAuthorName());
        $this->assertEquals("slug", $page->GetSlug());
        $this->assertEquals($dateTimeObj1, $page->GetCreated());
        $this->assertEquals($dateTimeObj2, $page->GetModified());
    }

    public function testConstructorWithFaultyValues()
    {
        // Clear validations
        \model\ValidationService::Clear();

        $dateTimeObj1 = new \DateTime("now");
        $dateTimeObj2 = new \DateTime("2000-01-01");

        $page = new Page(
            "not so good value",
            'header',
            'content',
            'authorName',
            'slug',
            $dateTimeObj1, // DateTime obj
            $dateTimeObj2 // DateTime obj
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();


        $page = new Page(
            12,
            'headeroawjeoawjdiojawioeawuiohdpiawjhdpawrhawdfjawoåkoåawkdåoawkdijawoedjawoehawodjawjepawepwapdaw',
            'content',
            'authorName',
            'slug',
            $dateTimeObj1, // DateTime obj
            $dateTimeObj2 // DateTime obj
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();


        $page = new Page(
            12,
            'header',
            '<<<>>><<>><<>>',
            'authorName',
            'slug',
            $dateTimeObj1, // DateTime obj
            $dateTimeObj2 // DateTime obj
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();


        $page = new Page(
            12,
            'header',
            'content',
            'authorNameP=¤%OOWPROWPEROJK#¤O#K?PQÅEPÅQWPEÅQPWEÅQÅ"#"QÅ|<>>',
            'slug',
            $dateTimeObj1, // DateTime obj
            $dateTimeObj2 // DateTime obj
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();


        $page = new Page(
            12,
            'header',
            'content',
            'authorName',
            'slugP=¤%OOWPROWPEROJK#¤O#K?PQÅEPÅQWPEÅQPWEÅQÅ"#"QÅ|<>>',
            $dateTimeObj1, // DateTime obj
            $dateTimeObj2 // DateTime obj
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();


        $page = new Page(
            12,
            'header',
            'content',
            'authorName',
            'slug',
            'just so wrong', // DateTime obj
            $dateTimeObj2 // DateTime obj
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();

        $page = new Page(
            12,
            'header',
            'content',
            'authorName',
            'slug',
            $dateTimeObj1, // DateTime obj
            'just so wrong' // DateTime obj
        );

        // Should not be valid
        $this->assertFalse(\model\ValidationService::IsValid());

        // Clear validations
        \model\ValidationService::Clear();
    }


    public function testMethods()
    {
        // Clear validations
        \model\ValidationService::Clear();

        $page = new Page(
            12,
            'Really nice HEÄDER',
            'content',
            'authorName'
        );

        $page->GenerateSlug();

        $this->assertEquals("really-nice-header", $page->GetSlug());

    }
}
 