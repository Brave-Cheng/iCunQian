<?php

/**
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
class Log
{
    private static $_instance = null;
    public static $filename = '';
    public static $fileExtension = 'log';
    private static $_filepath;
    
    /**
     * clone function
     * 
     * @return null
     */
    private function __clone() {
        die('Clone is not allowed.' . E_USER_ERROR);
    }

    /**
     * return a single instance
     * 
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
     * 
     * @param string $data content
     * 
     * @return null
     */
    public static function write($data) {
        //write log
        util::logMessage($data, self::_getRealFilename());
    }

    /**
     * get real file name
     * 
     * @param string $filename filename
     * 
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
     * 
     * @param string $filename filename
     * 
     * @return null
     */
    public static function setFilename($filename) {
        self::$filename = $filename;
    }

    /**
     * get filepath
     * 
     * @return string
     */
    private static function _getFilepath() {
        if (!self::$_filepath) {
            self::$_filepath = sfConfig::get('sf_log_dir');
        }
        //create dir
        if (!file_exists(self::$_filepath)) {
            mkdir(self::$_filepath, 0777, true);
        }
        return self::$_filepath;
    }
    
    /**
     * custom filepath
     * 
     * @param string $filepath path name
     * 
     * @return null
     */
    public static function setFilepath($filepath) {
        self::$_filepath = $filepath;
    }
    
    /**
     * get full path file name
     * 
     * @param string $filename filename
     * 
     * @return string 
     */
    private static function _getFullPathFilename($filename = '') {
        $realFilename = self::_getRealFilename($filename);
        return trim(self::_getFilepath(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $realFilename;
    }

}
