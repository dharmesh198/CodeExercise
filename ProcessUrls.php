<?php

/**
 * This file contains a code to extract & merge Query strings from input URLs and print merged array
 *
 * @author     Dharmesh Patel <dharmesh.198@gmail.com>
 */

/**
 * Class to extract & merge Query strings from input URLs
 *
 * @author     Dharmesh Patel <dharmesh.198@gmail.com>
 */
class clsMergeQueryString {

    /**
     * static variable holds an instance of class
     *
     * @var object
     */
    private static $_instance = null;
    
    /**
     * Singleton instance - ensuring only one instance of the class is created
     *
     * @return an Instance of the current class
     */
    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    
    /**
    * function to extract & merge query strings from input URLs
    *
    * @param string $strUrlOne first Url
    * @param string $strUrlTwo second Url
    *
    * @return array Returns merged array of query string parameters.
    */
    public function mergeQueryStrings($strUrlOne='', $strUrlTwo=''){
        
        // Remove whitespaces from input
        $strUrlOne = trim($strUrlOne);
        $strUrlTwo = trim($strUrlTwo);
        $arrMerged = array();
        
        // Check both URLs are not empty
        if(!empty($strUrlOne) && !empty($strUrlTwo)){
            
            $arrUrlOne = $this->extractQueryStringFromUrl($strUrlOne);
            $arrUrlTwo = $this->extractQueryStringFromUrl($strUrlTwo);
            $arrMerged = array_merge($arrUrlOne, $arrUrlTwo);
        }else{
            echo "ERROR: One of the URL is empty, please enter correct URL";
            return ;
        }
        
        return $arrMerged;
    }
    
    /**
    * function to extract query strings from input URL
    *
    * @param string $strUrl input Url
    *
    * @return array Returns an array of query string parameters.
    */
    private function extractQueryStringFromUrl($strUrl){

        $strParameters = parse_url($strUrl, PHP_URL_QUERY);
        parse_str($strParameters, $arrOutput);
       
        return $arrOutput;
    }

    
} // End of Class


$strUrlOne = 'http//www.example.com/path?var1=google&var2=567&var3=yahoo';
$strUrlTwo = 'http://username:password@hostname:9090/path?var4=add&var5=contact#anchor';

// Call the method to extract & merge query strings from two URLs
$objGetQueryString = clsMergeQueryString::getInstance();
$arrOutput = $objGetQueryString->mergeQueryStrings($strUrlOne,$strUrlTwo);

// Print the merged query strings 
echo '<pre>';
print_r($arrOutput);
echo '</pre>';


?>