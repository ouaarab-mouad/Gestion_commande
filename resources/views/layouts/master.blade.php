<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Commande - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .footer {
            padding: 1rem 0;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">Gestion de Commande</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}" href="{{ route('clients.index') }}">Clients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">Catégories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('produits.*') ? 'active' : '' }}" href="{{ route('produits.index') }}">Produits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('commandes.*') ? 'active' : '' }}" href="{{ route('commandes.index') }}">Commandes</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('recherche.*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                Recherche
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('recherche.commandes-par-client') }}">Commandes par Client</a></li>
                                <li><a class="dropdown-item" href="{{ route('recherche.montant-par-periode') }}">Montant par Période & État</a></li>
                                <li><a class="dropdown-item" href="{{ route('recherche.statistiques-par-produit') }}">Statistiques par Produit</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Gestion de Commande</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @yield('scripts')
</body>
</html>

<!-- resources/views/home.blade.php -->
@extends('layouts.master')

@section('title', 'Accueil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="text-center mb-0">Bienvenue dans le système de Gestion de Commandes</h1>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Clients</h5>
                                <a href="{{ route('clients.index') }}" class="btn btn-sm btn-outline-primary">Gérer</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-tags fa-3x mb-3 text-success"></i>
                                <h5 class="card-title">Catégories</h5>
                                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-success">Gérer</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-box fa-3x mb-3 text-info"></i>
                                <h5 class="card-title">Produits</h5>
                                <a href="{{ route('produits.index') }}" class="btn btn-sm btn-outline-info">Gérer</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-shopping-cart fa-3x mb-3 text-warning"></i>
                                <h5 class="card-title">Commandes</h5>
                                <a href="{{ route('commandes.index') }}" class="btn btn-sm btn-outline-warning">Gérer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection