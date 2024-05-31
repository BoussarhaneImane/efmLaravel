@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des Livres</h1>
        
        <!-- Affichage des messages de succès -->
        @if(session('success'))
            <div class="alert alert-warning">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Affichage des messages d'erreur -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <a href="{{ route('livres.create') }}" class="btn btn-primary">Ajouter un livre</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Pages</th>
                    <th>Description</th>
                    <th>Catégorie</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($livres as $livre)
                    <tr>
                        <td>{{ $livre->titre }}</td>
                        <td>{{ $livre->pages }}</td>
                        <td>{{ $livre->description }}</td>
                        <td>{{ $livre->categorie->nom }}</td>
                        <td>
                            @if($livre->image)
                                <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" width="100">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('livres.edit', $livre->id) }}" class="btn btn-warning">Éditer</a>
                            <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
