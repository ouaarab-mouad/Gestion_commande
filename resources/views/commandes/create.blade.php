@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ajouter une commande') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('commandes.store') }}" id="commandeForm">
                        @csrf

                        <div class="mb-3">
                            <label for="client_id" class="form-label">{{ __('Client') }}</label>
                            <select id="client_id" class="form-select @error('client_id') is-invalid @enderror" name="client_id" required>
                                <option value="">Sélectionnez un client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
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
                            <input id="date_commande" type="date" class="form-control @error('date_commande') is-invalid @enderror" name="date_commande" value="{{ old('date_commande', date('Y-m-d')) }}" required>
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
                                <option value="En attente" {{ old('statut') == 'En attente' ? 'selected' : '' }}>En attente</option>
                                <option value="En cours" {{ old('statut') == 'En cours' ? 'selected' : '' }}>En cours</option>
                                <option value="Terminée" {{ old('statut') == 'Terminée' ? 'selected' : '' }}>Terminée</option>
                                <option value="Annulée" {{ old('statut') == 'Annulée' ? 'selected' : '' }}>Annulée</option>
                            </select>
                            @error('statut')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Produits') }}</label>
                            <div id="produits-container">
                                <div class="row mb-2 produit-row">
                                    <div class="col-md-6">
                                        <select name="produits[]" class="form-select produit-select" required>
                                            <option value="">Sélectionnez un produit</option>
                                            @foreach($produits as $produit)
                                                <option value="{{ $produit->id }}" data-stock="{{ $produit->stock }}" data-prix="{{ $produit->prix_unitaire }}">
                                                    {{ $produit->nom }} (Stock: {{ $produit->stock }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="quantites[]" class="form-control quantite-input" min="1" placeholder="Quantité" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove-produit" style="display: none;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-produit">
                                <i class="fas fa-plus"></i> Ajouter un produit
                            </button>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Créer la commande') }}
                            </button>
                            <a href="{{ route('commandes.index') }}" class="btn btn-secondary">
                                {{ __('Annuler') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('produits-container');
    const addButton = document.getElementById('add-produit');
    const firstRow = container.querySelector('.produit-row');
    const removeButton = firstRow.querySelector('.remove-produit');
    const form = document.getElementById('commandeForm');

    // Show remove button if there's more than one row
    if (container.querySelectorAll('.produit-row').length > 1) {
        removeButton.style.display = 'block';
    }

    // Add new product row
    addButton.addEventListener('click', function() {
        const newRow = firstRow.cloneNode(true);
        newRow.querySelector('.produit-select').value = '';
        newRow.querySelector('.quantite-input').value = '';
        newRow.querySelector('.remove-produit').style.display = 'block';
        container.appendChild(newRow);
    });

    // Remove product row
    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-produit')) {
            const row = e.target.closest('.produit-row');
            if (container.querySelectorAll('.produit-row').length > 1) {
                row.remove();
            }
        }
    });

    // Validate quantity against stock
    container.addEventListener('change', function(e) {
        if (e.target.classList.contains('quantite-input')) {
            const row = e.target.closest('.produit-row');
            const select = row.querySelector('.produit-select');
            const option = select.options[select.selectedIndex];
            const stock = parseInt(option.dataset.stock);
            const quantite = parseInt(e.target.value);

            if (quantite > stock) {
                alert(`Stock insuffisant. Stock disponible: ${stock}`);
                e.target.value = stock;
            }
        }
    });

    // Form submission handling
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate client selection
        const clientId = document.getElementById('client_id').value;
        if (!clientId) {
            alert('Veuillez sélectionner un client');
            return;
        }

        // Validate date
        const dateCommande = document.getElementById('date_commande').value;
        if (!dateCommande) {
            alert('Veuillez sélectionner une date de commande');
            return;
        }

        // Validate status
        const statut = document.getElementById('statut').value;
        if (!statut) {
            alert('Veuillez sélectionner un statut');
            return;
        }

        // Validate products
        const produitRows = container.querySelectorAll('.produit-row');
        let hasValidProducts = false;

        produitRows.forEach(row => {
            const produitSelect = row.querySelector('.produit-select');
            const quantiteInput = row.querySelector('.quantite-input');

            if (produitSelect.value && quantiteInput.value) {
                hasValidProducts = true;
            }
        });

        if (!hasValidProducts) {
            alert('Veuillez sélectionner au moins un produit avec une quantité');
            return;
        }

        // If all validations pass, submit the form
        form.submit();
    });
});
</script>
@endpush
@endsection 