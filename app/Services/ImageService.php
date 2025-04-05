<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ImageService
{
    protected $manager;
    
    // Maximum dimensions for uploaded images
    protected $maxWidth = 1280;
    protected $maxHeight = 720;
    
    public function __construct()
    {
        // Create a new ImageManager instance with GD driver
        $this->manager = new ImageManager(new Driver());
    }
    
    /**
     * Convert any image to WebP format and resize if needed
     *
     * @param UploadedFile $file The uploaded image file
     * @param string $directory The directory to store the image in
     * @param string $disk The storage disk to use
     * @param int|null $maxWidth Maximum width (defaults to 1280px)
     * @param int|null $maxHeight Maximum height (defaults to 720px)
     * @return array Returns an array with path, width, and height
     */
    public function convertToWebP(
        UploadedFile $file, 
        string $directory = 'images', 
        string $disk = 'public',
        ?int $maxWidth = null,
        ?int $maxHeight = null
    ): array
    {
        try {
            // Use provided dimensions or fall back to defaults
            $maxWidth = $maxWidth ?? $this->maxWidth;
            $maxHeight = $maxHeight ?? $this->maxHeight;
            
            // Log file information for debugging
            Log::info('Processing image upload', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize()
            ]);
            
            // Generate a unique filename
            $filename = Str::uuid() . '.webp';
            $path = $directory . '/' . $filename;
            
            // Create an Intervention Image instance
            $image = $this->manager->read($file);
            
            // Get original dimensions
            $originalWidth = $image->width();
            $originalHeight = $image->height();
            
            // Log original dimensions
            Log::info('Original image dimensions', [
                'width' => $originalWidth,
                'height' => $originalHeight
            ]);
            
            // Resize the image if it exceeds maximum dimensions while maintaining aspect ratio
            if ($originalWidth > $maxWidth || $originalHeight > $maxHeight) {
                $image->scaleDown(width: $maxWidth, height: $maxHeight);
            }
            
            // Get final dimensions (after potential resize)
            $width = $image->width();
            $height = $image->height();
            
            // Convert to WebP format with 85% quality (good balance between quality and file size)
            $encodedImage = $image->toWebp(85);
            
            // Store the WebP image
            Storage::disk($disk)->put($path, $encodedImage->toString());
            
            // Log successful conversion
            Log::info('Image successfully converted to WebP', [
                'path' => $path,
                'final_width' => $width,
                'final_height' => $height
            ]);
            
            return [
                'path' => $path,
                'width' => $width,
                'height' => $height
            ];
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error converting image to WebP', [
                'error' => $e->getMessage(),
                'file' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType()
            ]);
            
            // Fallback: just store the original file if conversion fails
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $path = $directory . '/' . $filename;
            
            Storage::disk($disk)->putFileAs($directory, $file, $filename);
            
            // Get image dimensions
            [$width, $height] = getimagesize($file);
            
            return [
                'path' => $path,
                'width' => $width,
                'height' => $height
            ];
        }
    }
}
