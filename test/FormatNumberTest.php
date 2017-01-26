<?php

/**
 * This file contains unit tests to test methods of clsFormatNumber class
 *
 * @author     Dharmesh Patel <dharmesh.198@gmail.com>
 */

require_once ('../FormatNumber.php');

class clsFormatNumberTest extends PHPUnit_Framework_TestCase
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
    public function testValidPhoneNumber()
    {
        // Pass valid 10 digits to convert into proper format
        $strNumber = $this->object->formatPhoneNumber('1234567890');        
        $this->assertEquals('123-456-7890', $strNumber);

    }
    
    /**
     * Test invalid phone number user case
     * 
     */
    public function testInvalidPhoneNumber()
    {
        // Pass Invalid phonenumber and so that function will return error message
        $strInvalidPhone = $this->object->formatPhoneNumber('1234567890_er');        
        $this->assertContains('ERROR', $strInvalidPhone, '', true);
        
        // Pass Invalid phonenumber and so that function will return error message
        $strMoreDigits = $this->object->formatPhoneNumber('123456789012');        
        $this->assertContains('ERROR', $strMoreDigits, '', true);
    }
}
