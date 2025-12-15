<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Admina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-3 fw-bold text-primary">Zarządzanie Quizami</h1>
        <a href="{{ route('admin.quizzes.create') }}" class="btn btn-success">Dodaj nowy Quiz</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tytuł</th>
                        <th>Opis</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quizzes as $quiz)
                        <tr>
                            <td>{{ $quiz->title }}</td>
                            <td>{{ Str::limit($quiz->description, 50) }}</td>
                            <td>
                                <div class="d-flex gap-2 justify-content-end">
                                    
                                    <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="btn btn-sm btn-primary">
                                        Edytuj
                                    </a>
                                    
                                    <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" onsubmit="return confirm('Czy na pewno usunąć?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Usuń</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('home') }}" class="btn btn-secondary btn-lg">Wróć do strony głównej</a>
    </div>
</div>

</body>
</html>