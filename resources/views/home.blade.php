@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="jumbotron text-center">
                <h1 class="display-4">Bienvenue dans notre système de gestion</h1>
                <p class="lead">Gérez vos clients, produits, commandes et consultez les statistiques en un seul endroit.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Gestion des clients -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Gestion des clients</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Gérez vos clients, consultez leurs informations et leurs commandes.</p>
                    <a href="{{ route('clients.index') }}" class="btn btn-primary">Voir les clients</a>
                </div>
            </div>
        </div>

        <!-- Gestion des produits -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Gestion des produits</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Gérez votre catalogue de produits et leurs catégories.</p>
                    <a href="{{ route('produits.index') }}" class="btn btn-success">Voir les produits</a>
                </div>
            </div>
        </div>

        <!-- Gestion des commandes -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Gestion des commandes</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Suivez et gérez toutes vos commandes en un seul endroit.</p>
                    <a href="{{ route('commandes.index') }}" class="btn btn-info">Voir les commandes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Recherche de commandes -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-warning">
                    <h5 class="card-title mb-0">Recherche de commandes</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Recherchez les commandes par client ou par période.</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('recherche.commandes-par-client.form') }}" class="btn btn-warning">Par client</a>
                        <a href="{{ route('recherche.montant-par-periode.form') }}" class="btn btn-warning">Par période</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">Statistiques</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Consultez les statistiques de vente par produit.</p>
                    <a href="{{ route('recherche.statistiques-par-produit') }}" class="btn btn-secondary">Voir les statistiques</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">Aperçu rapide</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <h3>{{ App\Models\Client::count() }}</h3>
                            <p>Clients</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <h3>{{ App\Models\Produit::count() }}</h3>
                            <p>Produits</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <h3>{{ App\Models\Commande::count() }}</h3>
                            <p>Commandes</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <h3>{{ App\Models\Categorie::count() }}</h3>
                            <p>Catégories</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection