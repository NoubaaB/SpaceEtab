<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AjaxController extends Controller
{

    public function update(Request $r)
    {
        $data=$this->validateData();
        $user=Auth::user();
        //dd($user);
        if (Auth::attempt(['id' => $user->id, 'password' => $data['password']])) {
            $this->updateImage($user);
            $user->update([
                'nom' => $data['nom'],
                'genre' => $data['genre'],
                'dateNaissance'=>$data['dateNaissance'],
                'email_verified_at' => now(),
                //'password' => Hash::make($data['password']),    
            ]);
            return response()->json([
                'message'=>"modifier avec succes",
                'operation'=>true
            ]);

        }
        else {

            return response()->json([
                'message'=>"failed to make change",
                'operation'=>false
            ]);;
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
            'file'=>'sometimes|file|image|max:5000|mimes:jpeg,png,jpg,gif'
        ]);
        if (Request()->hasFile('image')) {
            Request()->validate([
                'image'=>'file|image'
            ]);
        }
        return $validateData;

    }



    public function editPassword()
    {
        $data= Request()->validate([
            'password' => ['required', 'string'],
            'nvpassword'=>'required|string',
        ]);
        $user=Auth::user();
        if (Auth::attempt(['id' => $user->id, 'password' => $data['password']])) {
        
            $user->update([
                'password' => Hash::make($data['nvpassword']),    
            ]);
            return response()->json([
                'message'=>"modifier avec succes",
                'operation'=>true
            ]);

        }
        else {
            return response()->json([
                'message'=>"Mot de pass est erroné",
                'operation'=>false
            ]);

        }
        
    }

}
