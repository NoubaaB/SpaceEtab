@extends('layouts.app')
@section("title","SpaceEtablisement | Chat")
@section('content')
<div class="container pt-4">
<div class="row justify-content-center">
        <div class="col-sm-12 ">
            <div class="card ">
                <div class="card-header"><strong>{{ config('app.name', 'Laravel') }} |</strong> Messages</div>

                <div class="card-body" id="app">
                    <chat-app :user="{{ auth()->user() }}"></chat-app>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection