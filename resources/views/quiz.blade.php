<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rozwiąż Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    @if($quiz)
        <div class="mt-5 mb-5 text-center">
            <h1 class="mb-4">{{ $quiz->title }}</h1>
            <p class="lead text-muted">{{ $quiz->description }}</p>
        </div>
        <form method="POST" action="{{ route('quiz.store') }}">
            
            @csrf

            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

            @foreach($quiz->questions as $question)
                <div class="card mb-3">
                    <div class="card-header">
                        <strong>{{ $question->content }}</strong> 
                        <span class="badge bg-secondary float-end">Pkt: {{ $question->points }}</span>
                    </div>
                    <div class="card-body">
                        @switch($question->type)
                            @case('text')
                                <div class="mb-3">
                                    <input type="text" 
                                        class="form-control" 
                                        name="answers[{{ $question->id }}]" 
                                        placeholder="Wpisz odpowiedź...">
                                </div>
                                @break

                            @case('multiple_choice')
                                <p class="text-muted small">Zaznacz wszystkie poprawne odpowiedzi:</p>
                                <ul class="list-group list-group-flush" style="list-style: none; padding-left: 0;">
                                    @foreach($question->answers as $answer)
                                        <li class="list-group-item border-0">
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                    type="checkbox" 
                                                    name="answers[{{ $question->id }}][]" 
                                                    value="{{ $answer->id }}"
                                                    id="ans_{{ $answer->id }}">
                                                <label class="form-check-label" for="ans_{{ $answer->id }}">
                                                    {{ $answer->content }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                @break

                            @default
                                <ul class="list-group list-group-flush" style="list-style: none; padding-left: 0;">
                                    @foreach($question->answers as $answer)
                                        <li class="list-group-item border-0">
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                    type="radio" 
                                                    name="answers[{{ $question->id }}]" 
                                                    value="{{ $answer->id }}"
                                                    id="ans_{{ $answer->id }}">
                                                <label class="form-check-label" for="ans_{{ $answer->id }}">
                                                    {{ $answer->content }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                        @endswitch
                    </div>
                </div>
            @endforeach

            <div class="d-grid gap-2 col-6 mx-auto mb-5">
                <button type="submit" class="btn btn-primary btn-lg">Zakończ i sprawdź wynik</button>
            </div>
        </form>

    @else
        <div class="alert alert-warning">
            Brak quizów w bazie danych.
        </div>
    @endif
</div>
</body>
</html>