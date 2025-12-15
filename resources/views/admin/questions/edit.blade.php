<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Edytuj Pytanie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edycja pytania</h4>
            <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="btn btn-outline-secondary btn-sm">Wróć do quizu</a>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.questions.update', $question) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4 bg-light p-3 rounded mx-0 border">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Treść pytania</label>
                        <input type="text" name="content" class="form-control" value="{{ $question->content }}" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Punkty</label>
                        <input type="number" name="points" class="form-control" value="{{ $question->points }}" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Typ</label>
                        <select name="type" class="form-select">
                            <option value="single_choice" {{ $question->type == 'single_choice' ? 'selected' : '' }}>Jednokrotny</option>
                            <option value="multiple_choice" {{ $question->type == 'multiple_choice' ? 'selected' : '' }}>Wielokrotny</option>
                            <option value="text" {{ $question->type == 'text' ? 'selected' : '' }}>Tekstowy</option>
                        </select>
                    </div>
                </div>

                <hr>
                
                <h5 class="text-primary mb-3">Istniejące odpowiedzi</h5>
                <div class="vstack gap-2 mb-4">
                    @foreach($question->answers as $answer)
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-hdd text-secondary" title="Zapisana w bazie"></i>
                            </span>
                            
                            <input type="text" 
                                   name="answers[{{ $answer->id }}][content]" 
                                   class="form-control" 
                                   value="{{ $answer->content }}">
                            
                            <div class="input-group-text bg-white">
                                <input class="form-check-input mt-0" 
                                       type="checkbox" 
                                       name="answers[{{ $answer->id }}][is_correct]" 
                                       value="1"
                                       {{ $answer->is_correct ? 'checked' : '' }}>
                                <span class="ms-2 small">Poprawna</span>
                            </div>

                            <div class="input-group-text bg-danger bg-opacity-10 border-danger">
                                <input class="form-check-input mt-0" 
                                       type="checkbox" 
                                       name="answers[{{ $answer->id }}][delete]" 
                                       value="1">
                                <span class="ms-2 small text-danger fw-bold">Usuń</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <h5 class="text-success mb-3">Dodaj nowe odpowiedzi</h5>
                <div id="new-answers-container">
                    </div>

                <button type="button" class="btn btn-outline-success btn-sm mb-4" id="add-answer-btn">
                    <i class="bi bi-plus-circle"></i> Dodaj kolejne pole odpowiedzi
                </button>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Zapisz wszystkie zmiany</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('new-answers-container');
        const btn = document.getElementById('add-answer-btn');
        let counter = 0;

        function addField() {
            const html = `
                <div class="input-group mb-2">
                    <span class="input-group-text bg-success text-white">Nowa</span>
                    <input type="text" name="new_answers[${counter}][content]" class="form-control" placeholder="Wpisz treść nowej odpowiedzi...">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" name="new_answers[${counter}][is_correct]" value="1">
                        <span class="ms-2 small">Poprawna</span>
                    </div>
                    <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            counter++;
        }

        addField();

        btn.addEventListener('click', addField);
    });
</script>

</body>
</html>