<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommandeController extends Controller
{
    
    public function index()
    {
        $commandes = Commande::with('client')
            ->orderBy('date_commande', 'desc')
            ->paginate(10);
        return view('commandes.index', compact('commandes'));
    }

    
    public function create()
    {
        $clients = Client::orderBy('nom')->get();
        $produits = Produit::where('stock', '>', 0)->orderBy('nom')->get();
        return view('commandes.create', compact('clients', 'produits'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_commande' => 'required|date',
            'statut' => 'required|in:En attente,En cours,Terminée,Annulée',
            'produits' => 'required|array|min:1',
            'produits.*' => 'required|exists:produits,id',
            'quantites' => 'required|array|min:1',
            'quantites.*' => 'required|integer|min:1',
        ], [
            'client_id.required' => 'La sélection d\'un client est obligatoire.',
            'client_id.exists' => 'Le client sélectionné n\'existe pas.',
            'date_commande.required' => 'La date de commande est obligatoire.',
            'date_commande.date' => 'Veuillez entrer une date valide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné n\'est pas valide.',
            'produits.required' => 'Veuillez sélectionner au moins un produit.',
            'produits.array' => 'Format de produits invalide.',
            'produits.min' => 'Veuillez sélectionner au moins un produit.',
            'produits.*.required' => 'Veuillez sélectionner un produit valide.',
            'produits.*.exists' => 'Un des produits sélectionnés n\'existe pas.',
            'quantites.required' => 'Veuillez spécifier les quantités.',
            'quantites.array' => 'Format de quantités invalide.',
            'quantites.min' => 'Veuillez spécifier au moins une quantité.',
            'quantites.*.required' => 'Veuillez spécifier une quantité.',
            'quantites.*.integer' => 'La quantité doit être un nombre entier.',
            'quantites.*.min' => 'La quantité doit être supérieure à 0.',
        ]);

        $commande = Commande::create($request->all());

        // Attach products to order
        $pivotData = [];
        foreach ($request->produits as $index => $produitId) {
            $produit = Produit::findOrFail($produitId);
            $quantite = $request->quantites[$index];
            
            if ($produit->stock < $quantite) {
                return back()->with('error', "Stock insuffisant pour le produit {$produit->nom}. Stock disponible: {$produit->stock}")->withInput();
            }
            
            $pivotData[$produitId] = ['quantite' => $quantite];
            
            // Decrease stock if order is not canceled
            if ($request->statut !== 'Annulée') {
                $produit->stock -= $quantite;
                $produit->save();
            }
        }
        
        $commande->produits()->attach($pivotData);

        return redirect()->route('commandes.index')
            ->with('success', 'Commande créée avec succès.');
    }

   
    public function show(Commande $commande)
    {
        $commande->load('client');
        return view('commandes.show', compact('commande'));
    }

   
    public function edit(Commande $commande)
    {
        $clients = Client::orderBy('nom')->get();
        return view('commandes.edit', compact('commande', 'clients'));
    }

   
    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_commande' => 'required|date',
            'statut' => 'required|in:En attente,En cours,Terminée,Annulée',
        ], [
            'client_id.required' => 'La sélection d\'un client est obligatoire.',
            'client_id.exists' => 'Le client sélectionné n\'existe pas.',
            'date_commande.required' => 'La date de commande est obligatoire.',
            'date_commande.date' => 'Veuillez entrer une date valide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut sélectionné n\'est pas valide.',
        ]);

        $commande->update($request->all());

        return redirect()->route('commandes.index')
            ->with('success', 'Commande mise à jour avec succès.');
    }

   
    public function destroy(Commande $commande)
    {
        DB::beginTransaction();

        try {
            $commande->delete();
            
            DB::commit();
            
            return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue lors de la suppression de la commande: ' . $e->getMessage());
        }
    }
}