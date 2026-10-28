<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $gamesByCategory = [
            'Pokémon-spellen' => [
                [
                    'name' => 'Pokémon Rood',
                    'description' => 'De klassieker waarmee het allemaal begon. Reis door Kanto, verzamel alle acht gymmedailles en versla de Elite Four met je team van maximaal zes Pokémon.',
                ],
                [
                    'name' => 'Pokémon Blauw',
                    'description' => 'De tegenhanger van Rood met unieke exclusieve Pokémon. Kies je starter: Bulbasaur, Charmander of Squirtle en wordt de sterkste trainer van Kanto.',
                ],
                [
                    'name' => 'Pokémon Geel',
                    'description' => 'Pikachu loopt altijd achter je aan in dit speciale avontuur. Gebaseerd op de anime, met verbeterde graphics en de icoonische rode hoed van Ash.',
                ],
                [
                    'name' => 'Pokémon Goud',
                    'description' => 'Ontdek de regio Johto, vang 250 Pokémon en stap voor het eerst de tijd in: met de dag-nachtcyclus en Kuwai-klokjes voelt de wereld levend aan.',
                ],
                [
                    'name' => 'Pokémon Zilver',
                    'description' => 'Zilver is de schitterende tegenhanger van Goud, met legendarische Pokémon die niet in Goud voorkomen en een eigen eindegevecht tegen Lance.',
                ],
                [
                    'name' => 'Pokémon Kristal',
                    'description' => 'De ultieme versie van Johto. Kristal voegt verbeteringen toe, waaronder animate sprites, de vrouwelijke hoofdpersoon en Suicune als speelbaar verhaalelement.',
                ],
                [
                    'name' => 'Pokémon Robijn',
                    'description' => 'Welkom in Hoenn! Robijn introduceert abilities, het EV-systeem en dubbelslagen in gevechten. Ga de strijd aan tegen Team Magma.',
                ],
                [
                    'name' => 'Pokémon Safran',
                    'description' => 'Het avontuur van Hoenn met eigen exclusieve Pokémon. Kies hier Team Aqua en beuk op de vulkaan van Mt. Chimney met je gymleiders-team.',
                ],
                [
                    'name' => 'Pokémon Vuurrood',
                    'description' => 'Een moderne remake van Pokémon Rood met de graphics van de Generatie III-motor, dubbele aanvallen en een uitgebreide post-game op de Sevii-eilanden.',
                ],
                [
                    'name' => 'Pokémon Bladgroen',
                    'description' => 'De remake van Blauw en het perfecte startpunt voor nieuwe trainers. Vang Mewtwo in de Cerulean-grot nadat je de Elite Four hebt verslagen.',
                ],
                [
                    'name' => 'Pokémon Parel',
                    'description' => 'Reis door Sinnoh, ontdek de oorsprong van de wereld met Dialga en Palkia en voorkom dat Team Galactic de tijdlijn herschrijft.',
                ],
                [
                    'name' => 'Pokémon Diamant',
                    'description' => 'Diamant is de held van Sinnoh: met ruim 100 nieuwe Pokémon, de introductie van abilities als Guts en een diepgaand verhaal over ruimte en tijd.',
                ],
                [
                    'name' => 'Pokémon Platina',
                    'description' => 'De definitive edition van Sinnoh met Giratina als middelpunt, de Battle Frontier en verbeterde snelheid. Door veel fans beschouwd als de beste Generatie IV-versie.',
                ],
                [
                    'name' => 'Pokémon Zon',
                    'description' => 'Alola wacht op je in Zon, waar je Z Moves vrij speelt en de eilanden doorkruist in een verhaal met Professor Kukui en de kahuna\'s.',
                ],
                [
                    'name' => 'Pokémon Maan',
                    'description' => 'Maan speelt zich af in een alternatief Alola met eigen exclusieve vormen, Ultra Beasts en de Ultra-riften als nieuwe verhaallijn.',
                ],
                [
                    'name' => 'Pokémon Zwaard',
                    'description' => 'Galar draait om de Max Raid Battles en de Maximale Vorm. Jaag de titel na in het Galar-tornooi en ontdek het geheim van Eternatus.',
                ],
                [
                    'name' => 'Pokémon Schild',
                    'description' => 'Kies Schild en verzamel Galar-coronastenen om Gigantamax-Pokémon op te roepen. Het Wild Area zit vol zeldzame vangsten en weerinvloeden.',
                ],
                [
                    'name' => 'Pokémon Legenda\'s: Arceus',
                    'description' => 'Een open-world avontuur in het oude Sinnoh (Hisui). Onderzoek, vang en documenteer Pokémon in een geheel nieuwe speelstijl zonder klassieke turn-based gevechten in het veld.',
                ],
                [
                    'name' => 'Pokémon Scharlaken',
                    'description' => 'Volledig open wereld in Paldea, drie parallelle verhaallijnen en Terastalliseren als nieuwe meganieuwe mechanic. Kies Scharlaken voor Koraidon.',
                ],
                [
                    'name' => 'Pokémon Purper',
                    'description' => 'De tegenhanger van Scharlaken met Miraidon als mascotte. Ontdek Paldea op eigen houtje, strijd tegen de schooltoppers en ontrafel het mysterie van de labyrint-grot.',
                ],
            ],
            'Avonturenspellen' => [
                [
                    'name' => 'Schaduwen van Elvaron',
                    'description' => 'Het koninkrijk Elvaron verdwijnt langzaam in de duisternis. Reis met je lantaarn door verstilde dorpen, los de raadsels van de oude wachters op en jaag de schaduwheer op.',
                ],
                [
                    'name' => 'De Grot van de Vuurlord',
                    'description' => 'Onder de vulkaan Slaghoofd ligt een grot vol smaragden en vuur. Stap langs gloeiende randen, versla de wakkere draken en steel het hart dat de berg warm houdt.',
                ],
                [
                    'name' => 'Piraten van de Verdwenen Baai',
                    'description' => 'Zeewier, zout en schatkisten: vaar met je eigen bemanning naar de baai die op geen enkele kaart staat. Ruil, vecht en graaf, maar kijk uit voor de getijden.',
                ],
                [
                    'name' => 'IJsvleugel: Het Bevroren Rijk',
                    'description' => 'Een eeuwige winter heeft de bergdorpen bedekt. Trek je mantel aan, klim langs bevroren watervallen en ontwaak de reus die onder het ijs ligt te slapen.',
                ],
                [
                    'name' => 'De Laatste Katana',
                    'description' => 'De meester van de leerstijl Isarugi is vermoord en jij bent de enige leerling. Reis door regenachtige stadjes, beheers drie zwaardstijlen en neem wraak op de verrader.',
                ],
                [
                    'name' => 'Tempel van de Zonnegod',
                    'description' => 'In de tempel verschuift het licht elk uur. Gebruik spiegels, schaduwen en mechanieken om de deuren te openen en keer terug met de schijf van Ra-Heron.',
                ],
            ],
            'Puzzelspellen' => [
                [
                    'name' => 'Kubus van Kleuren',
                    'description' => 'Draai, schuif en combineer felle vlakken tot één rustig patroon. Ruim 200 levels die beginnen met kleurvlakken en eindigen met complete mozaïeken.',
                ],
                [
                    'name' => 'Labyrint der Spiegels',
                    'description' => 'Elke spiegel kantelt het pad dat je ziet. Schuif de panelen zo dat de weerkaatsing een route vormt van de ingang naar de gouden deur.',
                ],
                [
                    'name' => 'De Vermiste Tegels',
                    'description' => 'De vloer van het oude station ligt open en er ontbreken twaalf tegels. Vind in elk level de stukken die passen bij de oude mozaïek en zet het station weer heel.',
                ],
                [
                    'name' => 'Blokkendoos Brouwerij',
                    'description' => 'De brouwerij draait op stoom en jij stapelt de kisten zo dat de leidingen vrij blijven. Los 120 compacte levels op zonder dat er iets omvalt.',
                ],
                [
                    'name' => 'Circuitbreker',
                    'description' => 'Leg draden tussen batterijen en lampjes, maar kort niets af. Elke schakelaar verandert het hele bord, dus denk twee zetten vooruit.',
                ],
                [
                    'name' => 'Woordenzee',
                    'description' => 'Zoek zoveel mogelijk woorden in een golf van letters en laat ze aan spoelen. Dagelijkse levels, een rustige soundtrack en een eigen woordenboek dat meegroeit.',
                ],
            ],
            'Racespellen' => [
                [
                    'name' => 'Nitrostraat 88',
                    'description' => 'Acht straten, één kampioenschap. Kies een tuner, plak er een spoiler op en scheur door de nachtelijke stad terwijl het verkeer opzij schiet.',
                ],
                [
                    'name' => 'Asfaltwoede',
                    'description' => 'Een race zonder regels: botsten mag, stunts leveren nitro op. Rijd tien rondes rond de ringweg en eindig als eerste in de garage terug.',
                ],
                [
                    'name' => 'Kartkampioenen van Koog',
                    'description' => 'Speel als de dorpelingen van Koog in hun zelfgemaakte karretjes. Vriendelijk van buiten, fel in de bochten met wapens uit de landbouwschuur.',
                ],
                [
                    'name' => 'Rally op de Roestvlakte',
                    'description' => 'Grind, rood stof en co-piloot-instructies. Rijd vijftien stages over de vlakte en let op de pieken: links twee over rechts een betekent remmen.',
                ],
                [
                    'name' => 'Driftende Draken',
                    'description' => 'Sla een bocht zo strak mogelijk en de drakenstaart vangt vuur. Bouw je eigen driftwagen op en klim van de straatraces naar de bergen.',
                ],
                [
                    'name' => 'Supersonische Sprint',
                    'description' => 'Racers op drie wielen en een motor die over de grens van het geluid gaat. Kies je voertuig, pas de vleugels aan en win op acht planeten.',
                ],
            ],
            'Strategiespellen' => [
                [
                    'name' => 'Rijken van Kastanje',
                    'description' => 'Vier huizen strijden om de troon van Kastanje. Bouw je dorp, leid je boeren op en sluit verdragen voordat de winter je voorraad opeet.',
                ],
                [
                    'name' => 'Belegering van Burcht Borin',
                    'description' => 'Legers, katapulten en muren van zeven meter dik. Kies je belegeringswerktuig, mik op de zwakke plek en houd je schildmannen in formatie.',
                ],
                [
                    'name' => 'Torenslag',
                    'description' => 'Twaalf torens, twee spelers, één brug. Plaats verdedigingen op de vierkanten en zorg dat je tegenstander geen doorgang vindt naar jouw kasteel.',
                ],
                [
                    'name' => 'Vloot van de Vijf Zeeën',
                    'description' => 'Bouw je vloot van kleine sloepen tot vlaggenschepen en verdeel de zeeroutes. Wie de wind beheerst, bepaalt de prijzen in de havensteden.',
                ],
                [
                    'name' => 'De Rode Mars',
                    'description' => 'Koloniseer de Rode Planeet met beperkte zuurstof. Onderzoekers, waterputten en solpanelen: elke tegel die je plaatst kan je laatste zijn.',
                ],
                [
                    'name' => 'Heerschappij der Helden',
                    'description' => 'Verzamel helden met elk een eigen talent en zet ze in tegen de krijgsheer van het noorden. Diep tactisch gevechtssysteem met combo\'s en terreinvoordelen.',
                ],
            ],
            'Sportspellen' => [
                [
                    'name' => 'Keeper van het Jaar',
                    'description' => 'Alleen jij en de penaltystip. Lees de schieter, duik op het juiste moment en werk je op van de wijkclub tot de grote finale.',
                ],
                [
                    'name' => 'Doelpunten Derby',
                    'description' => 'Vijf tegen vijf op het kunstgras achter de school. Kies je opstelling, geef de voorzet en viert de winnaar de beker in de regen.',
                ],
                [
                    'name' => 'Streetball Strijders',
                    'description' => 'Half court, muziek uit de boxen en drie speelsters per team. Leer crossover, lay-up en slam en win de toernooien in vier steden.',
                ],
                [
                    'name' => 'Schaatskampioenen',
                    'description' => 'Van de baan in het dorp tot het wereldkampioenschap op natuurijs. Timing is alles: te vroeg afzetten kost je de sprint op de laatste bocht.',
                ],
                [
                    'name' => 'Strandvolleybal Pro',
                    'description' => 'Zand, zon en een bal die je precies over het net moet leggen. Speel de zomerserie in acht badplaatsen, solo of met een vriend.',
                ],
                [
                    'name' => 'Zwemgoud',
                    'description' => 'Vier slagen, één doel: de medaille. Verbeter je slagritme, duik op het juiste moment en klop de klok op de kampioenschapsbaan.',
                ],
            ],
        ];

        foreach ($gamesByCategory as $categoryName => $games) {
            $category = Category::firstOrCreate([
                'name' => $categoryName,
            ]);

            foreach ($games as $game) {
                Product::create([
                    'name' => $game['name'],
                    'description' => $game['description'],
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
