<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wynik Quizu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card text-center">
        <div class="card-header">
            Wynik Quizu
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $quizTitle }} zakończony!</h5>
            
            <p class="card-text display-4 my-4">
                {{ $score }} / {{ $total }} pkt
            </p>

            @php
                $percentage = ($total > 0) ? ($score / $total) * 100 : 0;
            @endphp

            @if($percentage >= 80)
                <div class="alert alert-success">Świetna robota! Jesteś mistrzem!</div>
            @elseif($percentage >= 50)
                <div class="alert alert-warning">Całkiem nieźle, ale stać Cię na więcej!</div>
            @else
                <div class="alert alert-danger">Musisz jeszcze trochę poćwiczyć.</div>
            @endif

            <a href="{{ url('/quiz') }}" class="btn btn-primary">Rozwiąż ponownie</a>
            <a href="{{ url('/') }}" class="btn btn-secondary">Wróć do strony głównej</a>
        </div>
    </div>
</div>

</body>
</html>