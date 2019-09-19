<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Filiere;
class LogingController extends Controller
{
    public function index()
    {
        dd(request());
        $data=request()->validate([
            'nom' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'genre'=>'required|string',
            'dateNaissance'=>'required|string',
        ]);

    }
}
