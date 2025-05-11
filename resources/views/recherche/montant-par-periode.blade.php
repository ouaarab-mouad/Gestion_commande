@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recherche du montant par période') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('recherche.montant-par-periode') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="annee" class="col-md-4 col-form-label text-md-right">{{ __('Année') }}</label>

                            <div class="col-md-6">
                                <select id="annee" class="form-control @error('annee') is-invalid @enderror" name="annee" required>
                                    <option value="">Sélectionnez une année</option>
                                    @foreach($annees as $annee)
                                        <option value="{{ $annee }}">{{ $annee }}</option>
                                    @endforeach
                                </select>

                                @error('annee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mois" class="col-md-4 col-form-label text-md-right">{{ __('Mois') }}</label>

                            <div class="col-md-6">
                                <select id="mois" class="form-control @error('mois') is-invalid @enderror" name="mois">
                                    <option value="">Tous les mois</option>
                                    @foreach($mois as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>

                                @error('mois')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="etat_commande" class="col-md-4 col-form-label text-md-right">{{ __('État de la commande') }}</label>

                            <div class="col-md-6">
                                <select id="etat_commande" class="form-control @error('etat_commande') is-invalid @enderror" name="etat_commande">
                                    <option value="">Tous les états</option>
                                    @foreach($etats as $etat)
                                        <option value="{{ $etat }}">{{ ucfirst($etat) }}</option>
                                    @endforeach
                                </select>

                                @error('etat_commande')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Rechercher') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 