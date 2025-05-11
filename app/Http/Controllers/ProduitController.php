<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')->orderBy('nom')->paginate(10);
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::orderBy('nom')->get();
        return view('produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix_unitaire' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'nullable|exists:categories,id',
        ], [
            'nom.required' => 'Le nom du produit est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'prix_unitaire.required' => 'Le prix unitaire est obligatoire.',
            'prix_unitaire.numeric' => 'Le prix unitaire doit être un nombre.',
            'prix_unitaire.min' => 'Le prix unitaire ne peut pas être négatif.',
            'stock.required' => 'Le stock est obligatoire.',
            'stock.integer' => 'Le stock doit être un nombre entier.',
            'stock.min' => 'Le stock ne peut pas être négatif.',
            'categorie_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
        ]);

        try {
            \Log::info('Attempting to create product with data:', $request->all());
            $produit = Produit::create($request->all());
            \Log::info('Product created successfully:', ['id' => $produit->id]);
            return redirect()->route('produits.index')->with('success', 'Produit créé avec succès.');
        } catch (\Exception $e) {
            \Log::error('Error creating product: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Une erreur est survenue lors de la création du produit: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Produit $produit)
    {
        $produit->load('categorie');
        return view('produits.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        $categories = Categorie::orderBy('nom')->get();
        return view('produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix_unitaire' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'nullable|exists:categories,id',
        ], [
            'nom.required' => 'Le nom du produit est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'prix_unitaire.required' => 'Le prix unitaire est obligatoire.',
            'prix_unitaire.numeric' => 'Le prix unitaire doit être un nombre.',
            'prix_unitaire.min' => 'Le prix unitaire ne peut pas être négatif.',
            'stock.required' => 'Le stock est obligatoire.',
            'stock.integer' => 'Le stock doit être un nombre entier.',
            'stock.min' => 'Le stock ne peut pas être négatif.',
            'categorie_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
        ]);

        $produit->update($request->all());

        return redirect()->route('produits.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $produit)
    {
        try {
            if ($produit->commandes()->count() > 0) {
                return back()->with('error', 'Impossible de supprimer ce produit car il est utilisé dans une ou plusieurs commandes.');
            }

            $produit->delete();
            return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la suppression du produit: ' . $e->getMessage());
        }
    }
}
