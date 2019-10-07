@extends('layouts.app')
@section("title","SpaceEtablisement | Stagiaire")
@section('content')

<div class="container pt-2">
        <div class="table-wrapper table-dark pt-4">
        <div align="center" class="alert " style="display:none;" id=divAlert>
            <i class="material-icons">thumb_up_alt</i>
                <strong id="alert">

                </strong>
            </div>
            <div class="table-title">
                <div class="row">
                    <div class="pl-3">
                    <h2><b>{{Auth::user()->nom}} /</b>Liste des Stagiaires</h2>
                    </div>
                    <div class="col-sm-6 text-right pr-4 pb-2">
                        <a href="#addProjetModal" class="btn btn-success" data-toggle="modal"><i class="material-icons" style="position:absolute;top:5px;left:249px" >playlist_add</i> <span style="padding-left:15px">Ajouter nouvelle Projet</span></a>
                        <a href="#deleteProjetModal" onclick="destroyAll()" class="btn btn-danger" data-toggle="modal"><i class="material-icons" style="position:absolute;top:5px;left:438px" >delete_sweep</i> <span style="padding-left:15px">Supprimier</span></a>
                    </div>
                </div>
            </div>
            <table id="datatable" class="table table-striped table-hover" style="color:white">
                <thead>
                    <tr>
                        <th align="center" style="height: 13px;padding-bottom: 10px;padding-left: 12px;padding-top: 0px;border-bottom-width: 2px;width: 41px;border-top-width: 1px;">
                            <span >
                                <input type="checkbox" onClick="toggle(this)"  id="selectAll">
                                <label for="selectAll" ></label>
                            </span>
                        </th>
                        <th>ID</th>
                        <th>Nom et Prenom</th>
                        <th>Naissance</th>
                        <th>Email</th>
                        <th>Filiere</th>
                        <th>Groupe</th>
                        <th>Absence</th>
                        <th>Result</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stagiaires as $stagiaire)
                    <tr id="{{$stagiaire->id}}">
                        <td>
                            <div class="custom-checkbox ">
                                <input type="checkbox" id="checkbox{{$stagiaire->id}}"  name="foo" value="{{$stagiaire->id}}">
                                <label for="checkbox1"></label>
                            </div>
                        </td>
                        <td>{{$stagiaire->id}}</td>
                        <td>{{$stagiaire->user->nom}}</td>
                        <td>{{$stagiaire->user->dateNaissance}}</td>
                        <td>{{$stagiaire->user->email}}</td>
                        <td>{{$stagiaire->filiere->nom}}</td>
                        <td>{{$stagiaire->filiere->groupe}}</td>
                        <td>{{$stagiaire->heures_absence." heure(s)"}}</td>
                        <td>{{$stagiaire->result==null?"_":$stagiaire->result."/20"}}</td>
                        <td style="width:100px">
                            <a href="#editProjetModal" class="edit" onclick="UpdateFiliereModule({{$stagiaire->id}})" data-toggle="modal"><i class="material-icons" style="color:yellow" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteProjetModal" class="delete" onclick='DeleteFiliereModule({{$stagiaire->id}}," {{$stagiaire->user->nom}}")' data-toggle="modal"><i class="material-icons" style="color:red" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="table-light">
            {{$stagiaires->links()}}
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addProjetModal" class="modal fade pt-5">
        <div class="modal-dialog">
            <div class="modal-content">
                <form  method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Ajouter un Stagiaire</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" >
                    <div id="add">
                        <div class="form-group">
                            <label>Nom et Prenom de Stagiaire</label>
                            <input type="text" id='NomFormateur' name="NomFormateur" class="form-control" placeholder="Nom et Prenom ..." required>
                        </div>
                        <div class="form-group">
                            <label>Date de Naissance</label>
                            <input type="date" id='DateNaissance' name="DateNaissance" class="form-control" placeholder="Date de Naissance ..." required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id='EmailFormateur' name="EmailFormateur" class="form-control" placeholder="Email ..." required>
                        </div>
                        <div class="form-group">
                            <label>Mot de Passe</label>
                            <input type="password" id='PasswordFormateur' name="PasswordFormateur" class="form-control" placeholder="Mot de Passe ..." required>
                        </div>
                        <div class="form-group">
                            <label>Nom de Filiere</label>
                            <select class="form-control" id="NomModule" name="NomModule">
                                <option value="" class="hidden"  selected disabled>Selectionner un Filiere</option>
                                @foreach($filieres as $key => $filere)
                                    <option value="{{$filere->id}}">{{$filere->nom}}</option>
                                @endforeach
                            </select>  
                        </div>
                        <div class="form-group">
                            <label>Année Scolaire</label>
                            <select class="form-control" id="groupeStagiaire" name="groupe" id="groupe">
                                <option value="" class="hidden"  selected disabled>Année Scolaire</option>
                                <option value="1ere Année">1ere Année</option>
                                <option value="2eme Année">2eme Année</option>
                            </select>  
                        </div>
                        <div class="form-group">
                            <label>Genre</label>
                            <select class="form-control" name="genre" id="genreStagiaire">
                                <option class="hidden" required disabled>Choisissez votre genre</option>
                                    @foreach(Auth::user()->genreOption() as $genreKey=>$genreValue)
                                        <option value="{{$genreKey}}" {{Auth::user()->genre==$genreValue ?"selected":""}}>{{$genreValue}}</option>
                                    @endforeach
                            </select>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-outline-danger" data-dismiss="modal" value="Cancel">
                    <input type="button" onclick="CreateFiliereModule()" class="btn btn-success" value="Ajouter">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editProjetModal"   class="modal fade pt-5">
        <div class="modal-dialog">
            <div class="modal-content">
                <form  method="post"  >
                @csrf
                @method("PATCH")
                        <div class="modal-header">
                            <h4 class="modal-title">Modifier</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body" >
                            <div id="add">
                                <div class="form-group">
                                    <label>Nom et Prenom de Stagiaire</label>
                                    <input type="text" id='updateNomFormateur' name="updateNomFormateur" class="form-control" placeholder="Nom et Prenom ..." required>
                                </div>
                                <div class="form-group">
                                    <label>Date de Naissance</label>
                                    <input type="date" id='updateDateNaissance' name="updateDateNaissance" class="form-control" placeholder="Date de Naissance ..." required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id='UpdateEmailFormateur' name="UpdateEmailFormateur" class="form-control" placeholder="Email ..." required>
                                </div>
                                <div class="form-group">
                                    <label>Mot de Passe</label>
                                    <input type="password" id='updatePasswordFormateur' name="updatePasswordFormateur" class="form-control" placeholder="Mot de Passe ..." required>
                                </div>
                                <div class="form-group">
                                    <label>Absence</label>
                                    <input type="number" id='updateabsenceStagiaire' name="updateabsenceStagiaire" class="form-control" placeholder="Absence ..." required>
                                </div>
                                <div class="form-group">
                                    <label>Result</label>
                                    <input type="number" id='updateresultStagiaire' name="updateresultStagiaire" class="form-control" placeholder="Result ..." required>
                                </div>
                                <div class="form-group">
                                    <label>Nom de Filiere</label>
                                    <select class="form-control" id="updateNomModule" name="updateNomModule">
                                        <option value="" class="hidden"  selected disabled>Selectionner un Filiere</option>
                                        @foreach($filieres as $key => $filere)
                                            <option value="{{$filere->id}}">{{$filere->nom}}</option>
                                        @endforeach
                                    </select>  
                                </div>
                                <div class="form-group">
                                    <label>Année Scolaire</label>
                                    <select class="form-control" id="updategroupeStagiaire" name="updategroupe" id="groupe">
                                        <option value="" class="hidden"  selected disabled>Année Scolaire</option>
                                        <option value="1ere Année">1ere Année</option>
                                        <option value="2eme Année">2eme Année</option>
                                    </select>  
                                </div>
                                <div class="form-group">
                                    <label>Genre</label>
                                    <select class="form-control" name="updategenreStagiaire" id="updategenreStagiaire">
                                        <option class="hidden" required disabled>Choisissez votre genre</option>
                                            @foreach(Auth::user()->genreOption() as $genreKey=>$genreValue)
                                                <option value="{{$genreKey}}" {{Auth::user()->genre==$genreValue ?"selected":""}}>{{$genreValue}}</option>
                                            @endforeach
                                    </select>    
                                </div>
                            </div>
                        <div class="modal-footer">
                            <input type="button" onclick='document.getElementById("update").innerHTML="";j=1' class="btn btn btn-outline-danger" data-dismiss="modal" value="Cancel">
                            <input type="button" onclick="patchFiliere()" class="btn btn-success" data-dismiss="modal" aria-hidden="true" value="Enregistrer">
                            <input type="hidden" id="Stagiaire_id">
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteProjetModal" class="modal fade pt-5">
        <div class="modal-dialog" >
            <div class="modal-content">
                <form  method="post">
                @csrf
                @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="h4">Supprimier le Stagiaire</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="messageDelete1">
                        <p>ce Stagiaire ID : <strong id="DeleteId"></strong> et Nom : <strong id="DeleteNom"></strong> est à commencé en supprission</p>
                        <p class="text-danger"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-body" id="messageDelete2">
                    
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn btn-outline-danger  " data-dismiss="modal" value="Cancel">
                        <input type="button" onclick="DestroyFiliereModule()" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    

<script>

function toggle(source) {
            checkboxes = document.getElementsByName('foo');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
        }
        function CreateFiliereModule() {
            var arr = [
                document.getElementById("NomFormateur").value,
                document.getElementById("DateNaissance").value,
                document.getElementById("EmailFormateur").value,
                document.getElementById("PasswordFormateur").value,
                document.getElementById("NomModule").value,
                document.getElementById("groupeStagiaire").value,
                document.getElementById("genreStagiaire").value,
            ]
            $.ajax({
                    url: "/AdminStagiaires",
                    type: 'POST',
                    data: JSON.stringify(arr),
                    dataType: 'JSON',
                    contentType:false,
                    cache:false,
                    processData:false,
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function( data ) {
                        console.log(data.message);
                        var d= document.getElementById("divAlert")
                            d.style.display="block";

                        if (data.operation) {
                            d.classList.add('alert-primary')
                            document.getElementById("alert").innerText=data.message;
                            var i = document.getElementById("module").value
                            document.getElementById(i).children[2].innerText=document.getElementById("filiere").value  ;
                            document.getElementById(i).children[3].innerText=document.getElementById("groupe").value       ;
                                        }
                        else{
                            d.classList.add('alert-danger')
                            document.getElementById("alert").innerText=data.message;

                        }            
                      }       
                });
         }

         function UpdateFiliereModule(id) {
             document.getElementById('Stagiaire_id').value=id;
             document.getElementById("updateNomFormateur").value=document.getElementById(id).children[2].textContent;
             document.getElementById("updateDateNaissance").value=document.getElementById(id).children[3].textContent;
             document.getElementById("updateNomModule").value=document.getElementById(id).children[5].textContent;
             document.getElementById("UpdateEmailFormateur").value=document.getElementById(id).children[4].textContent;
             document.getElementById("updateabsenceStagiaire").value=document.getElementById(id).children[7].textContent;
             document.getElementById("updateresultStagiaire").value=document.getElementById(id).children[8].textContent;
             document.getElementById("updategroupeStagiaire").value=document.getElementById(id).children[6].textContent;
        }

        function patchFiliere() {
            var arr = [
                document.getElementById('Stagiaire_id').value,
                document.getElementById("updateNomFormateur").value,
                document.getElementById("UpdateEmailFormateur").value,
                document.getElementById("updateDateNaissance").value,
                document.getElementById("updatePasswordFormateur").value,
                document.getElementById("updateNomModule").value,
                document.getElementById("updateresultStagiaire").value,
                document.getElementById("updategroupeStagiaire").value,
                document.getElementById("updateabsenceStagiaire").value,
                document.getElementById("updategenreStagiaire").value,
            ]
            let i = document.getElementById('Stagiaire_id').value;
            $.ajax({
                    url: "/AdminStagiaires/"+i,
                    type: 'PATCH',
                    data: JSON.stringify(arr),
                    dataType: 'JSON',
                    contentType:false,
                    cache:false,
                    processData:false,
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function( data ) {
                        console.log(data.message);
                        var d= document.getElementById("divAlert");
                            d.style.display="block";

                        if (data.operation) {
                            d.classList.add('alert-primary');
                            document.getElementById("alert").innerText=data.message;
                            j=1;
                            
                            document.getElementById(i).children[2].innerText=document.getElementById("UpdateNomFormateur").value;
                            document.getElementById(i).children[3].innerText=document.getElementById("UpdatedateNaissance").value;
                            document.getElementById(i).children[4].innerText=document.getElementById("updateNomModule").value;
                            document.getElementById(i).children[6].innerText=document.getElementById("UpdateEmailFormateur").value;
                                        }
                        else{
                            d.classList.add('alert-danger')
                            document.getElementById("alert").innerText=data.message;

                        }
                        
                      }       
                });
        }

        function destroyAll() {
            let arr = [];
            var c =0;
            let checkboxs = $('input[type$="checkbox"]');
            for (let index = 1; index < checkboxs.length; index++) {
                 if (checkboxs[index].checked===true) {
                    arr[index]=checkboxs[index].value;
                    c++;
                 }
            }
            document.getElementById('messageDelete1').style.display="none";
            document.getElementById('messageDelete2').style.display="block";
            document.getElementById('messageDelete2').innerHTML="Il y a plusieur d'éléments sélectionnés <strong>{ "+(c)+" élément(s) }</strong><br>Êtes-vous sûr de vouloir les supprimer<strong>?</strong>" ;
            document.getElementById('h4').textContent="Supprimer les Stagiaires" ;
        }


        function DeleteFiliereModule(id, nom ) {
            console.log(id);
            document.getElementById('messageDelete1').style.display="block";
            document.getElementById('messageDelete2').style.display="none";
            document.getElementById('DeleteId').textContent=id;
            document.getElementById('DeleteNom').textContent=nom;
            document.getElementById('h4').textContent="Supprimer Formateur" ;
        }
        function DestroyFiliereModule() {
            let c = 0;
            let checkboxs = $('input[type$="checkbox"]');
            for (let index = 1; index < checkboxs.length; index++) {
                 if (checkboxs[index].checked===true) {
                    c++;
                 }
            }

            if (c==0) {
                var id = document.getElementById('DeleteId').textContent;
            $.ajax({
                    url: "/AdminStagiaires/"+id,
                    type: 'DELETE',
                    dataType: 'JSON',
                    contentType:false,
                    cache:false,
                    processData:false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function( data ) {
                            var d= document.getElementById("divAlert")
                                d.style.display="block";
                                document.getElementsByTagName('tbody')[0].removeChild(document.getElementById(id));
                            if (data.operation) {
                                d.classList.add('alert-primary')
                                document.getElementById("alert").innerText=data.message;
                                document.getElementById("update").innerHTML="";
                                j=1;
                                
                                document.getElementById(i).children[2].innerText=document.getElementById("Updatefiliere").value  ;
                                document.getElementById(i).children[3].innerText=document.getElementById("Updategroupe").value       ;
                                            }
                            else{
                                d.classList.add('alert-danger')
                                document.getElementById("alert").innerText=data.message;

                            }

                      }       
                });
            }
            if (c!=0) {
                CommiteDestroyAll();
            }
        }
        function CommiteDestroyAll() {
            let arr = [];
            let checkboxs = $('input[type$="checkbox"]');
            for (let index = 1; index < checkboxs.length; index++) {
                 if (checkboxs[index].checked===true) {
                    arr[index]=checkboxs[index].value;
                 }
            }
            console.log(arr);
            $.ajax({
                    url: "/destroyallStagiaires",
                    type: 'POST',
                    data: JSON.stringify(arr),
                    dataType: 'JSON',
                    contentType:false,
                    cache:false,
                    processData:false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function( data ) {
                        console.log(data);
                        document.getElementById("Updatefiliere").value=data.filiere.nom;
                         document.getElementById("Updategroupe").value=data.filiere.groupe;
                        data.modules.forEach((x) => {
                            console.log(x.nom);
                            createUpdateModuleField(x.nom,x.coefficient);
                        });
                      }       
                });
        }

</script>
@endsection