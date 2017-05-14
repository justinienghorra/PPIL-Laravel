<html>
<head>

</head>
<body>

<h1>Formations</h1>

@if(isset($formations))

    <table border="1">

        @foreach($formations as $formation)

            <tr>
                <td>{{$formation->nom}}</td>
                <td>{{$formation->description}}</td>
                <td>{{$formation->responsable->user->prenom . " " . $formation->responsable->user->nom }}</td>
            </tr>

        @endforeach

    </table>

@endif

</body>
</html>