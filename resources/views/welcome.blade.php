@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('title', 'Luova Tent - Elegante Stretchtent Verhuur voor Evenementen in Friesland')

@section('description', 'Huur een prachtige stretchtent (10x15m) voor bruiloften, festivals, buurtfeesten en familiedagen in Friesland. Met opties voor silent disco, photobooth en foodtruck. Ruimte voor 150 personen.')

@section('ogImage', asset('images/068.jpg.jpeg'))

@section('head')
    <meta name="description" content="@yield('description')">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('ogImage')">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    
    <!-- Micromodal.js for better modal support across all browsers and devices -->
    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.3.8/dist/photoswipe.min.css">
    <script type="module">
        import PhotoSwipeLightbox from 'https://cdn.jsdelivr.net/npm/photoswipe@5.3.8/dist/photoswipe-lightbox.esm.min.js'
        import PhotoSwipe from 'https://cdn.jsdelivr.net/npm/photoswipe@5.3.8/dist/photoswipe.esm.min.js'

        document.addEventListener('DOMContentLoaded', function() {
            const galleryIds = ['gallery', 'circle-gallery'];
            
            galleryIds.forEach(galleryId => {
                const lightbox = new PhotoSwipeLightbox({
                    gallery: '#' + galleryId,
                    children: 'a',
                    pswpModule: PhotoSwipe,
                    paddingFn: (viewportSize) => {
                        return {
                            top: 30,
                            bottom: 30,
                            left: 0,
                            right: 0
                        }
                    }
                });
                lightbox.init();
            });
            
            // Scroll animation observer
            const animatedElements = document.querySelectorAll('.animate-on-scroll');
            
            // Immediately show hero elements without waiting for scroll on page load
            setTimeout(() => {
                document.querySelectorAll('.hero .animate-on-scroll').forEach((el, index) => {
                    setTimeout(() => {
                        el.classList.add('visible');
                    }, 300 * index); // Staggered animation for hero elements
                });
            }, 300);
            
            // Set up intersection observer for scroll animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        // Once the animation has played, no need to observe anymore
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            // Observe all animated elements except those in the hero section (which animate on load)
            animatedElements.forEach(el => {
                if (!el.closest('.hero')) {
                    observer.observe(el);
                }
            });
            
            // Parallax effect for hero section
            const heroSection = document.querySelector('.hero');
            const heroImage = document.querySelector('.hero-image');
            const shapes = document.querySelectorAll('.shape');
            
            if (heroSection && window.innerWidth > 1024) {
                window.addEventListener('scroll', () => {
                    const scrollPosition = window.scrollY;
                    const heroTop = heroSection.offsetTop;
                    const heroHeight = heroSection.offsetHeight;
                    
                    // Only apply parallax when hero section is in view
                    if (scrollPosition >= heroTop - window.innerHeight && 
                        scrollPosition <= heroTop + heroHeight) {
                        
                        const scrollPercentage = (scrollPosition - (heroTop - window.innerHeight)) / 
                                               (heroHeight + window.innerHeight);
                        
                        // Move hero image slightly
                        if (heroImage) {
                            heroImage.style.transform = `translateY(${scrollPercentage * 50}px) rotate(${scrollPercentage * 5}deg)`;
                        }
                        
                        // Move shapes at different speeds
                        shapes.forEach((shape, index) => {
                            const speed = (index + 1) * 0.2;
                            shape.style.transform = `translate(${scrollPercentage * 100 * speed}px, ${scrollPercentage * 100 * speed}px)`;
                        });
                    }
                });
            }

        });
    </script>
    <template id="pswp-template" data-pswp-template>
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap">
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>
    </template>
@endsection

@section('content')


    <section class="hero">
        @php
            $tent = App\Models\Tent::where('is_published', true)->first();
        @endphp
        <div class="hero-content">
            <h1 class="animate-on-scroll fade-in">{{ $tent->heading ?? 'De perfecte tent' }}</h1>
            <h2 class="animate-on-scroll fade-in-delay">{{ $tent->subheading ?? 'Voor bruiloften, buurtfeest, familiedag, teamuitje, festivals met deze prachtige stretchtent van 10 x 15m is er ruimte voor 150 zitplaatsen' }}</h2>
            <button id="options-button" class="button animate-on-scroll pulse">Bekijk de opties</button>
        </div>

        <div class="hero-image-container">

            <img class="hero-image animate-on-scroll float"
                src="/images/068.jpg.jpeg"
                alt="Elegant white wedding tent">

        </div>
        
        <div class="scroll-indicator animate-on-scroll fade-in-delay">
            <span>Scroll voor meer</span>
            <div class="scroll-arrow"></div>
        </div>
    </section>


    <section class="photos">
        <h1 class="animate-on-scroll fade-in">Impressie van de tent</h1>
        <div class="gallery-grid" id="gallery">
            @foreach(\App\Models\Photo::where('is_published', true)->orderBy('order_column')->get() as $photo)
            <a href="{{ asset('storage/' . $photo->image_path) }}" data-pswp-width="{{ $photo->width }}" data-pswp-height="{{ $photo->height }}">
                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->alt_text ?? $photo->title }}">
            </a>
            @endforeach
        </div>
    </section>

    <section class="checklist" id="faq">

        <h1 class="animate-on-scroll fade-in">Even alles op een rijtje...</h1>
        <div class="checklist-grid">
            @foreach(\App\Models\Faq::where('is_published', true)->orderBy('order_column')->get() as $faq)
                <details class="checklist-item">
                    <summary>
                        <h3>{{ $faq->question }}</h3>
                        <span class="icon"></span>
                    </summary>
                    <div class="content">
                        {!! $faq->answer !!}
                    </div>
                </details>
            @endforeach
        </div>
        
    </section>

    <section class="extra-options" id="extra-options">
        <div class="section-container">
  
            <h1 class="animate-on-scroll fade-in">Wel eens gedacht aan?</h1>
            <div class="options-grid">
                @php
                    $products = App\Models\Product::where('is_published', true)
                        ->orderBy('created_at')
                        ->get();
                @endphp
                
                @foreach($products as $product)
                <div class="option-item" data-micromodal-trigger="modal-{{ $product->id }}">
                    <div class="option-image">
                        <img src="{{ $product->image_url }}" alt="{{ $product->title }}">
                    </div>
                    <h2>{{ $product->title }}</h2>
                    <div class="hidden-content" hidden>
                        <img class="modal-image" src="{{ $product->image_url }}" alt="{{ $product->title }}">
                        {!! $product->content !!}
                    </div>
                </div>
                
                <!-- Modal for {{ $product->title }} -->
                <div class="modal micromodal-slide" id="modal-{{ $product->id }}" aria-hidden="true">
                    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
                        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-{{ $product->id }}-title">
                            <header class="modal__header">
                                <h2 class="modal__title" id="modal-{{ $product->id }}-title">
                                    {{ $product->title }}
                                </h2>
                                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                            </header>
                            <main class="modal__content" id="modal-{{ $product->id }}-content">
                                <div class="modal__image-container">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="modal__image">
                                </div>
                                <div class="modal__text">
                                    {!! $product->content !!}
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="booking" class="booking">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
            <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
            <script>
                confetti({
                    particleCount: 100,
                    spread: 70,
                    origin: { y: 0.6 }
                });
                
                document.getElementById('booking').scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            </script>
        @endif
        <h1 class="animate-on-scroll fade-in">Laten we elkaar spreken!</h1>
        <form method="POST" action="{{ route('bookings.store') }}" class="booking-form">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="phone_number">Telefoonnummer</label>
                <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">Start Datum</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="end_date">Eind Datum</label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                    @error('end_date')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Extra Opties</label>
                <div class="checkbox-group">
                    @php
                        $products = App\Models\Product::where('is_published', true)->get();
                    @endphp
                    
                    @foreach($products as $product)
                    <div class="checkbox-option">
                        <input type="checkbox" id="{{ $product->name }}" name="extras[]" value="{{ $product->name }}" {{ in_array($product->name, old('extras', [])) ? 'checked' : '' }}>
                        <label for="{{ $product->name }}">Interesse in {{ $product->title }}</label>
                    </div>
                    @endforeach
                </div>
                @error('extras')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="button">Boek Nu</button>
        </form>
    </section>

@endsection