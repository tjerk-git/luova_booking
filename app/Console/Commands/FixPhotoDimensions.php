<?php

namespace App\Console\Commands;

use App\Models\Photo;
use App\Services\ImageService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FixPhotoDimensions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:fix-dimensions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix width and height dimensions for all photos in the database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting to fix photo dimensions...');
        
        $photos = Photo::all();
        $imageService = new ImageService();
        $count = 0;
        
        $this->output->progressStart($photos->count());
        
        foreach ($photos as $photo) {
            try {
                // Get accurate dimensions using ImageService
                $dimensions = $imageService->getDimensions($photo->image_path);
                
                // Update the photo with correct dimensions
                $photo->update([
                    'width' => $dimensions['width'],
                    'height' => $dimensions['height'],
                ]);
                
                $count++;
                $this->output->progressAdvance();
            } catch (\Exception $e) {
                Log::error('Error fixing photo dimensions', [
                    'photo_id' => $photo->id,
                    'path' => $photo->image_path,
                    'error' => $e->getMessage()
                ]);
                
                $this->error("Error processing photo ID {$photo->id}: {$e->getMessage()}");
            }
        }
        
        $this->output->progressFinish();
        $this->info("Successfully updated dimensions for {$count} photos out of {$photos->count()}");
        
        return Command::SUCCESS;
    }
}
