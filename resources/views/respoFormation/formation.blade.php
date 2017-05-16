<html>
<head>

</head>
<body>

@if(isset($formation))

    <h1>Formation {{$formation->nom}}</h1>
    <p>{{$formation->description}}</p>


    <table border="1">


        <tr>
            <td>NOM</td>
            <td>DESCRIPTION</td>
            <td>RESPO</td>
        </tr><tr>
            <td>{{$formation->nom}}</td>
            <td>{{$formation->description}}</td>
            <td>{{$formation->responsable->user->prenom . " " . $formation->responsable->user->nom }}</td>
        </tr>

    </table>

@endif

</body>
</html>