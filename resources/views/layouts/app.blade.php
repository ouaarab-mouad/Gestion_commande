<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card {
            box-shadow: 0 2px 4px rgba(0,0,0,.05);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .jumbotron {
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
            color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-store me-2"></i>{{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('clients.index') }}">
                                <i class="fas fa-users me-1"></i>Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('produits.index') }}">
                                <i class="fas fa-box me-1"></i>Produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('commandes.index') }}">
                                <i class="fas fa-shopping-cart me-1"></i>Commandes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">
                                <i class="fas fa-tags me-1"></i>Catégories
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-search me-1"></i>Recherche
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('recherche.commandes-par-client.form') }}">
                                    <i class="fas fa-user-tag me-2"></i>Commandes par client
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('recherche.montant-par-periode.form') }}">
                                    <i class="fas fa-calendar-alt me-2"></i>Montant par période
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('recherche.statistiques-par-produit') }}">
                                    <i class="fas fa-chart-bar me-2"></i>Statistiques par produit
                                </a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @auth
                        <li class="nav-item">
                            <span class="nav-link">{{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link" style="display:inline;cursor:pointer;">Déconnecter</button>
                            </form>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white py-4 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{ config('app.name', 'Laravel') }}</h5>
                        <p>Système de gestion de commandes</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p>&copy; {{ date('Y') }} Tous droits réservés</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 