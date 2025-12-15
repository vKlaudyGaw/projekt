<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edycja Quizu: {{ $quiz->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-3 fw-bold text-primary">Edycja Quizu</h1>
        <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Wróć do listy
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm mb-5">
        <div class="card-header bg-white">
            <h4 class="mb-0 text-primary">1. Dane podstawowe</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="title" class="form-label fw-bold">Tytuł Quizu</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $quiz->title) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">&nbsp;</label>
                        <button type="submit" class="btn btn-primary d-block w-100">
                            <i class="bi bi-save"> </i>Zmień tytuł i opis
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Opis</label>
                    <textarea class="form-control" id="description" name="description" rows="2" required>{{ old('description', $quiz->description) }}</textarea>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-primary">2. Pytania i Odpowiedzi</h3>
        <a href="{{ route('admin.questions.create', $quiz) }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Dodaj nowe pytanie
        </a>
    </div>

    @if($quiz->questions->isEmpty())
        <div class="alert alert-warning text-center">
            Ten quiz nie ma jeszcze pytań. Dodaj pierwsze pytanie powyższym przyciskiem!
        </div>
    @else
        <div class="vstack gap-3">
            @foreach($quiz->questions as $index => $question)
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-secondary me-2">Pytanie {{ $index + 1 }}</span>
                            <strong class="fs-5">{{ $question->content }}</strong><br>
                            <span class="text-muted ms-2 small">({{ $question->type }} | {{ $question->points }} pkt)</span>
                        </div>
                        
                        <div class="btn-group">
                            <a href="{{ route('admin.questions.edit', $question) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            
                            <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" class="d-inline" onsubmit="return confirm('Czy na pewno usunąć to pytanie i wszystkie jego odpowiedzi?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body bg-light bg-opacity-25 pt-2 pb-2">
                        <ul class="list-group list-group-flush bg-transparent">
                            @foreach($question->answers as $answer)
                                <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center py-1 ps-0" style="border: none;">
                                    <div class="d-flex align-items-center">
                                        @if($answer->is_correct)
                                            <i class="bi bi-check-circle-fill text-success me-2" title="Poprawna odpowiedź"></i>
                                        @else
                                            <i class="bi bi-circle text-muted me-2"></i>
                                        @endif
                                        
                                        <span class="{{ $answer->is_correct ? 'text-success fw-medium' : 'text-muted' }}">
                                            {{ $answer->content }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                            
                            <li class="list-group-item bg-transparent ps-0 border-0 pt-2">
                                <a href="{{ route('admin.questions.edit', $question) }}" class="btn btn-sm btn-link text-decoration-none px-0 text-muted">
                                    <i class="bi bi-plus-circle"></i> Zarządzaj odpowiedziami
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

</body>
</html>