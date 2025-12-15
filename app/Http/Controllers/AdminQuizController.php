<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminQuizController extends Controller
{

    public function index()
    {
        $quizzes = Quiz::latest()->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }


    public function create()
    {
        return view('admin.quizzes.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $quiz = Quiz::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'slug' => Str::slug($validated['title']) . '-' . rand(100,999) 
        ]);

        return redirect()->route('admin.quizzes.edit', $quiz)->with('success', 'Quiz dodany! Możesz teraz dodać pytania.');
    }


    public function edit(Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('admin.quizzes.edit', compact('quiz'));
    }


    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $quiz->update($validated);
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz zaktualizowany!');
    }

    
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz usunięty.');
    }
}