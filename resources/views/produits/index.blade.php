@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des produits</h5>
                    <a href="{{ route('produits.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Nouveau produit
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                    <th>Catégorie</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produits as $produit)
                                    <tr>
                                        <td>{{ $produit->id }}</td>
                                        <td>{{ $produit->nom }}</td>
                                        <td>{{ $produit->description }}</td>
                                        <td>{{ number_format($produit->prix_unitaire, 2) }} €</td>
                                        <td>{{ $produit->categorie->nom ?? 'Non catégorisé' }}</td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a href="{{ route('produits.show', $produit) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('produits.edit', $produit) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('produits.destroy', $produit) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucun produit trouvé</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Affichage de {{ $produits->firstItem() }} à {{ $produits->lastItem() }} sur {{ $produits->total() }} produits
                        </div>
                        <nav>
                            <ul class="pagination mb-0">
                                @if($produits->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">Précédent</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $produits->previousPageUrl() }}">Précédent</a>
                                    </li>
                                @endif

                                @foreach($produits->getUrlRange(1, $produits->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $produits->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if($produits->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $produits->nextPageUrl() }}">Suivant</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">Suivant</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 