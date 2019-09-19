@extends('layouts.app')
@section("title","SpaceEtablisement | Filiere :: ". $stagiaires->first()->filiere->nom)
@section('content')
<div class="container pt-2">

        <div class="table-wrapper table-dark pt-4">
            <div align="center" class="alert " style="display:none;" id=divAlert>
            <i class="material-icons">thumb_up_alt</i>
                <strong id="alert">

                </strong>
            </div>

            <div class="table-title pb-2">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="pl-2"><b>{{$stagiaires->first()->filiere->nom}} / </b> Liste des stagiaire</h2>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover" style="color:white;">
                <thead>
                    <tr align="center" >
                        <th >Stagiaire ID</th>
                        <th>nom et prenom</th>
                        <th>Controle N°1</th>
                        <th>Controle N°2</th>
                        <th>Controle N°3</th>
                        <th>Exam Fin de Module</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody align="center">
                   
                    @foreach ($stagiaires as $stagiaire)
                        <tr id="{{$stagiaire->id}}">
                            <td align="center">{{$stagiaire->stagiaire->id}}</td>
                            <td>{{$stagiaire->stagiaire->user->nom}}</td>
                            <td>{{$stagiaire->controle_N1??'_'}}</td>
                            <td>{{$stagiaire->controle_N2??'_'}}</td>
                            <td>{{$stagiaire->controle_N3??'_'}}</td>
                            <td>{{$stagiaire->EFM??'_'}}</td>
                            <td>
                                <a href="#editProjetModal" class="edit" data-toggle="modal" onclick="Edit({{$stagiaire->id}})"><i class="material-icons" style="color:yellow" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
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

    <!-- Edit note HTML -->
    <div id="editProjetModal" class="modal fade pt-4">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/" method="POS" enctype = "multipart/form-data">
                                    @csrf
                    <div class="modal-header">
                            <h4 class="modal-title">Stagiaire <b id="stg"></b> <br/> |Modifier Les Notes</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Controle N°1</label>
                                    <input id="c1" name="c1" type="text" class="form-control" placeholder="Controle N°1" required>
                                </div>
                                <div class="form-group">
                                    <label>Controle N°2</label>
                                    <input id="c2" name="c2" type="text" class="form-control" placeholder="Controle N°2" required>
                                </div>
                                <div class="form-group">
                                    <label>Controle N°3</label>
                                    <input id="c3" name="c3"  type="text" class="form-control" placeholder="Controle N°3" required>
                                    <p style="color: red ; display: none; " id="error"></p>
                                </div>
                                <div class="form-group">
                                    <label>EFM</label>
                                    <input id="efm" name="efm" type="text" class="form-control" placeholder="Exam fin de module" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input data-dismiss="modal" aria-hidden="true" type="button" onclick="updateNote()" class="btn btn-info" value="Enregistrer">
                                <input type="hidden" value="" name="module" id="module" />
                            </div>
                    </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        
        this.onload=()=>
        {
            document.getElementById('c1').onkeypress = (event) => {
                var key = window.event ? event.keyCode : event.which;
                if (event.keyCode === 8 || event.keyCode === 46) {
                    return true;
                } else if (key < 48 || key > 57) {
                    return false;
                } else {
                    return true;
                }
            }
            document.getElementById('c2').onkeypress = (event) => {
                var key = window.event ? event.keyCode : event.which;
                if (event.keyCode === 8 || event.keyCode === 46) {
                    return true;
                } else if (key < 48 || key > 57) {
                    return false;
                } else {
                    return true;
                }
            }
            document.getElementById('c3').onkeypress = (event) => {
                var key = window.event ? event.keyCode : event.which;
                if (event.keyCode === 8 || event.keyCode === 46) {
                    return true;
                } else if (key < 48 || key > 57) {
                    return false;
                } else {
                    return true;
                }
            }
            
            document.getElementById('efm').onkeypress = (event) => {
                var key = window.event ? event.keyCode : event.which;
                if (event.keyCode === 8 || event.keyCode === 46) {
                    return true;
                } else if (key < 48 || key > 57) {
                    return false;
                } else {
                    return true;
                }
            }

            

        }

    </script>
    <script>
        function Edit(i) {


            document.getElementById("stg").innerText = document.getElementById(i).children[1].innerText;
            document.getElementById("c1").value = document.getElementById(i).children[2].innerText;
            document.getElementById("c2").value = document.getElementById(i).children[3].innerText;
            document.getElementById("c3").value = document.getElementById(i).children[4].innerText;
            document.getElementById("efm").value = document.getElementById(i).children[5].innerText;
            document.getElementById("module").value = i;
        }

        function updateNote() {
            $.ajax({
                    url: "/filieres/" +document.getElementById("module").value,
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
                            document.getElementById(i).children[1].innerText=document.getElementById("stg").innerText  ;
            document.getElementById(i).children[2].innerText=document.getElementById("c1").value       ;
            document.getElementById(i).children[3].innerText=document.getElementById("c2").value       ;
            document.getElementById(i).children[4].innerText=document.getElementById("c3").value       ;
            document.getElementById(i).children[5].innerText=document.getElementById("efm").value      ;

                        }
                        else{
                            d.classList.add('alert-danger')
                            document.getElementById("alert").innerText=data.message;

                        }            
                      }       
                });
        }


        
    </script>

@endsection