<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            max-width: 200px;
            height: auto;
        }
        .header {
            color: #2a3d38;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .section-title {
            color: #2a3d38;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .detail-item {
            margin-bottom: 10px;
        }
        .emoji {
            margin-right: 8px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
        }
        .signature {
            margin-top: 20px;
            color: #2a3d38;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ asset('images/logo.jpg') }}" alt="Luova Tent Logo">
    </div>

    <div class="header">
        Beste {{ $booking->name }},
    </div>

    <p>Bedankt voor je boeking bij Luova Tent! We hebben je aanvraag ontvangen en zullen deze zo snel mogelijk in behandeling nemen.</p>

    <div class="section">
        <div class="section-title">Details van je boeking</div>
        <div class="detail-item">
            <span class="emoji">📅</span> Datum: {{ $booking->start_date->format('d-m-Y') }}{{ $numberOfDays > 1 ? " tot " . $booking->end_date->format('d-m-Y') : "" }}
        </div>
        @if(!empty($extras))
        <div class="detail-item">
            <span class="emoji">✨</span> Extra's: {{ implode(', ', $extras) }}
        </div>
        @endif
        @if($booking->notes)
        <div class="detail-item">
            <span class="emoji">💭</span> Opmerkingen: {{ $booking->notes }}
        </div>
        @endif
    </div>

    <div class="section">
        <div class="section-title">Je contactgegevens</div>
        <div class="detail-item">
            <span class="emoji">📧</span> E-mail: {{ $booking->email }}
        </div>
        <div class="detail-item">
            <span class="emoji">📱</span> Telefoon: {{ $booking->phone_number }}
        </div>
    </div>

    <div class="footer">
        <p>Heb je nog vragen? Neem gerust contact met ons op.</p>
        
        <div class="signature">
            Met vriendelijke groet,<br>
            Team Luova Tent
        </div>
    </div>
</body>
</html>
