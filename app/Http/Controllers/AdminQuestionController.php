<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        return view('admin.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'content' => 'required',
            'type'    => 'required|in:single_choice,multiple_choice,text',
            'points'  => 'required|integer|min:1',
            'answers' => 'array',
        ]);

        $question = $quiz->questions()->create([
            'content' => $validated['content'],
            'type'    => $validated['type'],
            'points'  => $validated['points'],
        ]);

        if ($request->has('answers')) {
        foreach ($request->input('answers') as $ans) {

            if (empty($ans['content'])) {
                continue;
            }

            $question->answers()->create([
                'content' => $ans['content'],
                'is_correct' => isset($ans['is_correct']),
            ]);
        }
    }
        
        return redirect()->route('admin.quizzes.edit', $quiz)->with('success', 'Pytanie dodane!');
    }

    public function edit(Question $question)
    {
        $quiz = $question->quiz;
        return view('admin.questions.edit', compact('question', 'quiz'));
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'content' => 'required',
            'points'  => 'required|integer',
            'type'    => 'required',
            'answers' => 'nullable|array',
            'answers.*.content' => 'required',
            'new_answers' => 'nullable|array',
        ]);

        $question->update([
            'content' => $validated['content'],
            'points'  => $validated['points'],
            'type'    => $validated['type'],
        ]);

        if ($request->has('answers')) {
            foreach ($request->input('answers') as $answerId => $data) {
                $answer = \App\Models\Answer::find($answerId);
                
                if ($answer) {
                    if (isset($data['delete']) && $data['delete'] == '1') {
                        $answer->delete();
                    } else {
                        $answer->update([
                            'content' => $data['content'],
                            'is_correct' => isset($data['is_correct']),
                        ]);
                    }
                }
            }
        }

        if ($request->has('new_answers')) {
            foreach ($request->input('new_answers') as $newData) {
                if (!empty($newData['content'])) {
                    $question->answers()->create([
                        'content' => $newData['content'],
                        'is_correct' => isset($newData['is_correct']),
                    ]);
                }
            }
        }

        return redirect()->route('admin.quizzes.edit', $question->quiz_id)
                        ->with('success', 'Pytanie i odpowiedzi zaktualizowane.');
    }

    public function destroy(Question $question)
    {
        $quizId = $question->quiz_id;
        $question->delete();
        return redirect()->route('admin.quizzes.edit', $quizId)
                         ->with('success', 'Pytanie usunięte.');
    }
}