@extends('layouts.app')
@section("title","SpaceEtablisement | Filieres")
@section('content')
<div class="container pt-2">
            <div class="table-wrapper table-dark pt-4">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <h2><b>{{Auth::user()->nom}} /</b>Tableau des taches|<b>Management</b></h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover" style="color:white;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Module</th>
                            <th>Fillier</th>
                            <th>Année Acolaire</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filieres as $key=>$filiere )
                        
                        <tr>
                            <td>{{$key+1}}</td>
                            
                            <td>{{$formateur->nom_module}}</td>
                            <td>{{$filiere->nom}}</td>
                            <td>{{$filiere->groupe}}</td>
                            <td>
                                <a target="_blank" href="{{route('filieres.show',$filiere->id)}}"><i class="material-icons">edit</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        @endsection