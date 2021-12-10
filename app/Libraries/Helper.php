<?php // Code within app\Libraries\Helper.php

namespace App\Libraries;
use Image;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function getUploadedFileName($mainFile, $imgPath, $reqWidth=0, $reqHeight=0)
    {
        $fileExtention = $mainFile->extension();
        $fileOriginalName = $mainFile->getClientOriginalName();
        $file_size 	= $mainFile->getSize();

        $validExtentions = array('jpeg', 'jpg', 'png');
        $path = public_path($imgPath);
        $currentTime = time();
        $fileName = $currentTime.'.'.$fileExtention;
        
        if (in_array($fileExtention, $validExtentions)) {

            $mainFile->move($path, $fileName);
            //create instance
            $img = Image::make($path.'/'.$fileName);
            //resize image
            $img->resize(80, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path.'/thumb/'.$fileName);
            
            $output['status'] = 1;
            $output['file_name'] = $fileName;
            $output['file_original_name'] = $fileOriginalName;
            $output['file_extention']     = $fileExtention;
            $output['file_size']          =  $file_size;
        
        } else {
            $output['errors'] = $fileExtention.' File is not support';
            $output['status'] = 0;
        }
        return $output;

    }

    public static function getUploadedAttachmentName($mainFile, $validPath)
    {
        $fileExtention = $mainFile->extension();
        $fileOriginalName = $mainFile->getClientOriginalName();
        $file_size 	= $mainFile->getSize();
        $validExtentions = array('pdf', 'doc', 'docx');
        $path = public_path($validPath);
        $currentTime = time();
        $fileName = $currentTime.'.'.$fileExtention;

        if($file_size<=1048576) { //1 mb
            if (in_array($fileExtention, $validExtentions)) {
                $mainFile->move($path, $fileName);
        
                $output['status']             = 1;
                $output['file_name']          = $fileName;
                $output['file_original_name'] = $fileOriginalName;
                $output['file_extention']     = $fileExtention;
                $output['file_size']          =  $file_size;
    
            } else {
                $output['errors'] = $fileExtention.' File is not support';
                $output['status'] = 0;
            }
        } else {
            $output['errors'] = $file_size. 'size is too large !!!';
            $output['status'] = 0;
        }
        
        return $output;

    }
}