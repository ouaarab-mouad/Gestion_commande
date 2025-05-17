@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Liste des clients') }}</h5>
                    <a href="{{ route('clients.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> {{ __('Ajouter un client') }}
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

                    @if($clients->isEmpty())
                        <div class="alert alert-info">
                            {{ __('Aucun client n\'a été trouvé') }}
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Nom') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Téléphone') }}</th>
                                        <th>{{ __('Adresse') }}</th>
                                        <th class="text-end">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($clients as $client)
                                        <tr>
                                            <td>{{ $client->nom }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->telephone }}</td>
                                            <td>{{ $client->adresse }}</td>
                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('clients.show', $client) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer ce client ?') }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">{{ __('Aucun client trouvé') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Affichage de {{ $clients->firstItem() }} à {{ $clients->lastItem() }} sur {{ $clients->total() }} clients
                            </div>
                            <nav>
                                <ul class="pagination mb-0">
                                    @if($clients->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">Précédent</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $clients->previousPageUrl() }}">Précédent</a>
                                        </li>
                                    @endif

                                    @foreach($clients->getUrlRange(1, $clients->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $clients->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if($clients->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $clients->nextPageUrl() }}">Suivant</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">Suivant</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
