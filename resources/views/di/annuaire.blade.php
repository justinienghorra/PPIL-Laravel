<html>
<head>

</head>
<body>
<h1>Annuaire</h1>

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

<a href="/di/annuaire.csv">Export to csv</a>

<hr>

<form method="post" action="/di/annuaire/importCSV" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="file_csv" />
    <button type="submit">Envoyer</button>
</form>

@if(isset ($data))
    {{  $data }}
@endif

</body>
</html>