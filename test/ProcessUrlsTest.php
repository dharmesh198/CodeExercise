<?php

/**
 * This file contains unit tests to test methods of clsMergeQueryString class
 *
 * @author     Dharmesh Patel <dharmesh.198@gmail.com>
 */

require_once ('../ProcessUrls.php');

class clsMergeQueryStringTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var object of class
     */
    protected $object;
    
    /**
     * Sets up the fixture, set an instance of class.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {

        $this->object = clsMergeQueryString::getInstance();
        
    }
    
    /**
     * Tears down the fixture, unset an instance of class.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->object);
    }
    
    /**
     * Test valid phone number user case
     * 
     */
    public function testValidUrls()
    {
        // Pass valid urls
        $arrQueryString = $this->object->mergeQueryStrings('http//www.example.com/path?var1=google','http://username:password@hostname:9090/path?var2=yahoo#anchor');        
        
        $this->assertArrayHasKey('var1', $arrQueryString);
        $this->assertArrayHasKey('var2', $arrQueryString);
        $this->assertContains('google', $arrQueryString);

    }
    
    /**
     * Test invalid phone number user case
     * 
     */
    public function testInvalidUrls()
    {
        
        // Pass empty urls for url2 
        $strResult = $this->object->mergeQueryStrings('http//www.example.com/path?var1=google','');        
      
        $this->assertContains('ERROR', $strResult, '', true);
    }
}
