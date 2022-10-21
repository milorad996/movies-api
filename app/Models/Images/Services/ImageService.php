<?php
namespace App\Models\Images\Services;

use App\Models\Image;
use ImageResize;

class ImageService {
    public function uploadImage($data){
        
        $newImage = new Image();
        $newImage->small_size = $data['small_size'];
        $newImage->full_size = $data['full_size'];
        $newImage->save();
        $image = $data['small_size'];
        
        $input['imagename'] = time().'.'.$image->extension();
      
        $destinationPath = public_path('/thumbnails');
        $img = ImageResize::make($image->path());
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
    
        $imageTwo = $data['full_size'];
        $input['imagenameTwo'] = time().'.'.$image->extension();
      
        $destinationPath = public_path('/full-size');
        $imgTwo = ImageResize::make($imageTwo->path());
        $imgTwo->resize(400, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagenameTwo']);
    
    }
}
