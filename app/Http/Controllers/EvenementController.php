<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EvenementController extends Controller
{
    public function index(Request $request)
    {
        $query = Evenement::orderBy('date_heure', 'asc');
    
        if ($request->filled('titre')) {
            $query->where('titre', 'like', '%' . $request->titre . '%');
        }
    
        if ($request->filled('date')) {
            $query->whereDate('date_heure', $request->date);
        }
    
        $evenements = $query->get();
    
        return view('evenements.index', ['evenements' => $evenements]);
    }

    public function show(Evenement $evenement)
    {
        return view('evenements.show', ['evenement' => $evenement]);
    }

    public function create()
    {
        return view('evenements.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'categorie' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'club_organisateur' => 'required|string|max:255',
            'date_heure' => 'required|date',
            'type' => 'required|string|max:100',
            'description' => 'required|string',
            'programme' => 'required|string',
            'lieu' => 'nullable|string|max:255',
            'lien_inscription' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $filename, 'public');
            $validatedData['image_path'] = $path;
        }

        try {
            Evenement::create($validatedData);
            return redirect()->route('calendrier')
                             ->with('success', 'Événement ajouté avec succès !');
        } catch (\Exception $e) {
            Log::error("Erreur store événement: " . $e->getMessage());
            return redirect()->back()
                         ->withInput()
                         ->with('error', 'Erreur lors de l\'ajout de l\'événement.');
        }
    }

    public function edit(Evenement $evenement)
    {
        return view('evenements.edit', ['evenement' => $evenement]);
    }

    public function update(Request $request, Evenement $evenement)
{
    $validatedData = $request->validate([
        'categorie' => 'required|string|max:255',
        'titre' => 'required|string|max:255',
        'club_organisateur' => 'required|string|max:255',
        'date_heure' => 'required|date',
        'type' => 'required|string|max:100',
        'description' => 'required|string',
        'programme' => 'required|string',
        'lieu' => 'nullable|string|max:255',
        'lien_inscription' => 'nullable|url|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'image_action' => 'sometimes|in:keep,remove,replace'
    ]);

    // Gestion des images
    if ($request->has('image_action')) {
        switch ($request->image_action) {
            case 'remove':
                if ($evenement->image_path) {
                    Storage::disk('public')->delete($evenement->image_path);
                }
                $validatedData['image_path'] = null;
                break;
                
            case 'replace':
                if ($request->hasFile('image')) {
                    // Suppression de l'ancienne image si elle existe
                    if ($evenement->image_path) {
                        Storage::disk('public')->delete($evenement->image_path);
                    }
                    
                    // Enregistrement de la nouvelle image
                    $image = $request->file('image');
                    $filename = time().'.'.$image->getClientOriginalExtension();
                    $path = $image->storeAs('images', $filename, 'public');
                    $validatedData['image_path'] = $path;
                }
                break;
        }
    } elseif ($request->hasFile('image')) {
        // Cas où on veut ajouter une nouvelle image après suppression
        $image = $request->file('image');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $path = $image->storeAs('images', $filename, 'public');
        $validatedData['image_path'] = $path;
    }

    try {
        $evenement->update($validatedData);
        return redirect()->route('calendrier')
                         ->with('success', 'Événement mis à jour avec succès !');
    } catch (\Exception $e) {
        Log::error("Erreur update événement #{$evenement->id}: " . $e->getMessage());
        return redirect()->back()
                     ->withInput()
                     ->with('error', 'Erreur lors de la mise à jour de l\'événement.');
    }
}

    public function destroy(Evenement $evenement)
    {
        try {
            // Supprimer l'image associée si elle existe
            if ($evenement->image_path) {
                Storage::disk('public')->delete($evenement->image_path);
            }
            
            $evenement->delete();
            return redirect()->route('calendrier')
                             ->with('success', 'Événement supprimé avec succès !');
        } catch (\Exception $e) {
            Log::error("Erreur destroy événement #{$evenement->id}: " . $e->getMessage());
            return redirect()->route('calendrier')
                         ->with('error', 'Erreur lors de la suppression de l\'événement.');
        }
    }
}