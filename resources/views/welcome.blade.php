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


    <section class="hero">
        @php
            $tent = App\Models\Tent::where('is_published', true)->first();
        @endphp
        <h1>{{ $tent->heading ?? 'De perfecte tent' }}</h1>
        <h2>{{ $tent->subheading ?? 'Voor bruiloften, buurtfeest, familiedag, teamuitje, festivals met deze prachtige stretchtent van 10 x 15m is er ruimte voor 150 zitplaatsen' }}
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
                $products = App\Models\Product::where('is_published', true)
                    ->orderBy('created_at')
                    ->get();
            @endphp
            
            @foreach($products as $product)
            <div class="circle-item" data-title="{{ $product->title }}">
                <div class="modal-content-template" hidden>
                    <img class="modal-image" src="{{ $product->image_url }}" alt="{{ $product->title }}">
                    {!! $product->content !!}
                </div>
                <img src="{{ $product->image_url }}" alt="{{ $product->title }}">
                <span>{{ $product->title }}</span>
            </div>
            @endforeach
        </div>
    </section>

    <dialog id="optionModal" class="modal">
        <form method="dialog" class="modal-content">
            <button class="close-button" aria-label="Close modal">×</button>
            <div class="modal-content-wrapper">
                <h2 id="modalTitle"></h2>
                <div id="modalContentText" class="modal-text-content"></div>
            </div>
        </form>
    </dialog>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('optionModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalContentText = document.getElementById('modalContentText');
            const closeButton = modal.querySelector('.close-button');

            document.querySelectorAll('.circle-item').forEach(item => {
                item.addEventListener('click', () => {
                    modalTitle.textContent = item.dataset.title;
                    const template = item.querySelector('.modal-content-template');
                    const content = template.innerHTML;
                    
                    // Put all content in the text area
                    modalContentText.innerHTML = content;
                    modal.showModal();
                });
            });
            
            // Close modal when clicking the close button
            closeButton.addEventListener('click', () => {
                modal.close();
            });
            
            // Close modal when clicking outside
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.close();
                }
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
            max-height: 85vh;
            overflow: hidden;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin: 0;
        }

        dialog.modal::backdrop {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            max-height: 85vh;
        }
        
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        
        .close-button:hover {
            background: rgba(255, 255, 255, 0.9);
        }
        
        .modal-content-wrapper {
            padding: 1.5rem;
            overflow-y: auto;
            flex-grow: 1;
        }
        
        .modal-text-content {
            margin-top: 1rem;
        }
        
        /* Improved image styling within the modal content */
        .modal-text-content .modal-image {
            width: 300px;
            height: 300px;
            object-fit: contain;
            border-radius: 8px;
            margin: 0 auto 1.5rem;
            display: block;
            background-color: #f5f5f5;
        }

        @media (max-width: 768px) {
            dialog.modal {
                width: 95%;
                max-height: 80vh;
            }
            
            .modal-content-wrapper {
                padding: 1rem;
            }
            
            #modalTitle {
                font-size: 1.5rem;
                margin-top: 0.5rem;
            }
        }
        
        @media (max-width: 480px) {
            .modal-content-wrapper {
                padding: 0.75rem;
            }
            
            #modalTitle {
                font-size: 1.25rem;
            }
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