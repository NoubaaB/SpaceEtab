@extends('layouts.app')
@section("title","SpaceEtablisement | Modules")
@section('content')
<div class="container pt-2">
        <div class="table-wrapper table-dark pt-4 ">
            <div class="table-title">
                <div class="row pl-2">
                    <div class="col-sm-9">
                        <h2><b>{{Auth::user()->nom}} /</b>Liste de mes Modules</h2>
                    </div>
                </div>
            </div>
            <table class="table table-hover " style="color:white;">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Module</th>
                        <th>Controle N°1</th>
                        <th>Controle N°2</th>
                        <th>Controle N°3</th>
                        <th>Exam Fin de Module</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($modules as $key=>$module )
                    
                        <tr>
                            <td>{{$key+1}}</td>
                        
                            <td>{{$module->nom}}</td>
                            <td>{{$module->controle_N1??'_'}}</td>
                            <td>{{$module->controle_N2??'_'}}</td>
                            <td>{{$module->controle_N3??'_'}}</td>
                            <td>{{$module->EFM??'_'}}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="table-light">
               {{$modules->links()}}
            </div>
        </div>
    </div>

@endsection