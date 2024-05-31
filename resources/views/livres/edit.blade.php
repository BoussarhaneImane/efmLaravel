@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Éditer un Livre</h1>
        
        <!-- Affichage des messages d'erreur -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- Affichage des messages de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('livres.update', $livre->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $livre->titre) }}" required>
            </div>
            <div class="mb-3">
                <label for="pages" class="form-label">Pages</label>
                <input type="number" class="form-control" id="pages" name="pages" value="{{ old('pages', $livre->pages) }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $livre->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="categorie_id" class="form-label">Catégorie</label>
                <select class="form-select" id="categorie_id" name="categorie_id" required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ $categorie->id == $livre->categorie_id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($livre->image)
                    <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" width="100">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
