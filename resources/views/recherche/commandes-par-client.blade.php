@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recherche des commandes par client') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('recherche.commandes-par-client') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="client_id" class="col-md-4 col-form-label text-md-right">{{ __('Client') }}</label>

                            <div class="col-md-6">
                                <select id="client_id" class="form-control @error('client_id') is-invalid @enderror" name="client_id" required>
                                    <option value="">Sélectionnez un client</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                    @endforeach
                                </select>

                                @error('client_id')
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