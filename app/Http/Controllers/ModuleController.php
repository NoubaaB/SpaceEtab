<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        if (Auth::user()->stagiaire) {
            $modules=\App\Module::where("stagiaire_id",Auth::user()->stagiaire->id)->paginate(10);
            return view('auth.modules',compact("modules"));    
        }
        else {
            return redirect('/error')->with("message","Stagiaire"); 
        }
    }
}
