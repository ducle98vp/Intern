<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait Image
{
    function uploadImage($file)
    {
            $imgName = $file->getClientOriginalName();//lấy ra tên file ảnh
            $imgName = time() . rand(0, 999999) . $imgName;//đặt lại tên file ảnh
            $dir_uploads = public_path('assets/uploads');
            $file->move($dir_uploads, $imgName);
            return $imgName;
    }

    function deleteImage($image)
    {
        $image_path = "images/products/".$image;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    function deleteMultiImage($images)
    {
        foreach ($images as $image)
        {
            $this->deleteImage($image);
        }
    }
}
