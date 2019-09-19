@extends('layouts.app')

@section("title","SpaceEtablisement | Profile")
@section('content')

<div class="container pt-4" >
    <form method="post" action='users/{{Auth::user()->id}}'  enctype = "multipart/form-data" >
    @csrf
    <div class="alert " style="display:none;" id=divAlert>
        <strong id="alert">

        </strong>
    </div>
        <div class="col-md-12">
            <div class="col-12  ">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Profile| {{Auth::user()->nom}}</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Modifier photo de profile</label>
                                        <div class="col-8">
                                            <label class="btn btn-primary">
                                            <i class="material-icons" style="color:white;font-size:80px;position:absolute">
                                                add_a_photo
                                                </i>
                                                <strong>Importer</strong> Photo de Profile <input onchange="callImage();" name="file" id="file" type="file" style="display: none;">
                                                <span style="padding-left:150px;"><img width="200" height="200" id="profileImg" class="img-thumbnail"  src='{{Auth::user()->image? asset("storage/".Auth::user()->image):asset("storage/uploads/no-profile.png")}}' style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" /></span>

                                            </label>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Nom</label>
                                        <div class="col-8">
                                            <input id="nom" placeholder="nom *" type="text" class="form-control here" name="nom" required autocomplete="nom" value="{{Auth::user()->nom}}" >                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-4 col-form-label">Genre</label>
                                        <div class="col-8">
                                            <select class="form-control" name="genre" id="genre">
                                                <option class="hidden" required disabled>Choisissez votre genre</option>
                                                    @foreach(Auth::user()->genreOption() as $genreKey=>$genreValue)
                                                        <option value="{{$genreKey}}" {{Auth::user()->genre==$genreValue ?"selected":""}}>{{$genreValue}}</option>
                                                    @endforeach
                                            </select>  
                                        </div>
                                    </div>
                                    @if(Auth::user()->stagiaire)
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Année Scolaire</label>
                                        <div class="col-8">
                                            <select class="form-control" name="groupe" id="groupe">
                                                <option value="" class="hidden"  selected disabled>Année Scolaire</option>
                                                <option value="1ere Année">1ere Année</option>
                                                <option value="2eme Année">2eme Année</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Fillier</label>
                                        <div class="col-8">
                                            <select class="form-control" name="filiere" id="filiere" Disabled>
                                                    <option value="{{Auth::user()->stagiaire->filiere->id}}" selected>{{Auth::user()->stagiaire->filiere->nom}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Moyenne</label>
                                        <div class="col-8">
                                            <input id="result" placeholder="Result *" type="text" class="form-control here" name="nom" Disabled autocomplete="result" value='{{Auth::user()->stagiaire->result ? Auth::user()->stagiaire->result + "/20" : "?/20"}}' >                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Heures d'absence</label>
                                        <div class="col-8">
                                            <input id="heures_absence" placeholder="Heures Absence *" type="text" class="form-control here" name="heures_absence" Disabled autocomplete="heures_absence" value='{{Auth::user()->stagiaire->heures_absence ==null? Auth::user()->stagiaire->heures_absence + "Heure(s)" : "zero Absence"}}' >                                            
                                        </div>
                                    </div>
                                    @endif
                                    @if(Auth::user()->formateur)
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Module</label>
                                        <div class="col-8">
                                            <input id="module" placeholder="module *" type="text" class="form-control here" name="module" Disabled autocomplete="result" value='{{Auth::user()->formateur->nom_module ?? "Aucan Module"}}' >                                            
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Date de Naissance</label>
                                        <div class="col-8">
                                            <input id="dateNaissance" placeholder="Date Naissance *" type="date" class="form-control here" name="dateNaissance" required autocomplete="dateNaissance" value='{{Auth::user()->dateNaissance ? Auth::user()->dateNaissance : now()}}' >                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Date de Dernière Modification</label>
                                        <div class="col-8">
                                            <input id="->updated_at" placeholder="->Updated *" type="text" class="form-control here" name="->updated_at" disabled autocomplete="dateNaissance" value='{{Auth::user()->updated_at}}' >                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Confirmer avec votre Mot de passe</label>
                                        <div class="col-8">
                                            <input id="password" name="password" placeholder="Password*" class="form-control here" type="password" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-4 col-form-label"></label>
                                        <div class="col-8 ">
                                            <input id="Enregistrer" value ="Enregistrer" name="Enregistrer" class="btn btn-primary" type="button" onclick="Add1()" required="required">
                                            <a href="#editProjetModal" class="edit btn btn-success " data-toggle="modal">Modifier Mot de passe</a>
                                        </div>
                                    </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


        <!-- Edit Modal HTML -->
        <div id="editProjetModal" class="modal fade pt-4">
            <form action="/" class="form-group" method="POST" enctype = "multipart/form-data" >
            @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Modifier Votre Mot de passe</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input id="pss" name="password" type="password" class="form-control" placeholder="taper mot de passe" required>
                            </div>
                            <div class="form-group">
                                <label>Nouveau mot de passe</label>
                                <input name="nvpassword" pattern=".{8,}" id="NewPassword" type="password" class="form-control" placeholder="min charachter 8*" required>
                            </div>
                            <div class="form-group">
                                <label>Confirmer Votre mot de passe</label>
                                <input name="cnvpassword" pattern=".{8,}" id="confirmPassword" type="password" class="form-control" placeholder="min charachter 8*" required>
                                <p style="color: red ; display: none; " id="error"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input onclick="changepassword()" type="button" class="btn btn-info" data-dismiss="modal" value="Enregistrer">
                        </div>
                    </div>
                </div>
            </form>
        </div>


<script type="text/javascript">
        function changepassword() {
            $.ajax({
                    url: 'edit',
                    type: 'POST',
                    data: new FormData(document.forms[2]),
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
                        }
                        else{
                            d.classList.add('alert-danger')
                            document.getElementById("alert").innerText=data.message;

                        }            
                      }       
                });

        }
function callImage() {
    if (document.getElementById('file').files && document.getElementById('file').files[0]) {
                    var obj = new FileReader();
                    obj.onload = (data) => {
                        var profileImg = document.getElementById('profileImg');
                        profileImg.src = data.target.result;
                    }
                    obj.readAsDataURL(document.getElementById('file').files[0]);
                }

}

            function Add() {
                var password = document.getElementById("pss").value;
                var nvpassword = document.getElementById("NewPassword").value;
                var cnvpassword = document.getElementById("confirmPassword").value;

                var href = '/home/Modifier_Password?password=' + password + '&nvpassword=' + nvpassword + '&cnvpassword=' + cnvpassword;
                document.getElementById('takeAny').setAttribute("href", href);
                alert("Votre Mot de passe Modifier avec Success");
                WebApplication3.WebService1.HelloWorld("onSuccess");

                function onSuccess(data) {
                    alert(data);
                }
            }
            function Add1()
            {

                // var file = document.getElementById("file").files[0];
                // var nom = document.getElementById("nom").value;
                // var genre = document.getElementById("genre").value;
                // var dateNaissance = document.getElementById("dateNaissance").value;
                // var password = document.getElementById("password").value;
                
                // var formdata = new FormData();
                // formdata.append(file.name, file);
                // formdata.append("nom", nom);
                // formdata.append("genre", genre);
                // formdata.append("dateNaissance", dateNaissance);
                // formdata.append("password", password);

                // var xhr = new XMLHttpRequest();
                // xhr.open('POST', 'users/{{Auth::user()->id}}');
                // xhr.send(formdata);
                // //var href = '/home/profileP?file=' + file + '&nom=' + nom + '&prenom=' + prenom + '&genre=' + genre + '&dateNaissance=' + dateNaissance + '&password=' + password;
                // //document.getElementById('takeAny1').setAttribute("href", href);
                // alert("Votre Profile est Modifiere avec Success");
                
                var csrf = $('meta[name="csrf-token"]').attr('content');

                // var formdata = new FormData();
                // formdata.append(file.name, file);
                // formdata.append("nom", nom);
                // formdata.append("genre", genre);
                // formdata.append("dateNaissance", dateNaissance);
                // formdata.append("password", password);
                // formdata.append("csrf", csrf);


                $.ajax({
                    url: 'users',
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
                        }
                        else{
                            d.classList.add('alert-danger')
                            document.getElementById("alert").innerText=data.message;

                        }            
                      }       
                });


            }
        </script>

        <script type="text/javascript">
            this.onload = () => {

                document.getElementById("confirmPassword").onblur = () => {
                    if (document.getElementById("confirmPassword").value !== document.getElementById("NewPassword").value) {
                        document.getElementById("error").textContent = "mot de passe ne pas correspondre";
                        document.getElementById("error").style.display = "contents";
                    }
                    else {
                        document.getElementById("error").textContent = "";
                        document.getElementById("error").style.display = "none";
                    }
                };
            }

            function validateMyForm() {

                for (let i = 0; i < document.forms[1].getElementsByTagName('input').length; i++) {
                    if (document.forms[1].getElementsByTagName('input')[i].value === "") {
                        alert("Entrez toutes vos informations :)");
                        return false;
                    }
                }

                for (let i = 0; i < document.getElementsByTagName('p').length; i++) {
                    if (document.getElementsByTagName('p')[i].style.display === "none") {
                        return true;
                    }
                }
                return false;

            }
        </script>
@endsection