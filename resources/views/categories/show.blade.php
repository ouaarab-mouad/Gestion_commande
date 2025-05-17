@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Détails de la catégorie</h5>
                    <div>
                        <a href="{{ route('categories.edit', ['categorie' => $categorie->id]) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">ID:</div>
                        <div class="col-md-8">{{ $categorie->id }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Nom:</div>
                        <div class="col-md-8">{{ $categorie->nom }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Description:</div>
                        <div class="col-md-8">{{ $categorie->description }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Nombre de produits:</div>
                        <div class="col-md-8">{{ $categorie->produits->count() }}</div>
                    </div>

                    @if($categorie->produits->count() > 0)
                        <div class="mt-4">
                            <h6>Produits dans cette catégorie:</h6>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Prix unitaire</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categorie->produits as $produit)
                                            <tr>
                                                <td>{{ $produit->id }}</td>
                                                <td>{{ $produit->nom }}</td>
                                                <td>{{ $produit->prix_unitaire }} €</td>
                                                <td>
                                                    <a href="{{ route('produits.show', $produit) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
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