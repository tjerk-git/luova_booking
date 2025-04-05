<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a single product record with initial content
        Product::create([
            'silent_disco_content' => '<p>Elke DJ (of act) brengt zijn eigen vibe, en jij bepaalt zelf waar je zin in hebt, gewoon met een druk op de knop van je koptelefoon! De gekleurde lampjes rood en groen laten je meteen zien wie hetzelfde kanaal luistert. Knettersvals meezingen met de grootste hits, terwijl je buurman lekker danst op een totaal ander nummer. Iedereen in zijn eigen wereld, maar toch samen op de dansvloer.</p>
            <h3>Inhoud:</h3>
            <ul>
                <li>32 koptelefoons (volledig opgeladen)</li>
                <li>2 zenders</li>
                <li>Opslag boxen</li>
                <li>Aux kabels</li>
                <li>Stekkerdoos 6-voudig</li>
                <li>Transportkar</li>
            </ul>
            <p>Wilt u meer koptelefoons laat het ons weten.</p>',
            
            'photobooth_content' => '<h2>Maak blijvende herinneringen met onze photobooth</h2>
            <p>Onze photobooth is perfect voor elk evenement! Gasten kunnen onbeperkt foto\'s maken en direct afdrukken als herinnering aan jullie speciale dag.</p>
            <h3>Inclusief:</h3>
            <ul>
                <li>Professionele camera en printer</li>
                <li>Onbeperkt afdrukken</li>
                <li>Leuke props en accessoires</li>
                <li>Digitale kopieën van alle foto\'s</li>
                <li>Persoonlijke layout met jullie namen en datum</li>
            </ul>',
            
            'foodtruck_content' => '<h2>Heerlijke catering met onze foodtruck</h2>
            <p>Onze foodtruck is de perfecte aanvulling voor elk evenement! We bieden een verscheidenheid aan heerlijke gerechten die uw gasten zeker zullen waarderen.</p>
            <h3>Menu-opties:</h3>
            <ul>
                <li>Verse hamburgers en hotdogs</li>
                <li>Vegetarische en veganistische opties</li>
                <li>Frietjes en snacks</li>
                <li>Diverse drankjes</li>
                <li>Desserts</li>
            </ul>
            <p>Neem contact met ons op voor een aangepast menu voor uw evenement!</p>'
        ]);
    }
}
