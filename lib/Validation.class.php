<?php
class Validation
{
    public static function validateEmail($email){
        $pattern = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
        if(!preg_match($pattern, $email)){
            return false;
        }else{
            return true;       
        }        
    }
    public static function validateTel($tel){
        $pattern = '/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/';   
        if(!preg_match($pattern, $tel)){
            return false;
        }else{
            return true;
        }        
    }
    
    public static function allowImage($ext){
        $array = array(
            'jpg','jpeg','bmp', 'png', 'gif'
        );
        return in_array(strtolower($ext), $array);
    }
    
   
    
}