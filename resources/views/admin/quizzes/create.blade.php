<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj nowy quiz - Panel Admina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Dodaj nowy Quiz</h4>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('admin.quizzes.store') }}" method="POST">
                        @csrf {{-- Token bezpieczeństwa jest wymagany! --}}

                        <div class="mb-3">
                            <label for="title" class="form-label">Tytuł Quizu</label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="np. Quiz Historyczny #1"
                                   required>
                            
                            {{-- Wyświetlanie błędu walidacji --}}
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Opis</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Krótki opis, o czym jest ten quiz..."
                                      required>{{ old('description') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary">Anuluj</a>
                            <button type="submit" class="btn btn-success">Zapisz Quiz</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>