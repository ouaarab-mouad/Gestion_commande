<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RechercheController extends Controller
{
    
    public function showCommandesParClientForm()
    {
        $clients = Client::orderBy('nom')->get();
        return view('recherche.commandes-par-client', compact('clients'));
    }

    
    public function commandesParClient(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
        ], [
            'client_id.required' => 'Veuillez sélectionner un client.',
            'client_id.exists' => 'Le client sélectionné n\'existe pas.',
        ]);

        $client = Client::with(['commandes' => function($query) {
            $query->with('produits');
        }])->findOrFail($validated['client_id']);

        return view('recherche.resultats-commandes-par-client', compact('client'));
    }

   
    public function showMontantParPeriodeForm()
    {
        $annees = Commande::selectRaw('YEAR(date_commande) as annee')
            ->distinct()
            ->orderBy('annee', 'desc')
            ->pluck('annee');

        $mois = [
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Août',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre',
        ];

        $etats = ['en cours', 'terminée', 'annulée'];

        return view('recherche.montant-par-periode', compact('annees', 'mois', 'etats'));
    }

    
    public function montantParPeriode(Request $request)
    {
        $validated = $request->validate([
            'annee' => 'required|integer|min:2000|max:2099',
            'mois' => 'nullable|integer|min:1|max:12',
            'etat_commande' => 'nullable|in:en cours,terminée,annulée',
        ], [
            'annee.required' => 'L\'année est obligatoire.',
            'annee.integer' => 'L\'année doit être un nombre entier.',
            'annee.min' => 'L\'année doit être supérieure ou égale à 2000.',
            'annee.max' => 'L\'année doit être inférieure ou égale à 2099.',
            'mois.integer' => 'Le mois doit être un nombre entier.',
            'mois.min' => 'Le mois doit être supérieur ou égal à 1.',
            'mois.max' => 'Le mois doit être inférieur ou égal à 12.',
            'etat_commande.in' => 'L\'état de commande sélectionné est invalide.',
        ]);

        $query = Commande::query();

        // Filter by year
        $query->whereYear('date_commande', $validated['annee']);

        // Filter by month if provided
        if (!empty($validated['mois'])) {
            $query->whereMonth('date_commande', $validated['mois']);
        }

        // Filter by state if provided
        if (!empty($validated['etat_commande'])) {
            $query->where('etat_commande', $validated['etat_commande']);
        }

        // Get filtered commands
        $commandes = $query->with('produits')->get();

        // Calculate total amount
        $montantTotal = 0;
        foreach ($commandes as $commande) {
            $montantTotal += $commande->calculerMontantTotal();
        }

        // Format month name if provided
        $moisNom = null;
        if (!empty($validated['mois'])) {
            $mois = [
                1 => 'Janvier',
                2 => 'Février',
                3 => 'Mars',
                4 => 'Avril',
                5 => 'Mai',
                6 => 'Juin',
                7 => 'Juillet',
                8 => 'Août',
                9 => 'Septembre',
                10 => 'Octobre',
                11 => 'Novembre',
                12 => 'Décembre',
            ];
            $moisNom = $mois[$validated['mois']];
        }

        return view('recherche.resultats-montant-par-periode', compact(
            'commandes', 
            'montantTotal', 
            'validated', 
            'moisNom'
        ));
    }

    
    public function statistiquesParProduit()
    {
        $statistiques = DB::table('produits')
            ->leftJoin('commande_produit', 'produits.id', '=', 'commande_produit.produit_id')
            ->leftJoin('commandes', 'commande_produit.commande_id', '=', 'commandes.id')
            ->select(
                'produits.id',
                'produits.nom',
                'produits.prix_unitaire',
                DB::raw('SUM(CASE WHEN commandes.etat_commande != "annulée" THEN commande_produit.quantite ELSE 0 END) as quantite_totale'),
                DB::raw('SUM(CASE WHEN commandes.etat_commande != "annulée" THEN commande_produit.quantite * produits.prix_unitaire ELSE 0 END) as chiffre_affaires')
            )
            ->groupBy('produits.id', 'produits.nom', 'produits.prix_unitaire')
            ->orderBy('chiffre_affaires', 'desc')
            ->get();

        return view('recherche.statistiques-par-produit', compact('statistiques'));
    }
}