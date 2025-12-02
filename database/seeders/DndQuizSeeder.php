<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use Illuminate\Support\Str;

class DndQuizSeeder extends Seeder
{
    public function run(): void
    {
        // QUIZ 1
        $title1 = 'D&D 5e: Podstawy Mechaniki';
        $quiz1 = Quiz::create([
            'title'       => $title1,
            'slug'        => Str::slug($title1),
            'description' => 'Sprawdź, czy znasz fundamenty systemu Dungeons & Dragons. Pytania o cechy i kości.',
        ]);

        $q1_1 = $quiz1->questions()->create([
            'content' => 'Jaka kość jest używana do wykonywania testów umiejętności i ataków?',
            'type'    => 'single_choice',
            'points'  => 1,
        ]);
        $q1_1->answers()->createMany([
            ['content' => 'k20 (d20)', 'is_correct' => true],
            ['content' => 'k12 (d12)', 'is_correct' => false],
            ['content' => 'k6 (d6)',   'is_correct' => false],
            ['content' => 'k100',      'is_correct' => false],
        ]);

        $q1_2 = $quiz1->questions()->create([
            'content' => 'Zaznacz wszystkie główne cechy postacie w D&D 5e:',
            'type'    => 'multiple_choice',
            'points'  => 3,
        ]);
        $q1_2->answers()->createMany([
            ['content' => 'Siła (Strength)', 'is_correct' => true],
            ['content' => 'Szczęście (Luck)', 'is_correct' => false],
            ['content' => 'Medycyna (Medicine)', 'is_correct' => false],
            ['content' => 'Zręczność (Dexterity)', 'is_correct' => true],
            ['content' => 'Atletyka (Athletics)', 'is_correct' => false],
            ['content' => 'Charyzma (Charisma)', 'is_correct' => true],
            ['content' => 'Kondycja (Constitution)', 'is_correct' => true],
            ['content' => 'Honor (Honor)', 'is_correct' => false],
            ['content' => 'Inteligencja (Intelligence)', 'is_correct' => true],
            ['content' => 'Koordynacja (Coordination)', 'is_correct' => false],
            ['content' => 'Akrobatyka (Acrobatics)', 'is_correct' => false],
            ['content' => 'Mądrość (Wisdom)', 'is_correct' => true],
        ]);

        $q1_3 = $quiz1->questions()->create([
            'content' => 'Jakim skrótem określa się Klasę Pancerza? (Wpisz 2 litery)',
            'type'    => 'text',
            'points'  => 2,
        ]);
        $q1_3->answers()->create([
            'content' => 'AC',
            'is_correct' => true,
        ]);


        // QUIZ 2
        $title2 = 'D&D 5e: Zasady Walki';
        $quiz2 = Quiz::create([
            'title'       => $title2,
            'slug'        => Str::slug($title2),
            'description' => 'Test wiedzy o turach, akcjach i rzutach obronnych.',
        ]);

        $q2_1 = $quiz2->questions()->create([
            'content' => 'Ile sekund w świecie gry trwa jedna runda walki?',
            'type'    => 'text',
            'points'  => 2,
        ]);
        $q2_1->answers()->create([
            'content' => '6',
            'is_correct' => true,
        ]);

        $q2_2 = $quiz2->questions()->create([
            'content' => 'Co oznacza mechanika "Ułatwienia" (Advantage)?',
            'type'    => 'single_choice',
            'points'  => 1,
        ]);
        $q2_2->answers()->createMany([
            ['content' => 'Rzucasz dwoma kośćmi k20 i wybierasz wyższy wynik', 'is_correct' => true],
            ['content' => 'Rzucasz 2k20 i wybierasz niższy wynik', 'is_correct' => false],
            ['content' => 'Dodajesz +5 do wyniku rzutu',           'is_correct' => false],
            ['content' => 'Możesz powtórzyć rzut, jeśli wypadnie 1', 'is_correct' => false],
        ]);

        $q2_3 = $quiz2->questions()->create([
            'content' => 'Które z poniższych stanów powodują, że ataki przeciwko Tobie mają Ułatwienie?',
            'type'    => 'multiple_choice',
            'points'  => 4,
        ]);
        $q2_3->answers()->createMany([
            ['content' => 'Oślepiony (Blinded)',   'is_correct' => true],
            ['content' => 'Sparaliżowany (Paralyzed)', 'is_correct' => true],
            ['content' => 'Zatruty (Poisoned)',    'is_correct' => false],
            ['content' => 'Nieprzytomny (Unconscious)', 'is_correct' => true],
        ]);


        // QUIZ 3
        $title3 = 'D&D 5e: Potwory i Magia';
        $quiz3 = Quiz::create([
            'title'       => $title3,
            'slug'        => Str::slug($title3),
            'description' => 'Sprawdź swoją wiedzę o świecie i bestiariuszu.',
        ]);

        $q3_1 = $quiz3->questions()->create([
            'content' => 'Jak nazywa się potwór, który potrafi przybrać kształt skrzyni ze skarbami, aby zwabić ofiarę?',
            'type'    => 'text',
            'points'  => 3,
        ]);
        $q3_1->answers()->create([
            'content' => 'Mimik',
            'is_correct' => true,
        ]);

        $q3_2 = $quiz3->questions()->create([
            'content' => 'Jaki kolor mają smoki, które są z natury złe i chciwe (zgodnie z podstawowym lore)?',
            'type'    => 'single_choice',
            'points'  => 1,
        ]);
        $q3_2->answers()->createMany([
            ['content' => 'Chromatyczne (Czerwone, Zielone, etc.)', 'is_correct' => true],
            ['content' => 'Metaliczne (Złote, Srebrne, etc.)',      'is_correct' => false],
            ['content' => 'Kryształowe',                            'is_correct' => false],
        ]);

        $q3_3 = $quiz3->questions()->create([
            'content' => 'Zaznacz komponenty, które mogą być wymagane do rzucenia zaklęcia:',
            'type'    => 'multiple_choice',
            'points'  => 2,
        ]);
        $q3_3->answers()->createMany([
            ['content' => 'Werbalny (V)',    'is_correct' => true],
            ['content' => 'Somatyczny (S)',  'is_correct' => true],
            ['content' => 'Mentalny (M)',    'is_correct' => false], 
            ['content' => 'Materiałowy (M)', 'is_correct' => true],
        ]);
    }
}