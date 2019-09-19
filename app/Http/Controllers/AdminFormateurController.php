<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Stagiaire;
use App\Formateur;
use App\Module;
use App\Filiere;
use App\Finformation;
use App\Passage;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminFormateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->admin) {
            $formateurs =Formateur::paginate(10);
            $modules = Module::distinct()->select("nom")->get();
            return view("auth.admin.formateur",compact("formateurs","modules"));
        }
        else {
            return redirect('/error')->with("message","admin");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(json_decode($request->getContent(), true));
        if (Auth::user()->admin) {

            $user=User::create([
                'nom'=>json_decode($request->getContent(), true)[0],
                "dateNaissance"=>json_decode($request->getContent(), true)[1],
                "email"=> json_decode($request->getContent(), true)[2],
                "password"=>json_decode($request->getContent(), true)[3]==""?"password":Hash::make(json_decode($request->getContent(), true)[3]),
            ]);
            Formateur::create([
                'nom_module'=> json_decode($request->getContent(), true)[4],
                'user_id'=>$user->id,
            ]);
            
            return response()->json([
                'message'=>"Ajouter Avec success",
                'operation'=>true
            ]);
        }
        else {
            return response()->json([
                'message'=>"failed to add Filiere change",
                'operation'=>false
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd(json_decode(Request()->getContent(), true)[0]);
        if (Auth::user()->admin) {

            $formateur_id=json_decode(Request()->getContent(), true)[0];
            $formateur=Formateur::find($formateur_id);
            $formateur->update([
                'nom_module'=> json_decode(Request()->getContent(), true)[5],
            ]);
            $formateur->user->update([
                'nom'=>json_decode(Request()->getContent(), true)[1] ,
                "email"=> json_decode($request->getContent(), true)[2],
                'dateNaissance'=> json_decode(Request()->getContent(), true)[3],
                "password"=>json_decode($request->getContent(), true)[4]==""?"password":Hash::make(json_decode($request->getContent(), true)[3]),

            ]);
            return response()->json([
                'message'=>"Modifier Avec success",
                'operation'=>true
            ]);
        }
        else {
            return response()->json([
                'message'=>"failed to add Filiere change",
                'operation'=>false
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->admin) {

            $formateur=Formateur::find($id);
            $user=$formateur->user;
            $formateur->delete();
            $user->delete();
            
            return response()->json([
                'message'=>"Supprimier Avec success",
                'operation'=>true
            ]);
        }
        else {
            return response()->json([
                'message'=>"failed to add Filiere change",
                'operation'=>false
            ]);
        }
    }

    public function DestroyAll()
    {
        if (Auth::user()->admin) {

            $formateurs_id=json_decode(Request()->getContent(), true);
            
            foreach ($formateurs_id as  $id) {
                if ($id!=null) {
                    destroy($id);
                }
            }
            return response()->json([
                'message'=>"Supprimier Avec success",
                'operation'=>true
            ]);
        }
        else {
            return response()->json([
                'message'=>"failed to add Filiere change",
                'operation'=>false
            ]);
        }
    }
}
