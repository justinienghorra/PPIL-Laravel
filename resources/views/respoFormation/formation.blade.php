<html>
<head>

</head>
<body>

@if(isset($formation))

    <h1>Formation {{$formation->nom}}</h1>
    <p>{{$formation->description}}</p>
    <p>Responsable : {{$formation->responsable->user->prenom . " " . $formation->responsable->user->nom }}</p>


    <table border="1" id="tableau_formations">



        @foreach($ues as $ue)
            <tr id="{{$ue->id}}">
                <td><a href="/ue/{{$ue->nom}}">{{$ue->nom}}</a></td>
                <td>{{$ue->description}}</td>
                <td>
                    <select id="responsable">
                        <option value="0" class="option-responsable"></option>
                        @foreach($users as $user)
                            <option class="option-responsable"

                                    @if(isset($ue->responsable))

                                    @if ($ue->responsable->user->id === $user->id)
                                    selected="selected"
                                    @endif

                                    @endif

                                    value="{{$user->id}}">{{$user->prenom . " " . $user->nom }}</option>
                        @endforeach
                    </select>
                    <button class="btn-modifier-formation">Modifier</button>
                </td>

                <td>
                    <button id="{{$ue->id}}" class="btn-delete-formation" type="submit">Supprimer</button>
                </td>
            </tr>

        @endforeach

    </table>


@endif

</body>
</html>