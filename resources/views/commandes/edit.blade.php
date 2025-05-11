@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier la commande') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('commandes.update', $commande->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="client_id" class="form-label">{{ __('Client') }}</label>
                            <select id="client_id" class="form-select @error('client_id') is-invalid @enderror" name="client_id" required>
                                <option value="">Sélectionnez un client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $commande->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_commande" class="form-label">{{ __('Date de commande') }}</label>
                            <input id="date_commande" type="datetime-local" class="form-control @error('date_commande') is-invalid @enderror" name="date_commande" value="{{ old('date_commande', $commande->date_commande->format('Y-m-d\TH:i')) }}" required>
                            @error('date_commande')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="statut" class="form-label">{{ __('Statut') }}</label>
                            <select id="statut" class="form-select @error('statut') is-invalid @enderror" name="statut" required>
                                <option value="">Sélectionnez un statut</option>
                                <option value="En attente" {{ old('statut', $commande->statut) == 'En attente' ? 'selected' : '' }}>En attente</option>
                                <option value="En cours" {{ old('statut', $commande->statut) == 'En cours' ? 'selected' : '' }}>En cours</option>
                                <option value="Terminée" {{ old('statut', $commande->statut) == 'Terminée' ? 'selected' : '' }}>Terminée</option>
                                <option value="Annulée" {{ old('statut', $commande->statut) == 'Annulée' ? 'selected' : '' }}>Annulée</option>
                            </select>
                            @error('statut')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Mettre à jour') }}
                            </button>
                            <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-secondary">
                                {{ __('Annuler') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 