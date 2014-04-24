<?php

class Log {
    
    public static $filename = ''; 

    public static $fileExtension = '.txt';

    public static $filepath = '';

    public static function write($data){
        $fullPathFilename = self::_getFullPathFilename();
        //write log
        $fileHandle = fopen($fullPathFilename, 'w');
        flock($fileHandle, LOCK_EX);
        $filedetail = fwrite($fileHandle, $data);
        fclose($fileHandle);
    }

    private static function _getRealFilename(){
        if ( !self::$filename ) {
            self::$filename = date('Y-m-d H:i:s');
        }
        return self::$filename . self::$fileExtension;
    }

    private static function _getFullPathFilename(){
        $realFilename = self::_getRealFilename();
        return trim(self::$filepath, '/') . '/' . $realFilename;
    }


}
