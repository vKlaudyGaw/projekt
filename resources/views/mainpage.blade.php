<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wybierz Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="container mt-5">
    <div class="text-center mb-5">
        <h1>Dostępne Quizy</h1>
        <p class="lead">Wybierz temat i sprawdź swoją wiedzę!</p>
    </div>

    <div class="row">
        @forelse($quizzes as $quiz)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $quiz->title }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($quiz->description, 80) }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('quiz.show', $quiz->slug) }}" class="btn btn-primary w-100">
                            Rozpocznij Quiz
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Aktualnie nie ma żadnych quizów. Zajrzyj później!
                </div>
            </div>
        @endforelse
    </div>
</div>

</body>
</html>