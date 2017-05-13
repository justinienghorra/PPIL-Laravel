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

</body>
</html>