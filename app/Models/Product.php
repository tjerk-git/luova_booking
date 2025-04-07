<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'silent_disco_content',
        'photobooth_content',
        'foodtruck_content',
        'tent_heading',
        'tent_subheading',
    ];
}
