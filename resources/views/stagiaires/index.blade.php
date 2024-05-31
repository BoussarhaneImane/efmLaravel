<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Stagiaires</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-success text-center">Gestion des Stagiaires</h2>
        <hr>
        <!-- Affichage du message de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-3 mt-2">
            <a href="{{ route('stagiaires.create') }}" class="btn btn-success">Ajouter</a>
            <form action="{{ route('stagiaires.destroyAll') }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer Tous</button>
            </form>
            

            <form action="{{ route('stagiaires.search') }}" method="GET" class="form-inline my-2 my-lg-0" style="float: right;">
               <input class="form-control mr-sm-2" type="search" placeholder="Rechercher par nom" aria-label="Rechercher" name="search">
               <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
           </form>
        </div>
        <h4>Liste des Stagiaires</h4>
        <hr>
        <!-- Tableau pour afficher la liste des stagiaires -->
        <table class="table table-dark">
          <thead>
              <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Âge</th>
                  <th>Email</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
              <!-- Boucle pour afficher les stagiaires dans les lignes du tableau -->
              @foreach($stagiaires as $stagiaire)
              <tr>
                  <td>{{ $stagiaire->nom }}</td>
                  <td>{{ $stagiaire->prenom }}</td>
                  <td>{{ $stagiaire->age }}</td>
                  <td>{{ $stagiaire->email }}</td>
                  <td>
                      <!-- Boutons pour modifier et supprimer -->
                      <a href="{{ route('stagiaires.edit', $stagiaire->id) }}" class="btn btn-warning">Modifier</a>
                      <form action="{{ route('stagiaires.destroy', $stagiaire->id) }}" method="POST" style="display: inline;">
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

    <!-- Link to Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
