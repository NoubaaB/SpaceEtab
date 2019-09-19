<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Filiere;
use App\Module;
class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     if (Auth::user()->formateur) {
        $formateur=Auth::user()->formateur;
        $modules=\App\Filiere::where('id',$formateur->id)->first()->modules->where("nom",$formateur->nom_module);
        $filiere_ids=\DB::table('modules')->groupBy('nom','filiere_id')->having("nom",$formateur->nom_module)->select('filiere_id')->get() ;
        $filieres=[];
        foreach ($filiere_ids as   $value) {
            if (\App\Filiere::where("id",$value->filiere_id)->first()) {
                array_push($filieres,\App\Filiere::where("id",$value->filiere_id)->first());
            }
        }
        return view("auth.formateur.filieres",[
            'formateur'=>$formateur,
            "filieres"=>$filieres
            ]);
     }
     else {
         return redirect('/error')->with("message","Formateur");
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Filiere $filiere)
    {
        // $formateur=Auth::user()->formateur;
        // $stagiaires=App\Filiere::where('nom',$formateur->module->filiere->nom)->get()->first()->stagiaires;
        $formateur=Auth::user()->formateur;
        $stagiaires=\App\Module::where("nom",$formateur->nom_module)->paginate(10);
        // $stagiaires=\App\Filiere::where('id',$formateur->id)->first()->modules->where("nom",$formateur->nom_module);
        // $stagiaires=$filiere->stagiaires;
        $count=1;
        return view("auth.formateur.show",compact("stagiaires","count",'formateur'));
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
    public function update(Module $filiere)
    {
           $data=(Request()->validate([
            'c1'=>"min:0|max:100|",
            'c2'=>"min:0|max:100|",
            'c3'=>"min:0|max:100|",
            'efm'=>"min:0|max:100|"
           ]));

           $filiere->update([
               'controle_N1'=>($data['c1']=='_'?null:$data['c1']),
               'controle_N2'=>($data['c2']=='_'?null:$data['c2']),
               'controle_N3'=>($data['c3']=='_'?null:$data['c3']),
               'EFM'=>($data['efm']=='_'?null:$data['efm']),
           ]);
           return response()->json([
            'message'=>"modifier avec succes",
            'operation'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
