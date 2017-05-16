<html>
<head>
    <meta name="token" content="{{csrf_token()}}"/>
</head>
<body>

<h4>Objet error (pour le frontend)</h4>
<p>
    {{ var_dump($errors) }}
</p>

<h1>Formations</h1>

@if(isset($formations))

    <table border="1">

        @foreach($formations as $formation)

            <tr id="{{$formation->id}}">
                <td><a href="/formations/{{$formation->nom}}">{{$formation->nom}}</a></td>
                <td>{{$formation->description}}</td>
                @if(isset($formation->responsable->user))
                    <td>{{$formation->responsable->user->prenom . " " . $formation->responsable->user->nom }}</td>
                @else
                    <td></td>
                @endif
                <td>
                    <button id="{{$formation->id}}" class="btn-delete-formation" type="submit">Supprimer</button>
                </td>
            </tr>

        @endforeach

    </table>

@endif

<hr>



<h2>Ajouter une formation</h2>
<p>
    AJAX :
    <ul>
        <li>Renvoie en json {message: success, formation: lesinfosdelaformation}</li>
    </ul>
</p>
<div>
    <label for="nom">Nom : </label>
    <input id="nom-formation-add"type="text" name="nom">
    <label for="description">Description : </label>
    <input id="description-formation-add" type="text" name="description">
    <button id="btn-add-formation" type="submit">Ajouter</button>
</div>



<hr>
<h2>Importer un CSV</h2>
<form method="post" action="/di/formations/import" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="file_csv" />
    <button type="submit">Envoyer</button>
</form>
<hr>
<h2>Exportation en CSV</h2>
<a href="/di/formations.csv">Exporter</a>

<script src="/js/jquery-2.1.1.min.js"></script>
<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="token"]').attr('content')
            }
        });

        $('#btn-add-formation').click(function (event) {
           var nom = $('#nom-formation-add').val();
           var desc = $('#description-formation-add').val();
           $.ajax({
               url: "/di/formations/add",
               method: "POST",
               data: "nom=" + nom + "&description=" +desc
           })
               .done(function (msg) {
                   console.log(msg);

               })

               .fail(function (xhr, msg) {
                   console.log(xhr);
                   console.log(msg);

               });
        });

        $('.btn-delete-formation').click(function () {
           var id_formation = $(this).attr('id');
           $.ajax({
               url: "/di/formations/delete",
               method: "POST",
               data: "id_formation=" + id_formation
           })
               .done(function (msg) {
                   console.log(msg);
                   if (msg['message'] === 'success') {
                       $('tr#'+id_formation).remove();
                   }
               })
               .fail(function (xhr, msg) {
                   console.log(msg);
                   console.log(xhr);


               });
        });
    });
</script>
</body>
</html>