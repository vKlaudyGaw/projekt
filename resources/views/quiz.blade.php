<div class="container">
    @if($quiz)
        <h1>{{ $quiz->title }}</h1>
        <p>{{ $quiz->description }}</p>

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
                        <ul class="list-group list-group-flush" style="list-style: none; padding-left: 0;">
                            @foreach($question->answers as $answer)
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="answers[{{ $question->id }}]" 
                                               id="answer_{{ $answer->id }}" 
                                               value="{{ $answer->id }}">
                                        
                                        <label class="form-check-label" for="answer_{{ $answer->id }}">
                                            {{ $answer->content }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
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