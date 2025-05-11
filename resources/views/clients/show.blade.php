@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Détails du client</h5>
                    <div>
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">ID:</div>
                        <div class="col-md-8">{{ $client->id }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Nom:</div>
                        <div class="col-md-8">{{ $client->nom }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Email:</div>
                        <div class="col-md-8">{{ $client->email }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Téléphone:</div>
                        <div class="col-md-8">{{ $client->telephone }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Adresse:</div>
                        <div class="col-md-8">{{ $client->adresse }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Nombre de commandes:</div>
                        <div class="col-md-8">{{ $client->commandes->count() }}</div>
                    </div>

                    @if($client->commandes->count() > 0)
                        <div class="mt-4">
                            <h6>Commandes du client:</h6>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Statut</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($client->commandes as $commande)
                                            <tr>
                                                <td>{{ $commande->id }}</td>
                                                <td>{{ $commande->date_commande }}</td>
                                                <td>{{ $commande->statut }}</td>
                                                <td>{{ $commande->total }} €</td>
                                                <td>
                                                    <a href="{{ route('commandes.show', $commande) }}" class="btn btn-info btn-sm">
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