{{-- SEO Meta Component for Luova Tent --}}
@props([
    'title' => 'Luova Tent - Stretchtent Verhuur voor Evenementen in Friesland',
    'description' => 'Huur een elegante stretchtent (10x15m) voor bruiloften, festivals, buurtfeesten en familiedagen. Inclusief opties voor silent disco, photobooth en foodtruck. Ruimte voor 150 personen.',
    'canonicalUrl' => null,
    'ogImage' => asset('images/logo-transparant.png'),
    'ogType' => 'website',
    'twitterCard' => 'summary_large_image',
    'includeFaqSchema' => 'false',
])

{{-- Primary Meta Tags --}}
<title>{{ $title }}</title>
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="tent verhuur, stretchtent, bruiloft tent, evenement tent, feesttent, Friesland, Leeuwarden, silent disco, photobooth, foodtruck">
<meta name="author" content="Luova Tent">
<meta name="robots" content="index, follow">
<meta name="language" content="Dutch">
<meta name="revisit-after" content="7 days">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- Canonical URL --}}
@if($canonicalUrl)
<link rel="canonical" href="{{ $canonicalUrl }}">
@else
<link rel="canonical" href="{{ url()->current() }}">
@endif

{{-- Open Graph / Facebook --}}
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:locale" content="nl_NL">
<meta property="og:site_name" content="Luova Tent">

{{-- Twitter --}}
<meta property="twitter:card" content="{{ $twitterCard }}">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $title }}">
<meta property="twitter:description" content="{{ $description }}">
<meta property="twitter:image" content="{{ $ogImage }}">

{{-- Structured Data / JSON-LD --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "Luova Tent",
    "image": "{{ asset('images/logo-transparant.png') }}",
    "url": "{{ url('/') }}",
    "telephone": "",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "Haniasteeg 7",
        "addressLocality": "Leeuwarden",
        "postalCode": "8911 BX",
        "addressCountry": "NL"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": 53.2012,
        "longitude": 5.7999
    },
    "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday"
        ],
        "opens": "09:00",
        "closes": "17:00"
    },
    "sameAs": [
        "https://www.facebook.com/luovatent",
        "https://www.instagram.com/luovatent"
    ],
    "priceRange": "€€",
    "description": "{{ $description }}"
}
</script>

{{-- Structured Data for Product --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Stretchtent Verhuur",
    "image": "{{ asset('images/068.jpg.jpeg') }}",
    "description": "Elegante stretchtent (10x15m) voor bruiloften, festivals, buurtfeesten en familiedagen. Ruimte voor 150 personen.",
    "brand": {
        "@type": "Brand",
        "name": "Luova Tent"
    },
    "offers": {
        "@type": "Offer",
        "url": "{{ url('/#booking') }}",
        "priceCurrency": "EUR",
        "availability": "https://schema.org/InStock"
    }
}
</script>

{{-- Structured Data for FAQs --}}
@if($includeFaqSchema === 'true')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        @foreach(\App\Models\Faq::where('is_published', true)->orderBy('order_column')->get() as $faq)
        {
            "@type": "Question",
            "name": "{{ $faq->question }}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{!! strip_tags($faq->answer) !!}"
            }
        }@if(!$loop->last),@endif
        @endforeach
    ]
}
</script>
@endif
