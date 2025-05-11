@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Commandes du client') }}: {{ $client->nom }}
                    <a href="{{ route('recherche.commandes-par-client.form') }}" class="btn btn-secondary float-right">
                        {{ __('Nouvelle recherche') }}
                    </a>
                </div>

                <div class="card-body">
                    @if($client->commandes->isEmpty())
                        <div class="alert alert-info">
                            {{ __('Aucune commande trouvée pour ce client.') }}
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('État') }}</th>
                                        <th>{{ __('Produits') }}</th>
                                        <th>{{ __('Montant total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($client->commandes as $commande)
                                        <tr>
                                            <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                                            <td>{{ $commande->etat_commande }}</td>
                                            <td>
                                                <ul class="list-unstyled">
                                                    @foreach($commande->produits as $produit)
                                                        <li>{{ $produit->nom }} ({{ $produit->pivot->quantite }} x {{ number_format($produit->prix_unitaire, 2) }} €)</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ number_format($commande->calculerMontantTotal(), 2) }} €</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 