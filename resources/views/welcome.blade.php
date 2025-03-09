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
        <h1>Luova tent, de perfecte tent</h1>
        <h2>Perfect voor een bruiloft, buurtfeest, familiedag, festival, teamuitje of zakelijke borrel. <br>
        Met een opperlakte van 10m x 15m heeft de tent ruimte aan maximaal 150 zitplaatsen.
        </h2>

        <img class="hero-image"
            src="{{ asset('images/068.jpg.jpeg') }}"
            alt="Elegant white wedding tent">

        <button class="button" id="showOptions">Bekijk de opties</button>
    </section>

    <section class="photos">
        <h1>Impressie van de tent</h1>
        <div class="gallery-grid" id="gallery">
            <a href="{{ asset('images/027.jpg') }}" data-pswp-width="1050" data-pswp-height="701">
                <img src="{{ asset('images/027.jpg') }}" alt="Elegant white wedding tent">
            </a>
            <a href="{{ asset('images/036.jpg') }}" data-pswp-width="1050" data-pswp-height="701">
                <img src="{{ asset('images/036.jpg') }}" alt="Wedding tent interior">
            </a>
            <a href="{{ asset('images/053.jpg') }}" data-pswp-width="1050" data-pswp-height="701">
                <img src="{{ asset('images/053.jpg') }}" alt="Wedding tent setup">
            </a>
            <a href="{{ asset('images/056.jpg') }}" data-pswp-width="1050" data-pswp-height="701">
                <img src="{{ asset('images/056.jpg') }}" alt="Wedding tent decoration">
            </a>
            <a href="{{ asset('images/059.jpg') }}" data-pswp-width="1050" data-pswp-height="701">
                <img src="{{ asset('images/059.jpg') }}" alt="Elegant white wedding tent">
            </a>
            <a href="{{ asset('images/061.jpg') }}" data-pswp-width="1050" data-pswp-height="701">
                <img src="{{ asset('images/061.jpg') }}" alt="Wedding tent interior">
            </a>
            <a href="{{ asset('images/062.jpg') }}" data-pswp-width="1050" data-pswp-height="701">
                <img src="{{ asset('images/062.jpg') }}" alt="Wedding tent setup">
            </a>
            <a href="{{ asset('images/068.jpg.jpeg') }}" data-pswp-width="2048" data-pswp-height="1536">
                <img src="{{ asset('images/068.jpg.jpeg') }}" alt="Wedding tent decoration">
            </a>
            <a href="{{ asset('images/321.jpg.jpeg') }}" data-pswp-width="1024" data-pswp-height="768">
                <img src="{{ asset('images/321.jpg.jpeg') }}" alt="Wedding tent decoration">
            </a>
            <a href="{{ asset('images/70.jpg.jpeg') }}" data-pswp-width="2048" data-pswp-height="1536">
                <img src="{{ asset('images/70.jpg.jpeg') }}" alt="Wedding tent decoration">
            </a>
        </div>
    </section>



    <section class="checklist">
        <h1>Veelgestelde vragen</h1>
        <div class="checklist-grid">

        <details class="checklist-item">
                <summary>
                    <h3>Wat kost het?</h3>
                    <span class="icon">+</span>
                </summary>
                <div class="content">
                    <ul>
                       <li>De basisprijs voor de tent is €1150,-</li>
                       <li>Bij langer huren krijg je korting</li>
                       <li>Reiskosten zijn 25 euro per uur</li>
                    </ul>
                </div>
            </details>
   

            <details class="checklist-item">
                <summary>
                    <h3>Is mijn locatie geschikt?</h3>
                    <span class="icon">+</span>
                </summary>
                <div class="content">
                    <ul>
                        <li>Zorg voor voldoende doorgang voor een auto met aanhanger.</li>
                        <li>We gebruiken lange grondpennen (100 cm). Let op: controleer vooraf de locatie van ondergrondse leidingen.</li>
                        <li>Voor het opbouwen van de tent is een oppervlakte nodig van 12 x 17, i.v.m de haringen</li>
                    </ul>
                </div>
            </details>

            <details class="checklist-item">
                <summary>
                    <h3>Wie bouwt de tent op?</h3>
                    <span class="icon">+</span>
                </summary>
                <div class="content">
                    <p>Zorg voor 3 sterke personen om te helpen bij het opzetten van de tent.</p>
                    <p>Hetzelfde geldt voor het afbouwen</p>
                </div>
            </details>

            <details class="checklist-item">
                <summary>
                    <h3>Wat doen we met slecht weer?</h3>
                    <span class="icon">+</span>
                </summary>
                <div class="content">
                    <p>Bij extreem slecht weer of windkracht boven 6 kunnen wij de tent niet plaatsen. Zorg voor een alternatief plan.</p>
                    <p>Kijk ook even naar onze annuleringsregeling!</p>
                </div>
            </details>

            <details class="checklist-item">
                <summary>
                    <h3>Droogtijd</h3>
                    <span class="icon">+</span>
                </summary>
                <div class="content">
                    <p>De tent moet droog worden opgevouwen. Bespreek de mogelijkheid om de tent op locatie te laten staan tot deze droog is.</p>
                </div>
            </details>

            <details class="checklist-item">
                <summary>
                    <h3>Annuleringsregeling</h3>
                    <span class="icon">+</span>
                </summary>
                <div class="content">
                    <p>Tot een week van te voren annuleren is gratis!</p>
                    <p>Tot 24 uur van te voren betaal je 20% van de totaalprijs.</p>
                    <p>Binnen 24 uur na annuleren betaal je 50%.</p>
                </div>
            </details>

            <details class="checklist-item">
                <summary>
                    <h3>Wat zijn de regels?</h3>
                    <span class="icon">+</span>
                </summary>
                <div class="content">
                    <ul>
                        <li>Niet koken of roken onder de tent</li>
                        <li>Geen papieren versieringen of confetti</li>
                        <li>Gebruik geen tape i.v.m vlekken</li>
                        <li>Tent mag niet verplaatst worden</li>
                    </ul>
                </div>
            </details>
            <details class="checklist-item">
                <summary>
                    <h3>Wat is er verantwoordelijk voor?</h3>
                    <span class="icon">+</span>
                </summary>
                <div class="content">
                    <ul>
                        <li>Tijdens het huren ben je verantwoordelijk voor de tent en de eventuele inrichting</li>
                        <li>Tijdens het opbouwen controleren we samene de veiligheid van de tent</li>
                    </ul>
                </div>
            </details>
        </div>
    </section>

    <section class="tent-info">
        <h1>Extra opties</h1>
        <div class="circle-gallery" id="circle-gallery">

            <a href="{{ asset('images/photobooth_2.jpeg') }}" class="circle-item" data-pswp-width="1200" data-pswp-height="1800">
                <img src="{{ asset('images/photobooth_2.jpeg') }}" alt="Fun photobooth moment">
                <span>Photobooth</span>
            </a>
            <a href="{{ asset('images/truck_1.png') }}" class="circle-item" data-pswp-width="1600" data-pswp-height="1067">
                <img src="{{ asset('images/truck_1.png') }}" alt="Foodtruck setup next to tent">
                <span>Foodtruck</span>
            </a>
        </div>
    </section>

    <section class="order" id="bookingForm">
        <h1>Vraag een offerte aan</h1>
        @if (session('success'))
            <div class="alert alert-success">
                <div class="success-content">
                    <div class="success-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif
        <form class="contact-form" method="POST" action="{{ route('bookings.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}">
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            

            <div class="form-group">
                <label for="phone_number">Telefoonnummer</label>
                <input type="tel" id="phone_number" name="phone_number" required value="{{ old('phone_number') }}">
                @error('phone_number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <h3>Extra opties</h3>
                <div class="checkbox-list">
                    <div class="checkbox-item">
                        <input type="checkbox" name="extras[]" value="photobooth" id="photobooth" {{ in_array('photobooth', old('extras', [])) ? 'checked' : '' }}>
                        <label for="photobooth">Interesse in photobooth</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" name="extras[]" value="lights" id="lights" {{ in_array('lights', old('extras', [])) ? 'checked' : '' }}>
                        <label for="lights">Interesse in priklichten</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" name="extras[]" value="foodtruck" id="foodtruck" {{ in_array('foodtruck', old('extras', [])) ? 'checked' : '' }}>
                        <label for="foodtruck">Interesse in foodtruck</label>
                    </div>
                </div>
                @error('extras')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="start_date">Datum van</label>
                <input type="date" id="start_date" name="start_date" required value="{{ old('start_date') }}" min="{{ date('Y-m-d') }}">
                @error('start_date')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="end_date">Datum tot</label>
                <input type="date" id="end_date" name="end_date" required value="{{ old('end_date') }}" min="{{ date('Y-m-d') }}">
                @error('end_date')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="button">Verstuur offerte aanvraag</button>
        </form>
    </section>
</main>

@endsection