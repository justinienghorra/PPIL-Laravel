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
                <td><button name="{{$formation->id}}">Supprimer</button></td>
            </tr>

        @endforeach

    </table>

@endif

<hr>

<h2>Ajouter une formation</h2>
<form action="/di/formations/add">
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
    <button type="submit">Ok</button>
</form>

<hr>
<h2>Importer un CSV</h2>

<hr>
<h2>Exportation</h2>
</body>
</html>