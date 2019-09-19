<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Auth;


class ContactFormController extends Controller
{
    public function create()
    {
        return view("auth.contacts.create");
    }

    public function store()
    {
        $data=request()->validate([
            "nom"=>"sometimes|required",
            "email"=>"sometimes|required|email",
            "message"=>"sometimes|required",
        ]);
        $data['nom']?? ($data['nom']=Auth::user()->nom) ; 
        $data['email']?? ($data['email']=Auth::user()->email) ;
        Mail::to( $data['email'])->send(new ContactFormMail($data));
        
        return redirect("contact")->with("message",", Thanks for your message, We will read it as soon as possible");
    }
}
