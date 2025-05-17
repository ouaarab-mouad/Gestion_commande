@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Détails du produit</h5>
                    <div>
                        <a href="{{ route('produits.edit', $produit) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('produits.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nom:</div>
                        <div class="col-md-8">{{ $produit->nom }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Description:</div>
                        <div class="col-md-8">{{ $produit->description ?? 'Non spécifiée' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Prix unitaire:</div>
                        <div class="col-md-8">{{ number_format($produit->prix_unitaire, 2) }} €</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Stock:</div>
                        <div class="col-md-8">{{ $produit->stock }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Catégorie:</div>
                        <div class="col-md-8">{{ $produit->categorie->nom ?? 'Non catégorisé' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Date de création:</div>
                        <div class="col-md-8">{{ $produit->created_at ? $produit->created_at->format('d/m/Y H:i') : 'Non disponible' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Dernière modification:</div>
                        <div class="col-md-8">{{ $produit->updated_at ? $produit->updated_at->format('d/m/Y H:i') : 'Non disponible' }}</div>
                    </div>

                    @if($produit->commandes->count() > 0)
                        <div class="mt-4">
                            <h6>Commandes associées:</h6>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID Commande</th>
                                            <th>Date</th>
                                            <th>Quantité</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($produit->commandes as $commande)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('commandes.show', $commande) }}">
                                                        #{{ $commande->id }}
                                                    </a>
                                                </td>
                                                <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                                                <td>{{ $commande->pivot->quantite }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 