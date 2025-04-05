<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Wat kost het?',
                'answer' => '<ul>
                   <li>De basisprijs voor de tent is €1150,-</li>
                   <li>Bij langer huren krijg je korting</li>
                   <li>Reiskosten zijn 25 euro per uur</li>
                </ul>',
                'order_column' => 1,
                'is_published' => true,
            ],
            [
                'question' => 'Is mijn locatie geschikt?',
                'answer' => '<ul>
                    <li>Zorg voor voldoende doorgang voor een auto met aanhanger.</li>
                    <li>We gebruiken lange grondpennen (100 cm). Let op: controleer vooraf de locatie van ondergrondse leidingen.</li>
                    <li>Voor het opbouwen van de tent is een oppervlakte nodig van 12 x 17, i.v.m de haringen</li>
                </ul>',
                'order_column' => 2,
                'is_published' => true,
            ],
            [
                'question' => 'Wie bouwt de tent op?',
                'answer' => '<p>Zorg voor 3 sterke personen om te helpen bij het opzetten van de tent.</p>
                <p>Hetzelfde geldt voor het afbouwen</p>',
                'order_column' => 3,
                'is_published' => true,
            ],
            [
                'question' => 'Wat doen we met slecht weer?',
                'answer' => '<p>Bij extreem slecht weer of windkracht boven 6 kunnen wij de tent niet plaatsen. Zorg voor een alternatief plan.</p>
                <p>Kijk ook even naar onze annuleringsregeling!</p>',
                'order_column' => 4,
                'is_published' => true,
            ],
            [
                'question' => 'Droogtijd',
                'answer' => '<p>De tent moet droog worden opgevouwen. Bespreek de mogelijkheid om de tent op locatie te laten staan tot deze droog is.</p>',
                'order_column' => 5,
                'is_published' => true,
            ],
            [
                'question' => 'Annuleringsregeling',
                'answer' => '<p>Tot een week van te voren annuleren is gratis!</p>
                <p>Tot 24 uur van te voren betaal je 20% van de totaalprijs.</p>
                <p>Binnen 24 uur na annuleren betaal je 50%.</p>',
                'order_column' => 6,
                'is_published' => true,
            ],
            [
                'question' => 'Wat zijn de regels?',
                'answer' => '<ul>
                    <li>Niet koken of roken onder de tent</li>
                    <li>Geen papieren versieringen of confetti</li>
                    <li>Gebruik geen tape i.v.m vlekken</li>
                    <li>Tent mag niet verplaatst worden</li>
                </ul>',
                'order_column' => 7,
                'is_published' => true,
            ],
            [
                'question' => 'Wat is er verantwoordelijk voor?',
                'answer' => '<ul>
                    <li>Tijdens het huren ben je verantwoordelijk voor de tent en de eventuele inrichting</li>
                    <li>Tijdens het opbouwen controleren we samene de veiligheid van de tent</li>
                </ul>',
                'order_column' => 8,
                'is_published' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
