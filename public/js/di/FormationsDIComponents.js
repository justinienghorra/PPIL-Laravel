Vue.config.delimiters = ['${', '}'];
Vue.component('formations-modal-suppression', {
    delimiters: ['${', '}'],
    props: ['formationarg', 'deleteformation', 'getmodalsuppid'],
    template: '<div :id="getmodalsuppid(formationarg.id)" class="modal"> \
                <div class="modal-content"> \
                    <div class="row"> \
                        <h4>Suppression de la formation</h4> \
                        <p> \
                            Attention, vous allez supprimer la formation ${formationarg.nom} \
                        </p>\
                    </div>\
                </div>\
                <div class="modal-footer">\
                    <a href="#!" @click.prevent="deleteformation(formationarg.id)" class="modal-action modal-close waves-effect waves-light btn-flat red-text" >Confirmer</a>\
                </div>\
            </div>'

});

Vue.component('formations-modal-modification-responsable', {
    delimiters: ['${', '}'],
    props: ['formationarg', 'users', 'getmodalmodifid', 'modifierresponsable'],
    template: '<div :id="getmodalmodifid(formationarg.id)" class="modal modal-fixed-footer"> \
                    <div class="modal-content">\
                        <div class="row">\
                            <h4>Modification du responsable</h4>\
                            <p>\
                                Attention, vous allez modifier le responsable de ${formationarg.nom} \
                            </p>\
                            <ul class="collection collection-with-header">\
                                <li class="collection-header"><h4>Liste des utilisateurs</h4></li>\
                                <li v-for="(user, index) in users" class="collection-item">\
                                    ${ user.prenom + " " + user.nom }\
                                    <a href="#!" @click.prevent="modifierresponsable(formationarg.id, user.id)"\
                                        class="secondary-content"><i class="material-icons">send</i></a>\
                                </li>\
                            </ul>\
                    </div>\
                </div>\
            </div>'

});

Vue.component('formations-main-back', {
    delimiters: ['${', '}'],
    props: ['formationarg', 'responsable', 'openmodal', 'getmodalsuppid', 'getmodalmodifid'],
    template: '<ul class="collection with-header ">\
                    <li class="collection-header">\
                        <h4>\
                            ${ formationarg.nom } \
                            <a href="#!" @click="openmodal(getmodalsuppid(formationarg.id))" class="red-text secondary-content"><i class="material-icons">clear</i></a> \
                        </h4>\
                    </li>\
                    <li class="collection-item">\
                        ${ formationarg.description }\
                    </li>\
                    <li class="collection-item">\
                        <span >\
                            ${ responsable(formationarg.id) }\
                        </span>\
                        <a href="#!"\
                            @click.prevent="openmodal(getmodalmodifid(formationarg.id))" class="btn-modif-responsable secondary-content btn btn-flat green-text">Modifier\
                                    le responsable</a>\
                    </li>\
            </ul>'
});

Vue.component('formations-main-new', {
    delimiters: ['${', '}'],
    props: ['formationarg', 'responsable', 'openmodal', 'getmodalsuppid', 'getmodalmodifid'],
    template: '<div class="card">\
                    <div class="card-content">\
                        <span class="card-title">${formationarg.nom}</span>\
                        <p>\
                        <strong>Description : </strong>${formationarg.description}\
                        <br>\
                        <strong>Responsable : </strong>${responsable(formationarg.id)}\
                        </p>\
                    </div>\
                    <div class="card-action">\
                        <a @click.prevent="openmodal(getmodalmodifid(formationarg.id))" href="">Modifier le responsable</a>\
                        <a @click.prevent="openmodal(getmodalsuppid(formationarg.id))" class="right red-text" href="">Supprimer</a>\
                    </div>\
                </div>'
});

Vue.component('formations-modal-ajout', {
    delimiters: ['${', '}'],
    props: ['submitformadd', 'token'],
    template: '<div class="modal" id="modal_add">\
                    <div class="modal-content">\
                        <div class="row">\
                            <h4>Ajout d\'une formation</h4> \
                        </div>\
                        <form method="post" action="/di/formations/add" id="form-add" class="row">\
                            <input type="hidden" name="_token" :value="token" >\
                            <div class="input-field col s12">\
                                <input name="nom" id="add-nom" type="text">\
                                <label for="">Nom</label>\
                            </div>\
                            <div class="input-field col s12">\
                                <input name="description" id="add-description" type="text">\
                                <label for="">Description</label>\
                            </div>\
                        </form>\
                    </div>\
                <div class="modal-footer">\
                    <a href="#!" v-on:click="submitformadd" class="modal-action  waves-effect waves-light btn-flat green-text" >Confirmer</a>\
                </div>\
        </div>'
});
