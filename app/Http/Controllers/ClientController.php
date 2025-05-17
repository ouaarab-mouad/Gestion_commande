<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    
    public function index()
    {
        $clients = Client::orderBy('nom')->paginate(10);
        return view('clients.index', compact('clients'));
    }

    
    public function create()
    {
        return view('clients.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'telephone.max' => 'Le numéro de téléphone ne doit pas dépasser 20 caractères.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'adresse.max' => 'L\'adresse ne doit pas dépasser 255 caractères.',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Client ajouté avec succès.');
    }

   
    public function show(Client $client)
    {
        $client->load('commandes.produits');
        return view('clients.show', compact('client'));
    }

    
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
        ], [    
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'telephone.max' => 'Le numéro de téléphone ne doit pas dépasser 20 caractères.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'adresse.max' => 'L\'adresse ne doit pas dépasser 255 caractères.',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Client mis à jour avec succès.');
    }

    
    public function destroy(Client $client)
    {
        if ($client->commandes()->exists()) {
            return redirect()->route('clients.index')
                ->with('error', 'Impossible de supprimer ce client car il a des commandes associées.');
        }

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}