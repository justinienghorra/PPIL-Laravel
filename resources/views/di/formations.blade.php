<html>
<head>

</head>
<body>

<h1>Formations</h1>

@if(isset($formations))

    <table border="1">

        @foreach($formations as $formation)

            <tr>
                <td><a href="/formations/{{$formation->nom}}">{{$formation->nom}}</a></td>
                <td>{{$formation->description}}</td>
                <td>{{$formation->responsable->user->prenom . " " . $formation->responsable->user->nom }}</td>
                <td><button>Supprimer</button></td>
            </tr>

        @endforeach

    </table>

@endif

<hr>

<h2>Ajouter une formation</h2>
<form action="/di/formations/add">

</form>

<hr>
<h2>Importer un CSV</h2>

<hr>
<h2>Exportation</h2>
</body>
</html>