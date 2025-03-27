<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'start_date',
        'end_date',
        'extras',
        'status',
        'notes',
        'guests',
        'location',
        'comments'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'extras' => 'array'
    ];

    protected static function booted()
    {
        static::created(function ($booking) {
            // Send notification to admin
            $admin = config('mail.admin_email');
            Notification::route('mail', $admin)
                ->notify(new \App\Notifications\NewBookingNotification($booking));

            // Send confirmation to customer
            Notification::route('mail', $booking->email)
                ->notify(new \App\Notifications\BookingConfirmationNotification($booking));
        });
    }
}
