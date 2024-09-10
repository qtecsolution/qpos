<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageHandlerController extends Controller
{

    public function uploader($file, $path, $width, $height)
    {
        $file_name = time() . "_" . uniqid() . "_" . $file->getClientOriginalName();
        $storingPath = storage_path() . "/app" . $path . "/" . $file_name;

        if (!file_exists($path)) {
            Storage::makeDirectory($path);
        }

        Image::make($file->getRealPath())->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($storingPath);

        // Remove Public from link
        return substr($path . "/" . $file_name, 8);
    }

    public function uploadToPublic($file, $path = "/assets/images")
    {
        $file_name = time() . "_" . uniqid() . "_" . $file->getClientOriginalName();
        $storingPath = public_path() . $path . "/" . $file_name;

        if (!file_exists($path)) {
            Storage::makeDirectory($path);
        }

        Image::make($file->getRealPath())->resize(null, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save($storingPath);

        return $path . "/" . $file_name;
    }

    public function securePublicUnlink($path)
    {
        $absolute_path = public_path($path);

        if (file_exists($absolute_path) && is_file($absolute_path)) {
            unlink($absolute_path);
            return true;
        } else {
            return false;
        }
    }

    function uploadImageAndGetPath($file, $path = "/public/media/others")
    {
        return $this->uploader($file, $path, null, 400);
    }

    function uploadBigImageAndGetPath($file, $path = "/public/media/others")
    {
        return $this->uploader($file, $path, 800, null);
    }

    function uploadIconImageAndGetPath($file, $path = "/public/media/others")
    {
        return $this->uploader($file, $path, null, 200);
    }

    public function secureUnlink($path)
    {
        $absolute_path = storage_path() . '/app/public/' . $path;

        if (file_exists($absolute_path) && is_file($absolute_path)) {
            unlink($absolute_path);
            return true;
        } else {
            return false;
        }
    }

    public function fileUploadAndGetPath($file, $path = "/public/media/others")
    {
        $file_name = time() . "_" . $file->getClientOriginalName();

        $file->storeAs($path, $file_name);

        // Remove Public from link
        return substr($path . "/" . $file_name, 8);
    }
}
