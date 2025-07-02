<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Include SEO Meta Tags --}}
    <x-seo-meta 
        title="{{ View::hasSection('title') ? View::getSection('title') : 'Luova Tent - Stretchtent Verhuur voor Evenementen in Friesland' }}"
        description="{{ View::hasSection('description') ? View::getSection('description') : 'Huur een elegante stretchtent (10x15m) voor bruiloften, festivals, buurtfeesten en familiedagen. Inclusief opties voor silent disco, photobooth en foodtruck. Ruimte voor 150 personen.' }}"
        ogImage="{{ View::hasSection('ogImage') ? View::getSection('ogImage') : asset('images/logo-transparant.png') }}"
        includeFaqSchema="{{ request()->path() === '/' ? 'true' : 'false' }}"
    />
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('favicon-16x16.png') }}" type="image/png" sizes="16x16">
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/png" sizes="32x32">
    <link rel="icon" href="{{ asset('favicon-48x48.png') }}" type="image/png" sizes="48x48">
    <link rel="apple-touch-icon" href="{{ asset('favicon-192x192.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('favicon-192x192.png') }}">
    
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.3.8/dist/photoswipe.css">
    <script defer src="https://cloud.umami.is/script.js" data-website-id="00fef24d-f93c-4458-abd0-3c70411f4273"></script>
    @yield('head')
</head>
<body>
    <header>
        <div class="logo">
            <a href="/"><img src="{{ asset('/images/logo-transparant.png') }}" alt="Luova Tent Logo"></a>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="#gallery">Impressie</a></li>
                <li><a href="#circle-gallery">Extra's</a></li>
                <li><a href="#faq">Veelgestelde vragen</a></li>
                <li><a href="#booking">Neem contact op</a></li>
            </ul>
        </nav>
        <button class="menu-toggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
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
                    <li><a href="tel:+31628099530">+31 6 28099530</a></li>
                    <li>KvK: 94238340</li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Locatie</h4>
                <ul>
                    <li>Luova Tent</li>
                    <li>Haniasteeg 7</li>
                    <li>8911 BX Leeuwarden</li>
                    <li><a href="https://maps.app.goo.gl/saCfPdnUuf1S9q5e6" target="_blank">Open Google Maps</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Informatie</h4>
                <ul>
                    <li><a href="{{ asset('assets/algemene-voorwaarden-luova.pdf') }}" target="_blank">Algemene voorwaarden</a></li>
                    <li><a href="#faq">Veelgestelde vragen</a></li>
                    <li><a href="{{ asset('assets/privacy-policy-luova.pdf') }}" target="_blank">Privacy policy</a></li>
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