@vite(['resources/css/app.css', 'resources/js/app.js'])
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
            Quizy
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-primary fw-bold" href="{{ route('login') }}">Zaloguj się</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary fw-bold" href="{{ route('register') }}">Zarejestruj się</a>
                    </li>
                @else
                    
                    @if(Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link text-primary fw-bold" href="{{ route('admin.quizzes.index') }}">
                                <i class="bi bi-gear-fill"></i> Panel Administratora
                            </a>
                        </li>
                    @endif

                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">Pulpit (Dashboard)</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        Wyloguj się
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>