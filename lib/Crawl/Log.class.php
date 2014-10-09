<?php

/**
 * @package lib\Craw
 */

/**
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
class Log
{
    private static $_instance = null;
    private static $_filepath;

    public static $filename = '';
    public static $fileExtension = 'log';
    
    
    /**
     * clone function
     * 
     * @return void
     *
     * @issue 2729
     */
    private function __clone() {
        die('Clone is not allowed.' . E_USER_ERROR);
    }

    /**
     * return a single instance
     * 
     * @return instance
     *
     * @issue 2729
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Logs a message
     *
     * @param string $msg message
     * 
     * @issue 2729
     * 
     * @return boolean
     */
    public static  function formatLog($msg) {
        return sprintf("%s %s" . PHP_EOL, date('r'), trim($msg));
    }

    
    /**
     * write a log file
     * 
     * @param string $data content
     * 
     * @return void
     *
     * @issue 2729
     */
    public static function write($data) {
        //write log
        util::logMessage(self::formatLog($data), self::_getRealFilename());
    }

    /**
     * get real file name
     * 
     * @param string $filename filename
     * 
     * @return string
     *
     * @issue 2729
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
     * @return void
     *
     * @issue 2729
     */
    public static function setFilename($filename) {
        self::$filename = $filename;
    }

    /**
     * get filepath
     * 
     * @return string
     *
     * @issue 2729
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
     * @return void
     *
     * @issue 2729
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
     *
     * @issue 2729
     */
    private static function _getFullPathFilename($filename = '') {
        $realFilename = self::_getRealFilename($filename);
        return trim(self::_getFilepath(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $realFilename;
    }

}
