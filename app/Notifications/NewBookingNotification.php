<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewBookingNotification extends Notification
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
                switch ($extra) {
                    case 'photobooth':
                        $extras[] = 'Interesse in photobooth';
                        break;
                    case 'lights':
                        $extras[] = 'Interesse in priklichten';
                        break;
                    case 'foodtruck':
                        $extras[] = 'Interesse in foodtruck';
                        break;
                }
            }
        }

        $numberOfDays = $this->booking->start_date->diffInDays($this->booking->end_date) + 1;

        return (new MailMessage)
            ->subject('Nieuwe Boeking - Luova Tent')
            ->greeting('Nieuwe Boeking Ontvangen')
            ->line('Er is een nieuwe boekingsaanvraag binnengekomen via de website.')
            ->line('')
            ->line('**Klantgegevens**')
            ->line('Naam: ' . $this->booking->name)
            ->line('Email: ' . $this->booking->email)
            ->line('Telefoonnummer: ' . $this->booking->phone_number)
            ->line('')
            ->line('**Boekingsdetails**')
            ->line('Start Datum: ' . $this->booking->start_date->format('d-m-Y'))
            ->line('Eind Datum: ' . $this->booking->end_date->format('d-m-Y'))
            ->line('Aantal Dagen: ' . $numberOfDays . ' ' . ($numberOfDays === 1 ? 'dag' : 'dagen'))
            ->when(!empty($extras), function ($message) use ($extras) {
                return $message
                    ->line('')
                    ->line('**Extra Opties**')
                    ->line(implode("\n", array_map(fn($extra) => '- ' . $extra, $extras)));
            })
            ->salutation('Met vriendelijke groet,');
    }
}
