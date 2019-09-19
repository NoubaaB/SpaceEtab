@extends('layouts.app')

@section("title","Welcome To Sign-Up/Login Form")
@section('content')
<div class="contaonter pt-4">
    <div class="form-group" style="font-family:'Gill Sans', sans-serif;">
        <div class="alert alert-danger" align="center">
        <h1>Oh no !! What's Happen ?</h1>
        You do not have access rights to check This page <strong>| Requirement :
            @if(session()->has("message"))
             <U>{{session()->get("message")}}</U> Roles</strong> 
            @endif
             <br>            
            <i style="font-size:90px" class="material-icons">policy</i>
            <h2>Forbidden Page :(</h2>

        </div>
    </div>
</div>
@endsection