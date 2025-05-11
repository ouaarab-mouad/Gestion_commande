<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    
    public function index()
    {
        $categories = Categorie::orderBy('nom')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    
    public function create()
    {
        return view('categories.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'nom.required' => 'Le nom de la catégorie est obligatoire.',
        ]);

        try {
            Categorie::create($validated);
            return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la création de la catégorie: ' . $e->getMessage())->withInput();
        }
    }

    
    public function show(Categorie $categorie)
    {
        $categorie->load('produits');
        return view('categories.show', compact('categorie'));
    }

   
    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
    }

    
    public function update(Request $request, Categorie $categorie)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'nom.required' => 'Le nom de la catégorie est obligatoire.',
        ]);

        $categorie->update($validated);
        return redirect()->route('categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Categorie $categorie)
    {
        try {
            // Check if category has products
            if ($categorie->produits()->count() > 0) {
                return back()->with('error', 'Impossible de supprimer cette catégorie car elle contient des produits.');
            }
            
            $categorie->delete();
            return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la suppression de la catégorie: ' . $e->getMessage());
        }
    }
}