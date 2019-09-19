<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Stagiaire;
use App\Formateur;
use App\Module;
use App\Filiere;
use App\Finformation;
use App\Passage;
use App\Admin;

use Illuminate\Http\Request;

class AdminFiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if (Auth::user()->admin) {
            $filieres= Filiere::paginate(10);
            return view("auth.admin.filiere",compact("filieres"));  
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
        if (Auth::user()->admin) {
            $data=$request->all();
            // dd($data);
            $filiere=Filiere::create([
                "nom"=>$data["filiere"],
                "groupe"=>$data["groupe"]
            ]);

            for ($i=1; $i <= (count($data)-3)/2; $i++) { 
                Module::create([
                    "nom"=>$data["module_" . +$i],
                    'coefficient'=>$data['Coiffinece_'.$i],
                    'filiere_id'=>$filiere->id
                ]);
            }

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
        if (Auth::user()->admin) {
            $filiere=Filiere::where('id',$id)->select('id',"nom","groupe")->first();

            $modules=Module::where("filiere_id",$id)->distinct()->select('nom',"coefficient")->get();

            return response()->json([
                'filiere'=>$filiere,
                'modules'=>$modules,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->admin) {
            $data=$request->all();
            $filiere=Filiere::find($id);
            $filiere->update([
                'nom'=>$data['Updatefiliere'],
                'groupe'=>$data['Updategroupe']
                ]);
                
            for ($i=1; $i <= (count($data)-3)/2; $i++) { 
                $Modules=Module::where(['filiere_id'=>$id,'nom'=>$data['module_'.$i]])->get();
                foreach ($Modules as $module) {
                    $module->update([
                        'coefficient'=>$data['Coiffinece_'.$i],
                    ]);
                }
            }

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

            $filiere=Filiere::find($id);
            $filiere->delete();
            $modules = Module::where("filiere_id",$id)->get();
            if ($modules) {
                foreach ($modules as  $module) {
                    $module->delete();
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

    public function DestroyAll()
    {
        // dd(json_decode(Request()->getContent(), true));
         if (Auth::user()->admin) {

            $filieres_id=json_decode(Request()->getContent(), true);
            
            foreach ($filieres_id as  $id) {
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
