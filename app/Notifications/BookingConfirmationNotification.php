<?php

namespace App\Notifications;

use App\Models\Booking;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingConfirmationNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $extras = [];
        if (!empty($this->booking->extras)) {
            foreach ($this->booking->extras as $extra) {
                // First check if it's a product
                $product = Product::where('name', $extra)->first();
                if ($product) {
                    $extras[] = $product->title;
                } else {
                    // Handle legacy extras
                    switch ($extra) {
                        case 'photobooth':
                            $extras[] = 'Photobooth';
                            break;
                        case 'lights':
                            $extras[] = 'Priklichten';
                            break;
                        case 'foodtruck':
                            $extras[] = 'Foodtruck';
                            break;
                        case 'silent_disco':
                            $extras[] = 'Silent Disco';
                            break;
                        case 'sfeerlichten':
                            $extras[] = 'Sfeerlichten';
                            break;
                        case 'geluidsinstallatie':
                            $extras[] = 'Geluidsinstallatie';
                            break;
                    }
                }
            }
        }

        $numberOfDays = $this->booking->start_date->diffInDays($this->booking->end_date) + 1;

        return (new MailMessage)
            ->subject('Bevestiging van je boeking bij Luova Tent')
            ->view('emails.booking-confirmation', [
                'booking' => $this->booking,
                'extras' => $extras,
                'numberOfDays' => $numberOfDays
            ]);
    }
}
