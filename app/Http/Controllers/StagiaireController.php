<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StagiaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stagiaires = Stagiaire::all();
        return view('stagiaires.index', compact('stagiaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stagiaires.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'age' => 'required|integer|between:17,30',
            'email' => 'required|email|unique:stagiaires',
            'password' => 'required|string'
        ]);
    
        // Hasher le mot de passe avant de le stocker
        $hashedPassword = Hash::make($request->input('password'));
    
        // Créer le stagiaire avec le mot de passe haché
        Stagiaire::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'age' => $request->input('age'),
            'email' => $request->input('email'),
            'password' => $hashedPassword
        ]);
    
        // Rediriger vers la page d'accueil après l'ajout du stagiaire
        return redirect('/stagiaires')->with('success', 'Stagiaire ajouté avec succès!');
    }

       

    

    /**
     * Display the specified resource.
     */
    public function show(Stagiaire $stagiaire)
    {
        return view('stagiaires.show', compact('stagiaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stagiaire $stagiaire)
    {
        return view('stagiaires.edit', compact('stagiaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stagiaire $stagiaire)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'age' => 'required|integer|between:17,30',
            'email' => 'required|email|unique:stagiaires,email,' . $stagiaire->id,
            'password' => 'required|string'
        ]);
    
        // Hasher le nouveau mot de passe avant la mise à jour
        $hashedPassword = Hash::make($request->input('password'));
    
        // Mettre à jour les autres champs du stagiaire
        $stagiaire->update([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'age' => $request->input('age'),
            'email' => $request->input('email'),
            'password' => $hashedPassword // Mise à jour du mot de passe haché
        ]);
    
        // Rediriger vers la page d'accueil après la mise à jour du stagiaire
        return redirect('/stagiaires')->with('success', 'Stagiaire mis à jour avec succès!');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stagiaire $stagiaire)
    {
        $stagiaire->delete();
        return redirect()->route('stagiaires.index')->with('success', 'Stagiaire supprimé avec succès!');
    }

    /**
     * Remove all resources from storage.
     */
    public function destroyAll()
    {
        Stagiaire::truncate();
        // Réinitialisation du compteur d'incrémentation des IDs (uniquement pour MySQL)
        DB::statement('ALTER TABLE stagiaires AUTO_INCREMENT = 1');
        return redirect('/stagiaires')->with('success', 'Tous les stagiaires ont été supprimés!');
    }

    /**
     * Display a listing of the resource based on search query.
     */
    public function search(Request $request)
    {
        $query = $request->input('search');
        $stagiaires = Stagiaire::where('nom', 'like', "%$query%")->get();
        return view('stagiaires.index', compact('stagiaires', 'query'));
    }
}
