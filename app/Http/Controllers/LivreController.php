<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LivreController extends Controller
{
    public function index()
    {
        $livres = Livre::all();
        return view('livres.index', compact('livres'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('livres.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|max:255',
            'pages' => 'required|integer|min:1',
            'description' => 'required',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image'
        ]);

        try {
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('images', 'public');
            }

            Livre::create($validated);
            return redirect()->route('livres.index')->with('success', 'Livre ajouté avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'ajout du livre : ' . $e->getMessage());
            return redirect()->route('livres.index')->with('error', 'Erreur lors de l\'ajout du livre.');
        }
    }

    public function edit(Livre $livre)
    {
        $categories = Categorie::all();
        return view('livres.edit', compact('livre', 'categories'));
    }

    public function update(Request $request, Livre $livre)
    {
        $validated = $request->validate([
            'titre' => 'required|max:255',
            'pages' => 'required|integer|min:1',
            'description' => 'required',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image'
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($livre->image) {
                    Storage::delete($livre->image);
                }
                $validated['image'] = $request->file('image')->store('images', 'public');
            }

            $livre->update($validated);
            return redirect()->route('livres.index')->with('success', 'Livre mis à jour avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du livre : ' . $e->getMessage());
            return redirect()->route('livres.index')->with('error', 'Erreur lors de la mise à jour du livre.');
        }
    }

    public function destroy(Livre $livre)
    {
        try {
            if ($livre->image) {
                Storage::delete($livre->image);
            }
            $livre->delete();
            return redirect()->route('livres.index')->with('success', 'Livre supprimé avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression du livre : ' . $e->getMessage());
            return redirect()->route('livres.index')->with('error', 'Erreur lors de la suppression du livre.');
        }
    }
}
