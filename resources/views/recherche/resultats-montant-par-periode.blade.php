@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Montant des commandes') }}
                    <a href="{{ route('recherche.montant-par-periode.form') }}" class="btn btn-secondary float-right">
                        {{ __('Nouvelle recherche') }}
                    </a>
                </div>

                <div class="card-body">
                    <div class="alert alert-info mb-4">
                        <h5>Période : {{ $validated['annee'] }}</h5>
                        @if(!empty($moisNom))
                            <p>Mois : {{ $moisNom }}</p>
                        @endif
                        @if(!empty($validated['etat_commande']))
                            <p>État : {{ ucfirst($validated['etat_commande']) }}</p>
                        @endif
                        <h4>Montant total : {{ number_format($montantTotal, 2) }} €</h4>
                    </div>

                    @if($commandes->isEmpty())
                        <div class="alert alert-warning">
                            {{ __('Aucune commande trouvée pour cette période.') }}
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Client') }}</th>
                                        <th>{{ __('État') }}</th>
                                        <th>{{ __('Produits') }}</th>
                                        <th>{{ __('Montant') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commandes as $commande)
                                        <tr>
                                            <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                                            <td>{{ $commande->client->nom }}</td>
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