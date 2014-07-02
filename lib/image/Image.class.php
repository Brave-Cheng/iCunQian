<?php
class Image { 
    public static function imageInfo($image) {
        if(!file_exists($image)) {
            return false;
        }
        $info = getimagesize($image);       
        if($info == false) {
            return false;
        }
        $img['width'] = $info[0];
        $img['height'] = $info[1];
        $img['ext'] = substr($info['mime'],strpos($info['mime'],'/')+1);
        return $img;
    }

    public static function thumb($dst,$save=NULL,$width=300,$height=200) {
        $dinfo = self::imageInfo($dst);
        if($dinfo == false) {
            return false;
        }
        $calc = min($width/$dinfo['width'], $height/$dinfo['height']);
        $dfunc = 'imagecreatefrom' . $dinfo['ext'];
        $dwidth = (int)$dinfo['width']*$calc;
        $dheight = (int)$dinfo['height']*$calc;
        $dim = $dfunc($dst);
        $tim = imagecreatetruecolor($dwidth,$dheight);
        imagecopyresampled($tim,$dim,0,0,0,0,$dwidth,$dheight,$dinfo['width'],$dinfo['height']);
        if(!$save) {
            $save = $dst;
            unlink($dst);
        }
        $createfunc = 'image' . $dinfo['ext'];
        $createfunc($tim,$save);
        imagedestroy($dim);
        imagedestroy($tim);
        return true;
    }
}