<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use Illuminate\Support\Str;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake('pl_PL');

        foreach (range(1, 5) as $i) {
            
            $title = 'Quiz wiedzy ogólnej #' . $i;
            
            $quiz = Quiz::create([
                'title'=>$title,
                'slug'=>Str::slug($title),
                'description'=>$faker->realText(200),
            ]);

            foreach (range(1, 10) as $j) {
                
                $type = $faker->randomElement(['single_choice', 'multiple_choice', 'text']);

                $questionContent = $faker->realText(50);
                $questionContent = rtrim($questionContent, '.') . '?';

                $question = $quiz->questions()->create([
                    'content' => $questionContent,
                    'type'    => $type,
                    'points'  => rand(1, 5),
                ]);

                if ($type === 'text') {
                    $question->answers()->create([
                        'content'    => $faker->word,
                        'is_correct' => true
                    ]);
                }
                elseif ($type === 'multiple_choice') {
                    $question->answers()->createMany([
                        ['content' => $faker->word . ' (Poprawna)', 'is_correct' => true],
                        ['content' => $faker->word . ' (Poprawna)', 'is_correct' => true],
                        ['content' => $faker->word, 'is_correct' => false],
                        ['content' => $faker->word, 'is_correct' => false],
                    ]);
                }
                else {
                    $answers = [
                        ['content' => $faker->word . ' (Poprawna)', 'is_correct' => true],
                        ['content' => $faker->word, 'is_correct' => false],
                        ['content' => $faker->word, 'is_correct' => false],
                        ['content' => $faker->word, 'is_correct' => false],
                    ];
                    shuffle($answers);
                    $question->answers()->createMany($answers);
                }
            }
        }
    }
}