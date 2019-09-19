<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Filiere;
use App\Stagiaire;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'genre'=>'required|string',
            'groupe'=>'required|string',
            'filiere'=>'required|string',
            'dateNaissance'=>'required|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
         $user=User::create([
            'nom' => $data['nom'],
            'email' => $data['email'],
            'genre' => $data['genre'],
            'dateNaissance'=>$data['dateNaissance'],
            'email_verified_at' => now(),
            'password' => Hash::make($data['password']),
        ]);
            Stagiaire::create([
                "user_id"=> $user->id ,
                "filiere_id"=> $data['filiere'] ,
            ]);
        return $user;
    }

    public function showRegistrationForm()
    {
        $user=new User();
        $filieres=Filiere::all();
        return view("auth.register",compact("user","filieres")); 
    }

}
