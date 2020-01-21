<?php

PHPOpenRtb_Autoloader::register();
//    As we always try to run the autoloader before anything else, we can use it to do a few
//        simple checks and initialisations
//PHPExcel_Shared_ZipStreamWrapper::register();
// check mbstring.func_overload
if (ini_get('mbstring.func_overload') & 2) {
    throw new PHPOpenRtb_Exception('Multibyte function overloading in PHP must be disabled for string functions (2).');
}

class PHPOpenRtb_Autoloader {

    public static function register() {

        // Register ourselves with SPL
        if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
            return spl_autoload_register(array('PHPOpenRtb_Autoloader', 'load'), true, true);
        } else {
            return spl_autoload_register(array('PHPOpenRtb_Autoloader', 'load'));
        }
    }

    public static function load($pClassName) {

        // openrtb 폴더이름 src로 변경
        $pClassName = str_replace('openrtb', 'Src', $pClassName);
        $pClassName = str_replace('\\', DIRECTORY_SEPARATOR, $pClassName);

        $pClassFilePath = PHPOPENRTB_ROOT . str_replace('_', DIRECTORY_SEPARATOR, $pClassName) . '.php';

        if ((file_exists($pClassFilePath) === false) || (is_readable($pClassFilePath) === false)) {
            // Can't load
            return false;
        }

        require($pClassFilePath);
    }
}