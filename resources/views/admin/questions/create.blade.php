<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Dodaj Pytanie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card">
        <div class="card-header">Nowe pytanie do: {{ $quiz->title }}</div>
        <div class="card-body">
            
            <form action="{{ route('admin.questions.store', $quiz) }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-8">
                        <label>Treść pytania</label>
                        <input type="text" name="content" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label>Punkty</label>
                        <input type="number" name="points" class="form-control" value="1" required>
                    </div>
                    <div class="col-md-2">
                        <label>Typ</label>
                        <select name="type" class="form-select">
                            <option value="single_choice">Jednokrotny</option>
                            <option value="multiple_choice">Wielokrotny</option>
                            <option value="text">Tekstowy</option>
                        </select>
                    </div>
                </div>

                <hr>
                <h5>Odpowiedzi (wypełnij tyle ile potrzebujesz)</h5>
                <p class="text-muted small">Dla pytań tekstowych wypełnij tylko pierwszą odpowiedź jako wzorzec.</p>

                @for($i = 0; $i < 4; $i++)
                    <div class="input-group mb-2">
                        <span class="input-group-text">Odp {{ $i+1 }}</span>
                        <input type="text" name="answers[{{ $i }}][content]" class="form-control">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" type="checkbox" name="answers[{{ $i }}][is_correct]" value="1">
                            <span class="ms-1 small">Poprawna</span>
                        </div>
                    </div>
                @endfor
                
                <button type="submit" class="btn btn-success mt-3">Zapisz pytanie</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>