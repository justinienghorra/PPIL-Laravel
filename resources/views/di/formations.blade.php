@extends('layouts.main')
@section('title')
    Formations
@stop
@section('content')


    <div class="card">
        <div class="card-content" id="content">


            <div class="row">
                <h3 class="header s12 orange-text center">Formations</h3>
            </div>

            <div id="liste-formation">
                <div v-for="formation in formations">
                    <formations-main
                            :getmodalmodifid="getModalModifId"
                            :getmodalsuppid="getModalSuppId"
                            :openmodal="openModal"
                            :responsable="responsable"
                            :formationarg="formation">
                    </formations-main>
                    <formations-modal-suppression
                            :getmodalsuppid="getModalSuppId"
                            :deleteformation="deleteFormation"
                            :formationarg="formation">
                    </formations-modal-suppression>
                    <formations-modal-modification-responsable
                        :formationarg="formation"
                        :users="users"
                        :modifierresponsable="modifierResponsable"
                        :getmodalmodifid="getModalModifId">
                    </formations-modal-modification-responsable>
                </div>

                <formations-modal-ajout :token="token" :submitformadd="submitFormAdd"></formations-modal-ajout>

            </div>



        </div>
    </div>



    @include('includes.buttonImportExportAdd')



    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/materialize.js"></script>
    <script src="https://unpkg.com/vue"></script>
    <script src="/js/di/FormationsDIComponents.js"></script>
    <script src="/js/utils.js"></script>

    <script>

        var listeFormationsVue = new Vue({
            delimiters: ['${', '}'],
            el: "#liste-formation",
            data: {
                formations: [
                    @foreach(App\Formation::all() as $formation)
                    {
                        nom: "{{$formation->nom}}",
                        description: "{{$formation->description}}",
                        id: {{$formation->id}},
                        @if(isset($formation->responsable))
                            id_responsable: {{$formation->responsable->id_utilisateur}}
                        @else
                            id_responsable: 0
                        @endif
                    },
                    @endforeach
                ],
                users: [
                    @foreach(App\User::all() as $user)
                    {
                        nom: "{{ $user->nom  }}",
                        prenom: "{{ $user->prenom  }}",
                        email: "{{ $user->email  }}",
                        id: {{ $user->id  }},
                    },
                    @endforeach
                ],
            },
            computed: {
                token: function() {
                    return $('meta[name="csrf-token"]').attr('content');
                }
            },

            methods: {

                responsable: function (id_formation) {
                    var formation = this.getFormation(id_formation);
                    if (formation === null) return '';
                    var user = this.getUser(formation.id_responsable);
                    console.log('User obtenue : ' + JSON.stringify(user));
                    if (user === null) return 'Aucun responsable';
                    return user.prenom + " " + user.nom;
                },

                getFormation: function (id_formation) {
                    var res = null;
                    $.each(this.formations, function (index, value) {
                        if (value.id === id_formation) {
                            console.log('Formation : ' + JSON.stringify(value));
                            res = value;
                        }
                    });
                    return res;
                },

                getUser: function (id_user) {
                    var res = null;
                    $.each(this.users, function (index, value) {
                        if (value.id == id_user) {
                            console.log('User : ' + JSON.stringify(value));
                            res = value;
                        }
                    });
                    return res;
                },

                openModal: function(id_formation) {
                    console.log('modal open');
                    $('#'+id_formation).modal('open');
                },

                deleteFormation : function(id_formation) {
                    console.log('Delete Formation : ' + id_formation)
                    var deleteFormationWithId = this.deleteFormationWithId;
                    $.ajax({
                        url: "/di/formations/delete",
                        method: "post",
                        data: "id_formation="+id_formation
                    }).done(function (msg) {
                        if (msg['message'] === 'success') {
                            deleteFormationWithId(id_formation);
                            makeToast("Suppression de la formation réussie");
                        } else {
                            // TODO Message d'erreur
                        }
                    }).fail(function (xhr, msg) {
                        makeToast('Erreur serveur : ' + xhr['status'])
                    });
                },

                deleteFormationWithId: function(id_formation) {
                    var formations = this.formations;
                    $.each(this.formations, function(index, value) {
                        if (value.id === id_formation) {
                            Vue.delete(formations, index);
                            return;
                        }
                    });
                },

                submitFormAdd: function() {
                    $('#form-add').submit();
                },

                getModalSuppId: function(id_formation) {
                    return 'modal-supp-' + id_formation;
                },

                getModalModifId: function(id_formation) {
                    return 'modal-modif-' + id_formation;
                },

                modifierResponsable(id_formation, id_utilisateur) {
                    console.log('Formation : ' + id_formation)
                    console.log('User : ' + id_utilisateur)
                    var getModalModifId = this.getModalModifId;
                    var getFormationWithId = this.getFormation;
                    $.ajax({
                        url: "/di/formations/updateResponsable",
                        method: "post",
                        data: "id_utilisateur=" + id_utilisateur + "&id_formation=" + id_formation
                    }).done(function (msg) {
                        console.log(msg);
                        if (msg['message'] === 'success') {
                            var formation = getFormationWithId(id_formation);
                            formation.id_responsable = id_utilisateur;
                            makeToast("Modification du responsable réussie");
                            console.log('id : ' + getModalModifId(id_formation));
                            $('#' + getModalModifId(id_formation)).modal('close');
                        } else {

                        }
                    }).fail(function (xhr, msg) {
                        makeToast('Erreur serveur : ' + xhr['status'])
                    })
                },
            }
        });





























        function submitImport(event) {
            event.preventDefault();
            $('#form-import').submit();
        }

        function modifResp(event, id_formation, id_utilisateur) {
            console.log('Formation : ' + id_formation)
            console.log('User : ' + id_utilisateur)
            $.ajax({
                url: "/di/formations/updateResponsable",
                method: "post",
                data: "id_utilisateur=" + id_utilisateur + "&id_formation=" + id_formation
            }).done(function (msg) {
                console.log(msg);
                if (msg['message'] === 'success') {
                    var user = msg['user'];
                    $('#resp-' + id_formation).text(user['prenom'] + ' ' + user['nom']);
                    makeToast("Modification du responsable réussie");
                    $('#modal-' + id_formation).modal('close');
                }
            }).fail(function (xhr, msg) {
                makeToast('Erreur serveur : ' + xhr['status'])
            })
        }

        /*function deleteFormation(event, id_formation) {
            console.log('Delete Formation : ' + id_formation)
            $.ajax({
                url: "/di/formations/delete",
                method: "post",
                data: "id_formation="+id_formation
            }).done(function (msg) {
                if (msg['message'] === 'success') {
                    $('#collection-formation-' + id_formation).remove();
                    makeToast("Suppression de la formation réussie");
                }
            }).fail(function (xhr, msg) {
                makeToast('Erreur serveur : ' + xhr['status'])
            });
        }*/

        $(document).ready(function () {

            // Toast pour action réussie

            @if (Session::get('messages') !== null && isset(Session::get('messages')['success']))
                makeToast('{{Session::get('messages')["success"]}}');
            @endif


            // Toast pour les erreurs

            @foreach($errors->all() as $error)
                @if (Session::get('messages') !== null)
                    makeToast('{{$error}} (ligne {{Session::get('messages')["ligne"]}})');
                @else
                    makeToast('{{$error}}');
                @endif
            @endforeach

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btn-add-formation').click(function (event) {
                var nom = $('#nom-formation-add').val();
                var desc = $('#description-formation-add').val();
                $.ajax({
                    url: "/di/formations/add",
                    method: "POST",
                    data: "nom=" + nom + "&description=" + desc
                })
                    .done(function (msg) {
                        console.log(msg);
                        if (msg['messages'] === 'success') {
                            var tab = $('#tableau_formations');
                            var str = '<tr id="' + msg['formation']['id'] + '">';
                            str = str + '<td><a href="/formations/' + msg['formation']['nom'] + '">' + msg['formation']['nom'] + '</a></td>';
                            str = str + '<td>' + msg['formation']['description'] + '</td>';
                            str = str + '<td></td>';
                            str = str + '<td><button type="submit" class="btn-delete-formation" id=">' + msg['formation']['id'] + '">Supprimer</button></td>';
                            tab.append(str);
                        } else {
                            alert('ECHEC :/')
                        }
                    })

                    .fail(function (xhr, msg) {
                        console.log(xhr);
                        console.log(msg);
                        alert('ERREUR voir console <3');
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
                            $('tr#' + id_formation).remove();
                        } else {
                            alert('ECHEC :/')
                        }
                    })
                    .fail(function (xhr, msg) {
                        console.log(msg);
                        console.log(xhr);
                        alert('ERREUR voir console <3');
                    });
            });

            $('.btn-modifier-formation').click(function () {
                var id_utilisateur = $(this).parent().find("#responsable").find(':selected').attr('value');
                var id_formation = $(this).parent().parent().attr('id');
                console.log('User  : ' + id_utilisateur);
                console.log('Formation  : ' + id_formation);
                $.ajax({
                    url: "/di/formations/updateResponsable",
                    method: "POST",
                    data: "id_utilisateur=" + id_utilisateur + "&id_formation=" + id_formation
                }).done(function (msg) {
                    console.log(msg);
                    if (msg['message'] === 'success') {
                        //
                    } else {
                        alert('ECHEC :/')
                    }
                }).fail(function (xhr, msg) {
                    console.log(msg);
                    console.log(xhr);
                    alert('ERREUR voir console <3');
                });
            });
        });
    </script>
@stop

