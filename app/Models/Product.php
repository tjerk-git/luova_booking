<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'image',
        'content',
        'is_published',
        'order_column',
        'silent_disco_content',
        'photobooth_content',
        'foodtruck_content',
        'silent_disco_image',
        'photobooth_image',
        'foodtruck_image',
        'tent_heading',
        'tent_subheading',
    ];
    
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function (Product $product) {
            // Process temporary uploaded image if it exists
            if ($product->image && str_starts_with($product->image, 'livewire-tmp')) {
                $tmpPath = Storage::disk('local')->path('livewire-tmp/' . basename($product->image));
                
                if (file_exists($tmpPath)) {
                    $imageService = app(ImageService::class);
                    $uploadedFile = new \Illuminate\Http\UploadedFile(
                        $tmpPath,
                        basename($product->image),
                        Storage::disk('local')->mimeType('livewire-tmp/' . basename($product->image)),
                        null,
                        true
                    );
                    
                    $result = $imageService->convertToWebP($uploadedFile, 'products');
                    $product->image = $result['path'];
                }
            }
        });
    }
    
    /**
     * Get the URL for the product image
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-product.jpg');
    }
    
    /**
     * Get the URL for the silent disco image
     */
    public function getSilentDiscoImageUrlAttribute()
    {
        if ($this->silent_disco_image) {
            return asset('storage/' . $this->silent_disco_image);
        }
        return asset('images/silent_disco-compressed.jpeg');
    }
    
    /**
     * Get the URL for the photobooth image
     */
    public function getPhotoboothImageUrlAttribute()
    {
        if ($this->photobooth_image) {
            return asset('storage/' . $this->photobooth_image);
        }
        return asset('images/photobooth_2.jpeg');
    }
    
    /**
     * Get the URL for the foodtruck image
     */
    public function getFoodtruckImageUrlAttribute()
    {
        if ($this->foodtruck_image) {
            return asset('storage/' . $this->foodtruck_image);
        }
        return asset('images/foodtruck-compressed.jpeg');
    }
}
