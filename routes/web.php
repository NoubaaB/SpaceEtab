<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//profile
        Route::get("/profile",function ()
        {
            $filieres=App\Filiere::all();
            return view("auth.profile",["filieres"=>$filieres]);
        })->middleware('auth')->name('profile');

        Route::post("users","AjaxController@update")->middleware('auth');
        Route::post("edit","AjaxController@editPassword");
//Endprofile

//Modules
        Route::get("/modules","ModuleController@index")->middleware('auth')->name("modules");
//EndModues

//Filieres
            Route::get("/filieres","FiliereController@index")->middleware('auth')->name('filieres.index');
            Route::get("/filieres/{filiere}","FiliereController@show")->middleware('auth')->name('filieres.show');
            Route::post("/filieres/{filiere}","FiliereController@update")->middleware('auth')->name("filieres.update");
//EndFilieres

//ContactForm
            Route::get("contact","ContactFormController@create")->name("contact.create");
            Route::post("contact","ContactFormController@store")->name('contact.store');
//EndContactForm

//Chat
            Route::view("/chat","auth.chat.chat")->middleware('auth')->name("chat");
            Route::get('/contacts', 'ContactsController@get');
            Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
            Route::post('/conversation/send', 'ContactsController@send');
//EndChat

//Error
            Route::get("/error",function(){
                return view("errors.custom");
            });
//EndError

//Admin
            Route::Resource("/AdminFilieres","AdminFiliereController")->middleware('auth');
            Route::post("/AdminFilieres/{AdminFiliere}","AdminFiliereController@update")->middleware('auth');
            Route::post("/destroyall","AdminFiliereController@DestroyAll")->middleware('auth');
            
            Route::Resource("/AdminFormateurs","AdminFormateurController")->middleware('auth');
            Route::post("/destroyallFormateur","AdminFormateurController@DestroyAll")->middleware('auth');
            
            Route::Resource("/AdminStagiaires","AdminStagiaireController")->middleware('auth');
            Route::post("/destroyallStagiaires","AdminStagiaireController@DestroyAll")->middleware('auth');
            // Route::patch("/test",function ()
            // {
            //     dd(json_decode(Request()->getContent(), true));
            // });
//EndAdmin