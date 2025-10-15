<?php

namespace App\Http\Services;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImageHelper
{
    public static function insertImage($image)
    {
        try {
            // Check if GD or Imagick is available
            if (!extension_loaded('gd') && !extension_loaded('imagick')) {
                throw new \Exception('Neither GD nor Imagick is installed. Please enable one of these extensions.');
            }

            // Use Laravel's storage system for portability
            $disk = 'public';
            $dir = 'courses'; // Folder in storage/app/public
            $filename = time() . '-uploaded-' . $image->getClientOriginalName();

            // Store the original image
            $path = $image->storeAs($dir, $filename, $disk);
            $fullPath = Storage::disk($disk)->path($path);

            // Create small image (400px width, maintain aspect ratio)
            $imgSmall = Image::make($fullPath);
            $imgSmall->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $smallPath = $dir . '/' . $filename;
            Storage::disk($disk)->put($smallPath, $imgSmall->encode());

            // Create big image (750px width, maintain aspect ratio)
            $imgBig = Image::make($fullPath);
            $imgBig->resize(750, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $bigFilename = 'big-' . $filename;
            $bigPath = $dir . '/' . $bigFilename;
            Storage::disk($disk)->put($bigPath, $imgBig->encode());

            // Clean up: destroy image instances to free memory
            $imgSmall->destroy();
            $imgBig->destroy();

            return [$filename, $bigFilename];
        } catch (\Exception $e) {
            Log::error('Image processing failed: ' . $e->getMessage(), ['file' => __FILE__, 'line' => __LINE__]);
            throw new \Exception('Failed to process image. Please ensure GD or Imagick is installed and try again.');
        }
    }
}
