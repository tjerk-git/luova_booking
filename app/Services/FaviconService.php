<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FaviconService
{
    protected $manager;
    
    public function __construct()
    {
        // Create a new ImageManager instance with GD driver
        $this->manager = new ImageManager(new Driver());
    }
    
    /**
     * Generate a favicon from the given logo
     *
     * @param string $logoPath Path to the logo file
     * @param string $outputDir Directory where the favicon files should be saved
     * @return bool Whether the operation was successful
     */
    public function generateFavicon(string $logoPath, string $outputDir): bool
    {
        try {
            Log::info('Generating favicon', [
                'source' => $logoPath,
                'destination' => $outputDir
            ]);
            
            // Read the source image
            $image = $this->manager->read($logoPath);
            
            // Generate different favicon sizes
            $sizes = [16, 32, 48, 64, 128, 192, 512];
            
            foreach ($sizes as $size) {
                // Create a square canvas
                $canvas = $this->manager->create($size, $size);
                
                // Resize the logo to fit within the canvas while maintaining aspect ratio
                $resized = clone $image;
                $resized->scaleDown(width: $size, height: $size);
                
                // Place the resized logo on the canvas
                $canvas->place($resized, 'center');
                
                // Save as PNG
                $outputPath = $outputDir . "/favicon-{$size}x{$size}.png";
                $canvas->toPng()->save($outputPath);
                
                Log::info("Generated favicon size {$size}x{$size}");
            }
            
            // Create the standard favicon.ico (multi-size ICO file)
            // For simplicity, we'll just use the 32x32 PNG as favicon.png
            $outputPath = $outputDir . "/favicon.png";
            $canvas = $this->manager->create(32, 32);
            $resized = clone $image;
            $resized->scaleDown(width: 32, height: 32);
            $canvas->place($resized, 'center');
            $canvas->toPng()->save($outputPath);
            
            Log::info('Favicon generated successfully');
            
            return true;
        } catch (\Exception $e) {
            Log::error('Error generating favicon', [
                'error' => $e->getMessage(),
                'source' => $logoPath
            ]);
            
            return false;
        }
    }
}
