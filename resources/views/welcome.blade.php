@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('head')
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
<main>

    <section class="hero">
        @php
            $product = App\Models\Product::first();
        @endphp
        <h1>{{ $product->tent_heading ?? 'De perfecte tent' }}</h1>
        <h2>{{ $product->tent_subheading ?? 'Voor bruiloften, buurtfeest, familiedag, teamuitje, festivals met deze prachtige stretchtent van 10 x 15m is er ruimte voor 150 zitplaatsen' }}
        </h2>

        <img class="hero-image"
            src="/images/068.jpg.jpeg"
            alt="Elegant white wedding tent">

        <button id="options-button" class="button">Bekijk de opties</button>
    </section>


    <section class="photos">
        <h1>Impressie van de tent</h1>
        <div class="gallery-grid" id="gallery">
            @foreach(\App\Models\Photo::where('is_published', true)->orderBy('order_column')->get() as $photo)
            <a href="{{ asset('storage/' . $photo->image_path) }}" data-pswp-width="{{ $photo->width }}" data-pswp-height="{{ $photo->height }}">
                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->alt_text ?? $photo->title }}">
            </a>
            @endforeach
        </div>
    </section>

    <section class="checklist" id="faq">
        <h1>Veelgestelde vragen</h1>
        <div class="checklist-grid">
            @foreach(\App\Models\Faq::where('is_published', true)->orderBy('order_column')->get() as $faq)
                <details class="checklist-item">
                    <summary>
                        <h3>{{ $faq->question }}</h3>
                        <span class="icon">+</span>
                    </summary>
                    <div class="content">
                        {!! $faq->answer !!}
                    </div>
                </details>
            @endforeach
        </div>
    </section>

    <section class="tent-info">
        <h1>Extra opties</h1>
        <div class="circle-gallery" id="circle-gallery">
            @php
                $product = App\Models\Product::first();
            @endphp
            
            <div class="circle-item" data-title="Silent Disco - €140,-">
                <div class="modal-content-template" hidden>
                    <img class="modal-image" src="{{ asset('images/silent_disco-compressed.jpeg') }}" alt="Silent Disco setup next to tent">
                    {!! $product->silent_disco_content !!}
                </div>
                <img src="{{ asset('images/silent_disco-compressed.jpeg') }}" alt="Silent Disco setup next to tent">
                <span>Silent Disco</span>
            </div>
            <div class="circle-item" data-title="Een leuke photobooth">
                <div class="modal-content-template" hidden>
                    <img class="modal-image" src="{{ asset('images/photobooth_2.jpeg') }}" alt="Fun photobooth moment">
                    {!! $product->photobooth_content !!}
                </div>
                <img src="{{ asset('images/photobooth_2.jpeg') }}" alt="Fun photobooth moment">
                <span>Photobooth</span>
            </div>
            <div class="circle-item" data-title="Een lekkere foodtruck">
                <div class="modal-content-template" hidden>
                    <img class="modal-image" src="{{ asset('images/foodtruck-compressed.jpeg') }}" alt="Foodtruck setup next to tent">
                    {!! $product->foodtruck_content !!}
                </div>
                <img src="{{ asset('images/foodtruck-compressed.jpeg') }}" alt="Foodtruck setup next to tent">
                <span>Foodtruck</span>
            </div>
        </div>
    </section>

    <dialog id="optionModal" class="modal">
        <form method="dialog" class="modal-content">
            <div id="modalContent"></div>
            <div class="modal-content-wrapper">
                <h2 id="modalTitle"></h2>
                <div id="modalContentText"></div>
                <button>Sluiten</button>
            </div>
        </form>
    </dialog>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('optionModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalContent = document.getElementById('modalContent');
            const modalContentText = document.getElementById('modalContentText');

            document.querySelectorAll('.circle-item').forEach(item => {
                item.addEventListener('click', () => {
                    modalTitle.textContent = item.dataset.title;
                    const template = item.querySelector('.modal-content-template');
                    const content = template.innerHTML;
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = content;
                    
                    // Move the image to the top content area
                    const image = tempDiv.querySelector('.modal-image');
                    if (image) {
                        modalContent.innerHTML = image.outerHTML;
                        image.remove();
                    }
                    
                    // Put the rest of the content in the text area
                    modalContentText.innerHTML = tempDiv.innerHTML;
                    modal.showModal();
                });
            });
        });
    </script>

    <style>
        dialog.modal {
            padding: 0;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            width: 90%;
            max-width: 800px;
            max-height: 90vh; /* Limit height to 90% of viewport height */
            overflow: hidden; /* Keep this to hide overflow from rounded corners */
        }

        dialog.modal::backdrop {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            max-width: 100%;
            max-height: 90vh; /* Match dialog max-height */
            display: flex;
            flex-direction: column;
        }

        .modal-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            margin-bottom: 0;
            flex-shrink: 0; /* Prevent image from shrinking */
        }

        @media (max-width: 768px) {
            .modal-image {
                height: 250px; /* Reduced height for mobile */
                object-fit: cover;
                display: block !important; /* Force display */
                visibility: visible !important; /* Ensure visibility */
            }
            
            .modal-content-wrapper {
                padding: 1.5rem;
            }
        }

        .modal-content-wrapper {
            padding: 2rem;
            overflow-y: auto; /* Add scroll to the content wrapper */
            flex-grow: 1; /* Allow content to grow and take available space */
        }

        .modal h2 {
            color: #2a3d38;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 1.5rem;
        }

        .modal-content p {
            line-height: 1.6;
            color: #4a5568;
            margin-bottom: 1rem;
        }

        .modal-content ul {
            margin: 1rem 0;
            padding-left: 1.5rem;
            color: #4a5568;
        }

        .modal-content h3 {
            color: #2a3d38;
            font-family: 'Poppins', sans-serif;
            margin: 1.5rem 0 1rem;
        }

        .modal button {
            margin-top: 2rem;
            padding: 0.75rem 2rem;
            background: #2a3d38;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: background-color 0.2s ease;
        }

        .modal button:hover {
            background: #1a2d28;
        }
    </style>

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
        <h1>Boek de tent</h1>
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
                    <div class="checkbox-option">
                        <input type="checkbox" id="photobooth" name="extras[]" value="photobooth" {{ in_array('photobooth', old('extras', [])) ? 'checked' : '' }}>
                        <label for="photobooth">Interesse in photobooth</label>
                    </div>
                    <div class="checkbox-option">
                        <input type="checkbox" id="lights" name="extras[]" value="lights" {{ in_array('lights', old('extras', [])) ? 'checked' : '' }}>
                        <label for="lights">Interesse in priklichten</label>
                    </div>
                    <div class="checkbox-option">
                        <input type="checkbox" id="foodtruck" name="extras[]" value="foodtruck" {{ in_array('foodtruck', old('extras', [])) ? 'checked' : '' }}>
                        <label for="foodtruck">Interesse in foodtruck</label>
                    </div>
                </div>
                @error('extras')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="button">Boek Nu</button>
        </form>
    </section>
</main>

@endsection