<?php

/**
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
class Log {

    private static $_instance = null;
    public static $filename = '';
    public static $fileExtension = 'log';
    private static $_filepath;
    
    private function __destruct() {
        
    }
    
    private function __clone() {
        die('Clone is not allowed.' . E_USER_ERROR);
    }

    /**
     * return a single instance
     * @return instance
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * write a log file
     * @param string $data
     * @param string $mode
     */
    public static function write($data, $mode = 'a') {
        $fullPathFilename = self::_getFullPathFilename();
        //write log
        $fileHandle = fopen($fullPathFilename, $mode);
        flock($fileHandle, LOCK_EX);
        fwrite($fileHandle, $data);
        fclose($fileHandle);
    }

    /**
     * get real file name
     * @return string
     */
    private static function _getRealFilename($filename = '') {
        if (!self::$filename) {
            self::$filename = date('YmdHis');
        }
        return self::$filename . '.' . self::$fileExtension;
    }
    
    /**
     * set filename
     * @param string $filename
     */
    public static function setFilename($filename) {
        self::$filename = $filename;
    }

    /**
     * get filepath
     * @param string $filepath
     */
    public static function _getFilepath() {
        if (!self::$_filepath) {
            self::$_filepath = sfConfig::get('sf_log_dir');
        }
        //create dir
        mkdir(self::$_filepath, 0777, true);
        return self::$_filepath;
    }
    
    /**
     * custom filepath
     * @param string $filepath
     */
    public static function setFilepath($filepath) {
        self::$_filepath = $filepath;
    }
    
    /**
     * get full path file name
     * @return string
     */
    public static function _getFullPathFilename($filename = '') {
        $realFilename = self::_getRealFilename($filename);
        return trim(self::_getFilepath(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $realFilename;
    }

}
