<?php
namespace App\Traits;

use Image;

 trait uploadImage{

    public function upload($image,$folder_name){
        $name = $image->getClientOriginalExtension();
        $path = public_path('images/'.$folder_name);
        $resize_image = Image::make($image->getRealPath());
        $resize_image->resize(
            400,
            700
        )->save($path);
        return $name;
    }

    public function removeImage($image,$folder_name){
        $path = public_path('images/'.$folder_name);
        if(file_exists($path) && !is_null($image)){
            unlink($path);
        }
    }
 }
