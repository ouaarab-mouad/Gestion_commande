@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Détails de la commande') }}</span>
                    <div>
                        <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> {{ __('Modifier') }}
                        </a>
                        <a href="{{ route('commandes.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> {{ __('Retour') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>{{ __('Informations de la commande') }}</h5>
                            <table class="table">
                                <tr>
                                    <th>{{ __('Client') }}:</th>
                                    <td>{{ $commande->client->nom }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Date de commande') }}:</th>
                                    <td>{{ $commande->date_commande->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Statut') }}:</th>
                                    <td>
                                        <span class="badge bg-{{ $commande->statut === 'Terminée' ? 'success' : ($commande->statut === 'En cours' ? 'primary' : ($commande->statut === 'Annulée' ? 'danger' : 'warning')) }}">
                                            {{ $commande->statut }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Montant total') }}:</th>
                                    <td>{{ number_format($commande->calculerMontantTotal(), 2) }} €</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <h5>{{ __('Produits commandés') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('Produit') }}</th>
                                    <th>{{ __('Quantité') }}</th>
                                    <th>{{ __('Prix unitaire') }}</th>
                                    <th>{{ __('Total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commande->produits as $produit)
                                <tr>
                                    <td>{{ $produit->nom }}</td>
                                    <td>{{ $produit->pivot->quantite }}</td>
                                    <td>{{ number_format($produit->prix_unitaire, 2) }} €</td>
                                    <td>{{ number_format($produit->prix_unitaire * $produit->pivot->quantite, 2) }} €</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">{{ __('Total') }}:</th>
                                    <th>{{ number_format($commande->calculerMontantTotal(), 2) }} €</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 