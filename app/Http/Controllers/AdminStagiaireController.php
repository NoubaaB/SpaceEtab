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

class AdminStagiaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->admin) {
            $stagiaires =Stagiaire::paginate(10);
            $filieres = Filiere::all();
            return view("auth.admin.stagiaire",compact("stagiaires","filieres"));
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
        dd(json_decode($request->getContent(), true));

        if (Auth::user()->admin) {
            $filiere=Filiere::find(json_decode($request->getContent(), true)[4]);
            $user=User::create([
                "nom"=>json_decode($request->getContent(), true)[0] ,
                'dateNaissance'=>json_decode($request->getContent(), true)[1],
                'email'=>json_decode($request->getContent(), true)[2],
                "genre"=>json_decode($request->getContent(), true)[6],
                "passwrd"=>json_decode($request->getContent(), true)[3]==""?"password":Hash::make(json_decode($request->getContent(), true)[3]),                

            ]);
            $stagiaire=Stagiaire::create([
                'user_id'=>$user->id,
                'filiere_id'=>$filiere->id,
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
        // dd(json_decode($request->getContent(), true));

        if (Auth::user()->admin) {
            $stagiaire=Stagiaire::find($id);
            $user=$stagiaire->user;
            $filiere=Filiere::find(json_decode($request->getContent(), true)[5]);
            $stagiaire->update([
                "result"=>json_decode($request->getContent(), true)[6],
                "heures_absence"=>json_decode($request->getContent(), true)[8],
                "filiere_id"=>$filiere->id,
            ]);
            
            $user->update([
                "nom"=>json_decode($request->getContent(), true)[1] ,
                'dateNaissance'=>json_decode($request->getContent(), true)[3],
                'email'=>json_decode($request->getContent(), true)[2],
                "genre"=>json_decode($request->getContent(), true)[9],
                "passwrd"=>json_decode($request->getContent(), true)[4]==""?"password":Hash::make(json_decode($request->getContent(), true)[4]),                
               
            ]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);

        if (Auth::user()->admin) {

            $stagiaire=Stagiaire::find($id);
            $user=$stagiaire->user;
            $stagiaire->delete();
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
        dd(json_decode(Request()->getContent(), true));
        if (Auth::user()->admin) {

            $stagiaires_id=json_decode(Request()->getContent(), true);
            
            foreach ($stagiaires_id as  $id) {
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
