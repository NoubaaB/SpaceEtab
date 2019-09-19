@component('mail::message')
<div><strong>Nom :</strong> {{$data["nom"]}}</div>
<div><strong>Email</strong> {{$data["email"]}}</div>
<div><strong class="pt-5">Message</strong><br>{{$data["message"]}}</div>
Thanks,
{{ config('app.name') }}
@endcomponent
