<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'alt_text',
        'image_path',
        'width',
        'height',
        'order_column',
        'is_published',
    ];
    
    protected $casts = [
        'is_published' => 'boolean',
        'width' => 'integer',
        'height' => 'integer',
        'order_column' => 'integer',
    ];
    
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::deleting(function (Photo $photo) {
            if (Storage::disk('public')->exists($photo->image_path)) {
                Storage::disk('public')->delete($photo->image_path);
            }
        });
    }
}
