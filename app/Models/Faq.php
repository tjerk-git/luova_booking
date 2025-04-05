<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'question',
        'answer',
        'order_column',
        'is_published',
    ];
    
    protected $casts = [
        'is_published' => 'boolean',
    ];
}
