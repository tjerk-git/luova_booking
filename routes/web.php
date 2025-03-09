<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Models\Booking;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Temporary route for email preview
Route::get('/email-preview', function () {
    $booking = new Booking([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone_number' => '0612345678',
        'start_date' => Carbon::now()->addDays(5),
        'end_date' => Carbon::now()->addDays(7),
        'extras' => ['photobooth', 'lights', 'foodtruck']
    ]);

    return view('emails.new-booking', ['booking' => $booking]);
});
