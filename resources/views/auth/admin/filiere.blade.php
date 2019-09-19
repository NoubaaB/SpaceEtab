@extends('layouts.app')
@section("title","SpaceEtablisement | Filieres")
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
                    <div class="col-sm-6">
                    <h2><b>{{Auth::user()->nom}} /</b>Liste des Filieres</h2>
                    </div>
                    <div class="col-sm-6 text-right pr-4 pb-2">
                        <a href="#addProjetModal" class="btn btn-success" data-toggle="modal"><i class="material-icons" style="position:absolute;top:5px;left:249px" >playlist_add</i> <span style="padding-left:15px">Ajouter nouvelle Projet</span></a>
                        <a href="#deleteProjetModal" onclick="destroyAll()" class="btn btn-danger" data-toggle="modal"><i class="material-icons" style="position:absolute;top:5px;left:438px" >delete_sweep</i> <span style="padding-left:15px">Supprimier</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover" style="color:white">
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" onClick="toggle(this)"  id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th>ID</th>
                        <th>Filiere</th>
                        <th>Groupe</th>
                        <th>Date De Creation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filieres as $filiere)
                    <tr id="{{$filiere->id}}">
                        <td>
                            <div class="custom-checkbox ">
                                <input type="checkbox" id="checkbox{{$filiere->id}}"  name="foo" value="{{$filiere->id}}">
                                <label for="checkbox1"></label>
                            </div>
                        </td>
                        <td>{{$filiere->id}}</td>
                        <td>{{$filiere->nom}}</td>
                        <td>{{$filiere->groupe}}</td>
                        <td>{{$filiere->created_at}}</td>
                        <td>
                            <a href="#editProjetModal" class="edit" onclick="UpdateFiliereModule({{$filiere->id}})" data-toggle="modal"><i class="material-icons" style="color:yellow" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteProjetModal" class="delete" onclick="DeleteFiliereModule({{$filiere->id}},'{{$filiere->nom}}')" data-toggle="modal"><i class="material-icons" style="color:red" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="table-light">
            {{$filieres->links()}}
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
                    <h4 class="modal-title">Ajouter un Filiere</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" >
                    <div id="add">
                        <div class="form-group">
                            <label>Nom de Filiere</label>
                            <input type="text" id='filiere' name="filiere" class="form-control" placeholder="Nom de Filiere ..." required>
                        </div>
                        <div class="form-group">
                            <label>Groupe de Filiere</label>
                            <select class="form-control" id="groupe" name="groupe" id="groupe">
                                <option value="" class="hidden"  selected disabled>Année Scolaire</option>
                                <option value="1ere Année">1ere Année</option>
                                <option value="2eme Année">2eme Année</option>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group" style="color:black; margin-bottom:10px">
                     <a onclick="createModuleField()" class="btn btn-outline-success" data-toggle="modal">
                        <span >Add module</span>
                     </a>
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
                        <div class="modal-header">
                            <h4 class="modal-title">Modifier le Filiere</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <label>Nom de Filiere</label>
                                    <input type="text" id="Updatefiliere" name="Updatefiliere" class="form-control" placeholder="Nom de Filiere ..." required>
                                </div>
                                <div class="form-group">
                                    <label>Groupe de Filiere</label>
                                    <select id="Updategroupe" class="form-control" name="Updategroupe" id="groupe">
                                        <option value="" class="hidden"  selected disabled>Année Scolaire</option>
                                        <option value="1ere Année">1ere Année</option>
                                        <option value="2eme Année">2eme Année</option>
                                    </select>  
                                </div>
                            <div id="update">
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" onclick='document.getElementById("update").innerHTML="";j=1' class="btn btn btn-outline-danger" data-dismiss="modal" value="Cancel">
                            <input type="button" onclick="patchFiliere()" class="btn btn-success" data-dismiss="modal" aria-hidden="true" value="Enregistrer">
                            <input type="hidden" id="filiere_id">
                        </div>
                </form>
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
                        <h4 class="modal-title" id="h4">Supprimier le Filiere</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="messageDelete1">
                        <p>ce filliere ID : <strong id="DeleteId"></strong> et Nom : <strong id="DeleteNom"></strong> est à commencé en supprission</p>
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
        function Edit(i) {
            document.getElementById("filiere").value = document.getElementById(i).children[2].innerText;
            document.getElementById("groupe").value = document.getElementById(i).children[3].innerText;
            document.getElementById("module").value = i;
        }
        var i=1
        function createModuleField() {
            var label =document.createElement('label');
            label.textContent="Module N° "+i;
            var input=document.createElement('input');
            input.setAttribute('class','form-control');
            input.type="text";
            input.placeholder="Nom de Module N° "+ i;
            input.name="module_"+ i;
            var div=document.createElement('div');
            div.setAttribute('class','form-group');
            var coffienceName =document.createElement('label');
            coffienceName.textContent="Coefficient: module N° "+i;
            var coffe =document.createElement('input');
            coffe.setAttribute('class','form-control');
            coffe.type="number";
            coffe.min=0;
            coffe.max=12;
            coffe.name="Coiffinece_"+i;
            var hr= document.createElement('hr');
            hr.style.backgroundColor="#daffda";

            var div1=document.createElement('div');
            div1.setAttribute('class','form-group');
            div1.append(label);
            div1.append(input);

            var div2=document.createElement('div');
            div2.setAttribute('class','form-group');
            div2.append(coffienceName);
            div2.append(coffe);
            
            div.append(div1);
            div.append(div2);
            div.append(hr);
            document.getElementById("add").append(div);
            i++;
        }

        function toggle(source) {
            checkboxes = document.getElementsByName('foo');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
        }


        function CreateFiliereModule() {
            $.ajax({
                    url: "/AdminFilieres",
                    type: 'POST',
                    data: new FormData(document.forms[1]),
                    dataType: 'JSON',
                    contentType:false,
                    cache:false,
                    processData:false,
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
             document.getElementById('filiere_id').value=id;
            
            $.ajax({
                    url: "/AdminFilieres/"+id+"/edit",
                    type: 'GET',
                    data: new FormData(document.forms[2]),
                    dataType: 'JSON',
                    contentType:false,
                    cache:false,
                    processData:false,
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

        
        
    var j=1;
        function createUpdateModuleField(nommodule,coefficient) {
            let label =document.createElement('label');
            label.textContent="Module N° "+j;
            let input=document.createElement('input');
            input.setAttribute('class','form-control');
            input.type="text";
            input.value=nommodule;
            input.placeholder="Nom de Module N° "+ j;
            input.name="module_"+ j;
            let div=document.createElement('div');
            div.setAttribute('class','form-group');
            let coffienceName =document.createElement('label');
            coffienceName.textContent="Coefficient: module N° "+j;
            let coffe =document.createElement('input');
            coffe.setAttribute('class','form-control');
            coffe.type="number";
            coffe.min=0;
            coffe.max=12;
            coffe.name="Coiffinece_"+j;
            coffe.value=coefficient;
            let hr= document.createElement('hr');
            hr.style.backgroundColor="#daffda";

            let div1=document.createElement('div');
            div1.setAttribute('class','form-group');
            div1.append(label);
            div1.append(input);

            let div2=document.createElement('div');
            div2.setAttribute('class','form-group');
            div2.append(coffienceName);
            div2.append(coffe);
            
            div.append(div1);
            div.append(div2);
            div.append(hr);
            document.getElementById("update").append(div);
            j++;
        }

        function patchFiliere() {
            let i =document.getElementById('filiere_id').value;
            $.ajax({
                    url: "/AdminFilieres/"+i,
                    type: 'POST',
                    data: new FormData(document.forms[2]),
                    dataType: 'JSON',
                    contentType:false,
                    cache:false,
                    processData:false,
                    success: function( data ) {
                        console.log(data.message);
                        var d= document.getElementById("divAlert");
                            d.style.display="block";

                        if (data.operation) {
                            d.classList.add('alert-primary');
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


        function DeleteFiliereModule(id,nom) {
            console.log(id);
            document.getElementById('messageDelete1').style.display="block"
            document.getElementById('messageDelete2').style.display="none"
            document.getElementById('DeleteId').textContent=id;
            document.getElementById('DeleteNom').textContent=nom;
            document.getElementById('h4').textContent="Supprimer le Filière" ;
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
                    url: "/AdminFilieres/"+id,
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
            document.getElementById('h4').textContent="Supprimer les Filières" ;
        }
        function CommiteDestroyAll() {
            let arr = [];
            let checkboxs = $('input[type$="checkbox"]');
            for (let index = 1; index < checkboxs.length; index++) {
                 if (checkboxs[index].checked===true) {
                    arr[index]=checkboxs[index].value;
                 }
            }
            $.ajax({
                    url: "/destroyall",
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