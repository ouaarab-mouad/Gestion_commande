@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ajouter un produit à la commande</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('commande_produits.store') }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="commande_id" class="col-md-4 col-form-label text-md-right">Commande</label>
                            <div class="col-md-6">
                                <select id="commande_id" class="form-control @error('commande_id') is-invalid @enderror" name="commande_id" required>
                                    <option value="">Sélectionnez une commande</option>
                                    @foreach($commandes as $commande)
                                        <option value="{{ $commande->id }}" {{ old('commande_id') == $commande->id ? 'selected' : '' }}>
                                            Commande #{{ $commande->id }} - {{ $commande->client->nom }} ({{ $commande->date_commande }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('commande_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="produit_id" class="col-md-4 col-form-label text-md-right">Produit</label>
                            <div class="col-md-6">
                                <select id="produit_id" class="form-control @error('produit_id') is-invalid @enderror" name="produit_id" required>
                                    <option value="">Sélectionnez un produit</option>
                                    @foreach($produits as $produit)
                                        <option value="{{ $produit->id }}" {{ old('produit_id') == $produit->id ? 'selected' : '' }}>
                                            {{ $produit->nom }} ({{ $produit->prix_unitaire }} €)
                                        </option>
                                    @endforeach
                                </select>
                                @error('produit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="quantite" class="col-md-4 col-form-label text-md-right">Quantité</label>
                            <div class="col-md-6">
                                <input id="quantite" type="number" class="form-control @error('quantite') is-invalid @enderror" name="quantite" value="{{ old('quantite', 1) }}" min="1" required>
                                @error('quantite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Ajouter le produit
                                </button>
                                <a href="{{ route('commandes.index') }}" class="btn btn-secondary">
                                    Annuler
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 