<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function update(User $user)
    {
        $data=$this->validateData();
        //dd($user);
        if ($user->password==$data["password"]) {
            $this->updateImage($user);
            $user->update([
                'nom' => $data['nom'],
                'genre' => $data['genre'],
                'dateNaissance'=>$data['dateNaissance'],
                'email_verified_at' => now(),
                'password' => Hash::make($data['password']),    
            ]);
            return redirect("/profile");

        }
        else {
            return "error";
        }
    }

    public function updateImage($user)
    {
        if (Request()->hasFile('file')) {
            $user->update([
                'image'=>Request()->file->store('uploads','public'),
            ]);
        }

    }

    public function validateData()
    {
        
        $validateData= Request()->validate([
            'nom' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'genre'=>'required|string',
            'dateNaissance'=>'required|string',
            'file'=>'sometimes|file|image|max:5000'
        ]);
        if (Request()->hasFile('image')) {
            Request()->validate([
                'image'=>'file|image'
            ]);
        }
        return $validateData;

    }
}
