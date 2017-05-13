<html>
<head>

</head>
<body>
<h1>Annuaire</h1>

<h4>Objet error (pour le frontend)</h4>
<p>
    {{ var_dump($errors) }}
</p>

@if($users->count() > 0)

    <table border="1">
        <tr>
            <td>Enseignant</td>
            <td>Statut</td>
            <td>email</td>
        </tr>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->prenom . " " . $user->nom }}</td>
                <td>{{ $user->statut() }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach

    </table>

@endif

<br>
<br>
<br>
<h4>Exportation</h4>
<a href="/di/annuaire.csv">Export to csv</a>

<hr>
<h4>Importation</h4>
<form method="post" action="/di/annuaire/importCSV" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="file_csv" />
    <button type="submit">Envoyer</button>
</form>

@if(isset ($data))
    {{  $data }}
@endif
<h4>Format requis</h4>
civilite,prenom,nom,email,adresse,statut
</body>
</html>