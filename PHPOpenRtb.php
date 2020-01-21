<?php

/** PHPOpenRtb root directory */
if (!defined('PHPOPENRTB_ROOT')) {
    define('PHPOPENRTB_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
    require(PHPOPENRTB_ROOT . 'Src/Autoloader.php');
}

class PHPOpenRtb {

    /**
     * PHPOpenRtb constructor.
     */
    public function __construct() {
//        var_dump("__construct");
    }
}