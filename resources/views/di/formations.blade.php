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
                <td>
                    <form action="/di/formations/delete" method="post">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$formation->id}}">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>

        @endforeach

    </table>

@endif

<hr>

<h2>Ajouter une formation</h2>
<form method="post" action="/di/formations/add">
    <label for="nom">Nom : </label>
    <input type="text" name="nom">
    <label for="description">Description : </label>
    <input type="text" name="description">
    <label for="responsable">Responsable : </label>
    <select name="responsable" id="">
        @foreach($users as $user)
            <option value="{{$user->email}}">{{ $user->prenom . " " . $user->nom }}</option>
        @endforeach
    </select>
    <button type="submit">Ajouter</button>
</form>

<hr>
<h2>Importer un CSV</h2>
<form method="post" action="/di/formations/import" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="file_csv" />
    <button type="submit">Envoyer</button>
</form>
<hr>
<h2>Exportation</h2>
<a href="/di/formations.csv">Exporter</a>
</body>
</html>