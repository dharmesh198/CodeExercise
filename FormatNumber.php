<?php

/**
 * This file contains code to format phone number to given format
 *
 * @author     Dharmesh Patel <dharmesh.198@gmail.com>
 */

/**
 * Class to format Phone number to xxx-xxx-xxxx format
 *
 * @author     Dharmesh Patel <dharmesh.198@gmail.com>
 */
class clsFormatNumber {

    /**
     * static variable holds an instance of class
     *
     * @var object
     */
    private static $_instance = null;

    /**
    * function to format phone numbers to xxx-xxx-xxxx format
    *
    * @param string $strPhoneNumber phone number string
    *
    * @return string formatted phone number
    */
    public static function formatPhoneNumber($strPhoneNumber) {

        // Trim whitespaces from the phone number
        $strPhoneNumber     = trim($strPhoneNumber);
        $formattedNumber    = '';

        if (true === self::isValidFormat($strPhoneNumber)) {

            // Strip all characters other than digits
            $strPhoneNumber     = preg_replace('/[^0-9]/i', '', $strPhoneNumber);

            $strFirstThree      = substr($strPhoneNumber, 0, 3);
            $strNextThree       = substr($strPhoneNumber, 3, 3);
            $strLastFour        = substr($strPhoneNumber, 6, 4);

            $formattedNumber    = $strFirstThree . '-' . $strNextThree . '-' . $strLastFour;
        }

        return $formattedNumber;
    }

    /**
    * function to check invalid values in input phone number
    *
    * @param string $strPhoneNumber phone number string
    *
    * @return boolean true/false
    */
    private static function isValidFormat($strPhoneNumber) {

        if (strlen($strPhoneNumber) != 10) {
            echo 'ERROR: Phone number must be 10 digits in length.';
            return false;
        }

        // Check if number contains alphabets
        if (preg_match("/[^0-9]/i", $strPhoneNumber)) {
            echo 'ERROR: Phone number must not contain any other characters other than digits.';
            return false;
        }
        return true;
    }

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
}

$objFormatNumber = clsFormatNumber::getInstance();

// Example 1 - Valid input
echo "<br>".$objFormatNumber::formatPhoneNumber('1234567890');

// Example 2 - Valid input with space
echo "<br>". $objFormatNumber::formatPhoneNumber(' 1234567890  ');

// Example 3 - InValid input
echo "<br>". $objFormatNumber::formatPhoneNumber('123456789067');

// Example 4 - InValid input
echo "<br>". $objFormatNumber::formatPhoneNumber('1234&56781');

// Example 5 - InValid input
echo "<br>". $objFormatNumber::formatPhoneNumber('1234rtyu56');

?>