<html>
<head>

</head>
<body>

@if(isset($formation))

    <h1>Formation {{$formation->nom}}</h1>
    <p>{{$formation->description}}</p>


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