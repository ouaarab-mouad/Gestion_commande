@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ajouter un produit') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('produits.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nom" class="form-label">{{ __('Nom') }}</label>
                            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}"  autocomplete="nom" autofocus>
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('Description') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prix_unitaire" class="form-label">{{ __('Prix unitaire') }}</label>
                            <input id="prix_unitaire" type="number" step="0.01" class="form-control @error('prix_unitaire') is-invalid @enderror" name="prix_unitaire" value="{{ old('prix_unitaire') }}" >
                            @error('prix_unitaire')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">{{ __('Stock') }}</label>
                            <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}"  min="0">
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="categorie_id" class="form-label">{{ __('Catégorie') }}</label>
                            <select id="categorie_id" class="form-select @error('categorie_id') is-invalid @enderror" name="categorie_id">
                                <option value="">{{ __('Sélectionner une catégorie') }}</option>
                                @foreach(\App\Models\Categorie::all() as $categorie)
                                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Ajouter') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 