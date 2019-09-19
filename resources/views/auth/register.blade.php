@extends('layouts.app')

@section("title","Welcome To Sign-Up/Login Form")
@section('content')

<!-- -->

<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="{{ asset('Xfolder/image/logo_white.png') }}" alt=""/>
                        <h3>Bienvenue</h3>
                        <p>Ce site est créé pour faciliter la connexion entre Directeur , Formateur , Serveillance et Stagiaire!</p>
                        <input type="button"  value="Space Des Admins"/><br/>
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">S'inscrire</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Connection</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Form D'inscrire</h3>
                                     <form action="{{ route('register') }}" method="post" class="row register-form col-md-12" onsubmit="return validateMyForm();" >
                                     @csrf

                                    <div class="col-md-6">
                                        <div class="form-group  {{$errors->first('nom')?'has-danger':''}}">
                                            <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom et Prenom *" value="{{old('nom')}}" required autocomplete="nom" />
                                            <div style="color:red">{{$errors->first('nom')}}</div>
                                        </div>
                                        <div class="form-group   {{$errors->first('email')?'has-danger':''}}">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email *" value="{{old('email')}}" required autocomplete="email"/>
                                            <div style="color:red">{{$errors->first('prenom')}}</div>
                                        </div>
                                        <div class="form-group   {{$errors->first('password')?'has-danger':''}}">
                                            <input id="password" placeholder="Mot de passe *" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            <div style="color:red">{{$errors->first('password')}}</div>
                                        </div>
                                        <div class="form-group   {{$errors->first('password-confirm')?'has-danger':''}}">
                                            <input id="password-confirm" placeholder="Confirmer Votre Mot de passe *" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">                                            
                                            <p style="color: red ; display: none; " id="error"></p>
                                            <div style="color:red">{{$errors->first('password-confirm')}}</div>
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group   {{$errors->first('genre')?'has-danger':''}}">
                                            <select class="form-control" name="genre" id="genre">
                                                <option class="hidden"  selected disabled>Choisissez votre genre</option>
                                                @foreach($user->genreOption() as $genreKey=>$genreValue)
                                                     <option value="{{$genreKey}}">{{$genreValue}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group   {{$errors->first('groupe')?'has-danger':''}}">
                                            <select class="form-control" name="groupe" id="groupe">
                                                <option class="hidden"  selected disabled>Année Scolaire</option>
                                                <option value="1ere Année">1ere Année</option>
                                                <option value="2eme Année">2eme Année</option>
                                            </select>
                                        </div>
                                        <div class="form-group   {{$errors->first('filiere')?'has-danger':''}}">
                                            <select class="form-control" name="filiere" id="filiere">
                                                <option class="hidden"  selected disabled>Choisissez votre Fillier</option>
                                                @foreach($filieres as $filiere)
                                                    <option value="{{$filiere->id}}">{{$filiere->nom}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group   {{$errors->first('dateNaissance')?'has-danger':''}}">
                                            <input type="date" name="dateNaissance"  id="dateNaissance" class="form-control" title="Donner Votre date de Naissance" placeholder="Donner Votre date de Naissance *" value="" />
                                            <div style="color:red">{{$errors->first('dateNaissance')}}</div>
                                        </div>
                                        <input type="submit" class="btnRegister"  id="btnConnetion"  value="Register"/>
                                    </div>
                                </form>
                            </div>
                           
                                <div class="tab-pane fade show " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Connection</h3>
                                <form method="post" action="{{ route('login') }}" class="row register-form col-md-12">
                                @csrf
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('Email')?'has-danger':''}}">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email *" value="{{old('Email')}}" />
                                            <div style="color:red">{{$errors->first('Email')}}</div>
                                        </div>  
                                        <div class="form-group pl-4">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>                              
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group   {{$errors->first('password')?'has-danger':''}}">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe *" value="" />
                                            <div style="color:red">{{$errors->first('password')}}</div>
                                        </div>
                                        <div class="form-group">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                        </div>
                                        <input type="submit" class="btnRegister"  value="Connection"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
<script>
    this.onload=()=>{
        document.getElementById("password-confirm").onblur=()=>{
                if(document.getElementById("password-confirm").value!==document.getElementById("password").value)
                {
                    document.getElementById("error").textContent="mot de passe ne pas correspondre";
                    document.getElementById("error").style.display="contents";
                }
            else{
                document.getElementById("error").textContent="";
                document.getElementById("error").style.display="none";
            }
        };
        
        



        
    }
    function validateMyForm()
        {
          
            for(let i =0; i<document.forms[0].getElementsByTagName('input').length;i++)
            {
               if(document.forms[0].getElementsByTagName('input')[i].value==="")
                {
                  alert("Entrez toutes vos informations :)");
                  return false;
                }
            }
            
            for(let i =0; i<document.getElementsByTagName('p').length;i++)
            {
               if(document.getElementsByTagName('p')[i].style.display==="none")
                {
                  return true;
                }
            }            
            return false;
           
        }
</script>
@endsection
