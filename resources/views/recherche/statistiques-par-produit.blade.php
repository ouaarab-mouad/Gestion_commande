@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Statistiques par produit') }}</div>

                <div class="card-body">
                    @if($statistiques->isEmpty())
                        <div class="alert alert-info">
                            {{ __('Aucune statistique disponible.') }}
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Produit') }}</th>
                                        <th>{{ __('Prix unitaire') }}</th>
                                        <th>{{ __('Quantité vendue') }}</th>
                                        <th>{{ __('Chiffre d\'affaires') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($statistiques as $stat)
                                        <tr>
                                            <td>{{ $stat->nom }}</td>
                                            <td>{{ number_format($stat->prix_unitaire, 2) }} €</td>
                                            <td>{{ $stat->quantite_totale }}</td>
                                            <td>{{ number_format($stat->chiffre_affaires, 2) }} €</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="font-weight-bold">
                                        <td colspan="3" class="text-right">{{ __('Total') }}</td>
                                        <td>{{ number_format($statistiques->sum('chiffre_affaires'), 2) }} €</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 