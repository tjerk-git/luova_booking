<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nieuwe Boeking - Luova Tent</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.5; color: #1e293b; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="color: rgb(181, 73, 34); margin: 0; font-size: 24px;">Nieuwe Boeking Ontvangen</h1>
        <p style="color: #64748b; margin-top: 10px;">Er is een nieuwe boekingsaanvraag binnengekomen via de website.</p>
    </div>
    
    <div style="background: #fff5f2; border: 1px solid rgb(181, 73, 34); padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <h2 style="color: rgb(181, 73, 34); margin-top: 0; font-size: 18px;">Klantgegevens</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0; color: #64748b; width: 140px;">Naam</td>
                <td style="padding: 8px 0;">{{ $booking->name }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; color: #64748b;">Email</td>
                <td style="padding: 8px 0;">{{ $booking->email }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; color: #64748b;">Telefoonnummer</td>
                <td style="padding: 8px 0;">{{ $booking->phone_number }}</td>
            </tr>
        </table>
    </div>

    <div style="background: #fff5f2; border: 1px solid rgb(181, 73, 34); padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <h2 style="color: rgb(181, 73, 34); margin-top: 0; font-size: 18px;">Boekingsdetails</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0; color: #64748b; width: 140px;">Start Datum</td>
                <td style="padding: 8px 0;">{{ $booking->start_date->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; color: #64748b;">Eind Datum</td>
                <td style="padding: 8px 0;">{{ $booking->end_date->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; color: #64748b;">Aantal Dagen</td>
                <td style="padding: 8px 0;">{{ $booking->start_date->diffInDays($booking->end_date) + 1 }} dagen</td>
            </tr>
        </table>
    </div>

    @if(!empty($booking->extras))
    <div style="background: #fff5f2; border: 1px solid rgb(181, 73, 34); padding: 20px; border-radius: 8px;">
        <h2 style="color: rgb(181, 73, 34); margin-top: 0; font-size: 18px;">Extra Opties</h2>
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @foreach($booking->extras as $extra)
                <li style="padding: 8px 0; color: #1e293b;">
                    <span style="color: rgb(181, 73, 34); margin-right: 8px;">✓</span>
                    @if($extra === 'photobooth')
                        Interesse in photobooth
                    @elseif($extra === 'lights')
                        Interesse in priklichten
                    @elseif($extra === 'foodtruck')
                        Interesse in foodtruck
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0; text-align: center;">
        <p style="margin: 0; font-size: 14px; color: #64748b;">
            Deze email is automatisch verzonden vanuit het boekingssysteem van Luova Tent.
        </p>
    </div>
</body>
</html>
