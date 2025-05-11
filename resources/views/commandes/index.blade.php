@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Liste des commandes') }}</span>
                    <a href="{{ route('commandes.create') }}" class="btn btn-primary">
                        {{ __('Ajouter une commande') }}
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

                    @if($commandes->isEmpty())
                        <div class="alert alert-info">
                            {{ __('Aucune commande n\'a été trouvée') }}
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Client') }}</th>
                                        <th>{{ __('Date de commande') }}</th>
                                        <th>{{ __('Statut') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($commandes as $commande)
                                        <tr>
                                            <td>{{ $commande->client->nom }}</td>
                                            <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($commande->statut == 'En attente') badge-warning
                                                    @elseif($commande->statut == 'En cours') badge-info
                                                    @elseif($commande->statut == 'Terminée') badge-success
                                                    @else badge-danger
                                                    @endif">
                                                    {{ $commande->statut }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('commandes.show', $commande) }}" class="btn btn-info btn-sm">
                                                    {{ __('Voir') }}
                                                </a>
                                                <a href="{{ route('commandes.edit', $commande) }}" class="btn btn-warning btn-sm">
                                                    {{ __('Modifier') }}
                                                </a>
                                                <form action="{{ route('commandes.destroy', $commande) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cette commande ?') }}')">
                                                        {{ __('Supprimer') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">{{ __('Aucune commande trouvée') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $commandes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 