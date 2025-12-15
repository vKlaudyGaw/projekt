<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('mainpage', compact('quizzes'));
    }

    public function show($slug)
    {
        $quiz = Quiz::with('questions.answers')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('quiz', compact('quiz'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'quiz_id' => 'required|integer|exists:quizzes,id',
            'answers' => 'array', 
        ], [
            'quiz_id.required' => 'Błąd: Nie zidentyfikowano quizu.',
            'quiz_id.exists'   => 'Taki quiz nie istnieje.',
            'answers.array'    => 'Błędny format odpowiedzi.'
        ]);

        $quizId = $validated['quiz_id']; 

        $quiz = Quiz::with('questions.answers')->findOrFail($quizId);

        $maxPoints = $quiz->questions->sum('points');

        $userAnswers = $request->input('answers', []);

        $score = 0;

        foreach ($quiz->questions as $question) {
            
            if (!isset($userAnswers[$question->id])) {
                continue;
            }

            $userValue = $userAnswers[$question->id];

            switch ($question->type) {
                
                case 'single_choice':
                    $correctAnswer = $question->answers->where('is_correct', true)->first();
                    
                    if ($correctAnswer && $correctAnswer->id == $userValue) {
                        $score += $question->points;
                    }
                    break;

                case 'multiple_choice':
                    if (!is_array($userValue)) break;

                    $correctIds = $question->answers->where('is_correct', true)->pluck('id')->toArray();
                    $totalCorrectCount = count($correctIds);

                    if ($totalCorrectCount === 0) break;

                    $pointsPerHit = $question->points / $totalCorrectCount;
                    $userHits = count(array_intersect($userValue, $correctIds));
                    $score += $userHits * $pointsPerHit;
                    
                    break;

                case 'text':
                    
                    $userText = strtolower(trim($userValue));

                    foreach ($question->answers as $ans) {
                        
                        if (strtolower(trim($ans->content)) === $userText) {
                            $score += $question->points; 
                            break; 
                        }
                        
                    }
                    break;
            }
        }

        return view('result', [
            'score' => $score,
            'total' => $maxPoints,
            'quiz'  => $quiz
        ]);
    }
}