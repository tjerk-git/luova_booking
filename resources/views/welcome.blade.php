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
        <h1>De perfecte tent</h1>
        <h2>Voor bruiloften, buurtfeest, familiedag, teamuitje, festivals met deze prachtige stretchtent van 10 x 15m is er ruimte voor 150 zitplaatsen
        </h2>


        <img class="hero-image"
            src="/images/068.jpg.jpeg"
            alt="Elegant white wedding tent">

        <button id="options-button" class="button">Bekijk de opties</button>
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



    <section class="checklist" id="faq">
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
            <div class="circle-item" data-title="Silent Disco - €140,-">
                <div class="modal-content-template" hidden>
                    <img class="modal-image" src="{{ asset('images/silent_disco-compressed.jpeg') }}" alt="Silent Disco setup next to tent">
                    <p>Elke DJ (of act) brengt zijn eigen vibe, en jij bepaalt zelf waar je zin in hebt, gewoon met een druk op de knop van je koptelefoon! De gekleurde lampjes rood en groen laten je meteen zien wie hetzelfde kanaal luistert. Knettersvals meezingen met de grootste hits, terwijl je buurman lekker danst op een totaal ander nummer. Iedereen in zijn eigen wereld, maar toch samen op de dansvloer.</p>
                    
                    <h3>Inhoud:</h3>
                    <ul>
                        <li>32 koptelefoons (volledig opgeladen)</li>
                        <li>2 zenders</li>
                        <li>Opslag boxen</li>
                        <li>Aux kabels</li>
                        <li>Stekkerdoos 6-voudig</li>
                        <li>Transportkar</li>
                    </ul>
                    <p>Wilt u meer koptelefoons laat het ons weten.</p>
                </div>
                <img src="{{ asset('images/silent_disco-compressed.jpeg') }}" alt="Silent Disco setup next to tent">
                <span>Silent Disco</span>
            </div>
            <div class="circle-item" data-title="Een leuke photobooth">
                <div class="modal-content-template" hidden>
                    <img class="modal-image" src="{{ asset('images/photobooth_2.jpeg') }}" alt="Fun photobooth moment">
                    <h2>Maak blijvende herinneringen met onze photobooth</h2>
                    <p>Stap in je eigen ontworpen photobooth kies je eigen slogan, of logo voor op jou gepersonaliseerde magazine. Of het nu voor een themafeest, bruiloft of ander event. Met één klik op de camera creëer je herinneringen die je voor altijd kunt koesteren!</p>

                    <h3>Photobooth - €550,- per dag</h3>
                    <p>Inclusief:</p>
                    <ul>
                        <li>Gepersonaliseerde bestickering (denk hierbij aan bedrijfsnamen, logo, slogan of favoriete songtekst)</li>
                        <li>Schoonmaakkosten</li>
                        <li>Gepersonaliseerde digitale Photogallery</li>
                    </ul>

                    <h3>Locatie eisen</h3>
                    <ul>
                        <li>De ondergrond van de Photobooth dient vlak te zijn i.v.m. de stabiliteit van de booth</li>
                        <li>I.v.m. reflectie van het glas dient er zo weinig mogelijk tegenlicht te zijn op de plek waar hij komt te staan</li>
                    </ul>
                </div>
                <img src="{{ asset('images/photobooth_2.jpeg') }}" alt="Fun photobooth moment">
                <span>Photobooth</span>
            </div>
            <div class="circle-item" data-title="Een lekkere foodtruck">
                <div class="modal-content-template" hidden>
                    <img class="modal-image" src="{{ asset('images/foodtruck-compressed.jpeg') }}" alt="Foodtruck setup next to tent">
                    <h2>Huur een unieke oldtimer truck bij ons</h2>
                    <p>Of je nu de lekkerste gerechten wilt bereiden, de truck wilt omtoveren tot DJ booth of hem als eyecatcher op je feest wilt zetten – alles is mogelijk! De truck wordt geleverd zonder personeel, zodat je zelf de touwtjes in handen hebt. Wil je je feestje helemaal personaliseren? Geen probleem! Laat de truck aanpassen met jouw logo of teksten en maak van jouw evenement iets onvergetelijks.</p>

                    <h3>De truck is €275,- per dag</h3>
                    <p>De truck beschikt over:</p>
                    <ul>
                        <li>Een ruim werkblad</li>
                        <li>2 koelingen</li>
                        <li>Grote ton (kan gebruikt worden als prullenbak)</li>
                        <li>Uitzetbord incl. krijtstiften (1 zijde krijtbord + 1 zijde white board)</li>
                        <li>Lampjes</li>
                    </ul>

                    <p>Wilt u het liefst alles uit handen geven laat het ons weten.<br>
             </p>
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
            overflow: hidden;
        }

        dialog.modal::backdrop {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            max-width: 100%;
        }

        .modal-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            margin-bottom: 0;
        }

        .modal-content-wrapper {
            padding: 2rem;
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