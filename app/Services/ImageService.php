<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;


class ImageService
{
    public static function upload($imageFile, $folderName){

        $fileName = uniqid(rand().'_');
        $extension = $imageFile->extension();
        $fileNameToStore = $fileName. '_' . $extension;
        // dd($fileNameToStore, $folderName, $imageFile,$extension);

        if(!is_null($imageFile) && $imageFile->isValid() ){
        // Storage::putFile('public/'. $folderName . '/', $imageFile);
        Storage::putFileAs('public/' . $folderName . '/' , $file, $fileNameToStore );
        }
        
        

        // return $fileNameStore;
        return $fileNameToStore;
    }
}

?>