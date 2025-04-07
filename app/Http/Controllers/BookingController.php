<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewBookingNotification;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'extras' => 'nullable|array',
        ], [
            'extras.array' => 'Er is een fout opgetreden bij het verwerken van de extra opties.',
        ]);

        $booking = new Booking();
        $booking->name = $validated['name'];
        $booking->email = $validated['email'];
        $booking->phone_number = $validated['phone_number'];
        $booking->start_date = Carbon::parse($validated['start_date'])->startOfDay();
        $booking->end_date = Carbon::parse($validated['end_date'])->endOfDay();
        $booking->extras = $validated['extras'] ?? [];
        $booking->save();

        // Send notification to info@luovatent.nl
        Notification::route('mail', 'info@luovatent.nl')
            ->notify(new NewBookingNotification($booking));

        return redirect()->back()->with('success', 'Bedankt voor je aanvraag! We nemen zo snel mogelijk contact met je op.');
    }

    public function getUnavailableDates()
    {
        $bookings = Booking::where('end_date', '>=', now())
            ->get(['start_date', 'end_date']);

        return response()->json($bookings);
    }
}
