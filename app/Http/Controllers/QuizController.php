<?php


namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    //
    public function index()
    {
        $quizzes = Quiz::all();
        return view('mainpage', compact('quizzes'));
    }

    public function show($slug){
        $quiz = Quiz::with('questions.answers')
            ->where('slug', $slug)
            ->firstOrFail();
        return view('quiz', compact('quiz'));
    }

    public function store(Request $request)
    {
        $quizId = $request->input('quiz_id');
        
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        
        $maxPoints = $quiz->questions->sum('points');

        $data = $request->input('answers'); 
        $userPoints = 0;

        if ($data) {
            foreach ($data as $questionId => $answerId) {
                $answer = Answer::find($answerId);
                if ($answer && $answer->is_correct) {
                    $userPoints += $answer->question->points;
                }
            }
        }

        return view('result', [
            'score' => $userPoints,
            'total' => $maxPoints,
            'quiz' => $quiz
        ]);
    }
}

