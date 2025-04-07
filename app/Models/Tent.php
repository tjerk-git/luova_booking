<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tent extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'subheading',
        'is_published',
    ];
}
