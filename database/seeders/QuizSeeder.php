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
                
                $questionContent = $faker->realText(50);
                $questionContent = rtrim($questionContent, '.') . '?';

                $question = $quiz->questions()->create([
                    'content' => $questionContent,
                    'points'  => rand(1, 5),
                ]);

                $answersPool = [];

                $answersPool[] = [
                    'content'    => $faker->realText(20) . ' (Poprawna)', 
                    'is_correct' => true
                ];

                for ($k = 0; $k < 3; $k++) {
                    $answersPool[] = [
                        'content'    => $faker->realText(15), 
                        'is_correct' => false
                    ];
                }

                shuffle($answersPool);

                $question->answers()->createMany($answersPool);
            }
        }
    }
}