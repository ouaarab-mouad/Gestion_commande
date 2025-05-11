@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Liste des clients') }}</span>
                    <a href="{{ route('clients.create') }}" class="btn btn-primary">
                        {{ __('Ajouter un client') }}
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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Nom') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Téléphone') }}</th>
                                        <th>{{ __('Adresse') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($clients as $client)
                                        <tr>
                                            <td>{{ $client->nom }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->telephone }}</td>
                                            <td>{{ $client->adresse }}</td>
                                            <td>
                                                <a href="{{ route('clients.show', $client) }}" class="btn btn-info btn-sm">
                                                    {{ __('Voir') }}
                                                </a>
                                                <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning btn-sm">
                                                    {{ __('Modifier') }}
                                                </a>
                                                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer ce client ?') }}')">
                                                        {{ __('Supprimer') }}
                                                    </button>
                                                </form>
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
                        <div class="d-flex justify-content-center mt-4">
                            {{ $clients->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
