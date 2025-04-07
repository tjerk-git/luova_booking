<?php

namespace App\Console\Commands;

use App\Services\FaviconService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateFavicon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'favicon:generate {--source=public/images/logo-transparant.png : Path to source logo file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a favicon from the logo';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $sourcePath = $this->option('source');
        $outputDir = public_path();
        
        $this->info('Generating favicon...');
        $this->info("Source: {$sourcePath}");
        $this->info("Destination directory: {$outputDir}");
        
        if (!File::exists($sourcePath)) {
            $this->error("Source file not found: {$sourcePath}");
            return Command::FAILURE;
        }
        
        $faviconService = new FaviconService();
        $result = $faviconService->generateFavicon($sourcePath, $outputDir);
        
        if ($result) {
            $this->info('Favicons generated successfully!');
            $this->info('Generated the following files:');
            $this->info('- favicon.png (standard favicon)');
            $this->info('- favicon-16x16.png, favicon-32x32.png, etc. (various sizes)');
            return Command::SUCCESS;
        } else {
            $this->error('Failed to generate favicons.');
            return Command::FAILURE;
        }
    }
}
