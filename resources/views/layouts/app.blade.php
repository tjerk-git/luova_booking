<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Luova Tent')</title>

        <link rel="stylesheet" href="{{ asset('style.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.3.8/dist/photoswipe.css">

        @yield('head')
    </head>

    <body>
        <header>
            <div class="logo">
                <a href="/">Luova</a>
            </div>

            <nav class="main-nav">
                <ul>
                    <li><a href="/">De tent</a></li>
                    <li><a href="/photobooth">Impressie</a></li>
                    <li><a href="/foodtruck">Over ons</a></li>
                </ul>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="footer-content">
            <div class="footer-section">
                <img src="{{ asset('images/jurjenenjos.jpeg') }}" alt="Luova Tent founders Jurjen en Josytha Hakvoort" class="founders-image">
                </div>

                <div class="footer-section">
                    <h4>Contact</h4>
                    <ul>
                    <li>Josytha Hakvoort</li>
                        <li><a href="mailto:info@luovatent.nl">info@luovatent.nl</a></li>
                        <li>KvK: 94238340</li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Locatie</h4>
                    <ul>
                        <li>Luova Tent</li>
                        <li>Haniasteeg 7</li>
                        <li>8911 BX Leeuwarden</li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Informatie</h4>
                    <ul>
                        <li><a href="/voorwaarden">Algemene voorwaarden</a></li>
                        <li><a href="/faq">Veelgestelde vragen</a></li>
                    </ul>
                </div>

   
      
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Luova Tent. Alle rechten voorbehouden.</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
        <script src="{{ asset('site.js') }}"></script>
    </body>
</html>