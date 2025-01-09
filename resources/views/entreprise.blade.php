<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations sur l'entreprise</title>
</head>
<body>
    <h1>{{ $entreprise->NOM }}</h1>
    <p>SIREN: {{ $entreprise->SIREN }}</p>
    <p>SIRET: {{ $entreprise->SIRET_SIEGE }}</p>

    <h2>Commentaires</h2>
    @foreach ($commentaires as $commentaire)
        <div>
            <p>{{ $commentaire->COMMENTAIRE }}</p>
        </div>
    @endforeach

    <form action="{{ route('commentaire.store') }}" method="post">
        @csrf
        <input type="hidden" name="ENTREPRISE_ID" value="{{ $entreprise->ENTREPRISE_ID }}">
        <textarea name="COMMENTAIRE" placeholder="Ajouter un commentaire"></textarea>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>