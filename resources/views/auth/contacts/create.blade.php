@extends('layouts.app')
@section("title","SpaceEtablisement | Contactez-Nous")
@section('content')
 <div class="col-md-12 container pt-4">
   <div class="col-12">
     <div class="card">
       <div class="card-body form-group col-md-12">
                  
            <h1 class="pt-5">Contactez-Nous</h1>
            @if(session()->has("message"))
                <div class="alert alert-success" role="alert">
                <strong>Success</strong>{{session()->get("message")}}
                </div>
            @endif
            @if(!session()->has("message"))
            <form action="{{route('contact.store')}}" method="post" class="">
              @if(Auth::user()==null)
                <div class="form-group {{$errors->first('nom')?'has-danger':''}}">
                  <label for="name">Your Name</label>
                  <input name="nom" type="text" value="{{old('nom') }}" class="form-control " id="nom" aria-describedby="emailHelp" placeholder="Enter name">
                  <div style="color:red">{{$errors->first('nom')}}</div>
                </div>
                <div class="form-group {{$errors->first('email')?'has-danger':''}}">
                  <label for="email">Your Email</label>
                  <input type="email" value="{{old('email') }}" name="email" class="form-control " id="email" placeholder="Enter Your Email">
                  <div style="color:red">{{$errors->first('email')}}</div>
              </div>
              @endif
              <div class="form-group {{$errors->first('message')?'has-danger':''}}">
                <label for="message">Message</label>
                <textarea name="message" id="" cols="30" rows="10" class="form-control" placeholder="Your Message ... " >{{old('messgae')}}</textarea>
                <div style="color:red">{{$errors->first('message')}}</div>
              </div>
              <button type="submit" class="btn btn-primary">Send Message</button>
              @csrf
            </form>
            @endif
       </div>
     </div>
   </div>
 </div>
@endsection