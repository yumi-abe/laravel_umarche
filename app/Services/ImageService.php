<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;


class ImageService
{
    public static function upload($imageFile, $folderName){

        $fileName = uniqid(rand().'_');
        $extension = $imageFile->extension();
        $fileNameStore = $fileName. '_' . $extension;
        if(!is_null($imageFile) && $imageFile->isValid() ){
        Storage::putFile('public/'. $folderName . '/', $imageFile);
        }

        return $fileNameStore;
    }
}

?>