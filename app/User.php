<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $dates=["deleted_at"];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'email', 'password','genre','dateNaissance','image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function stagiaire()
    {
        return $this->hasOne(\App\Stagiaire::class);
    }
    public function formateur()
    {
        return $this->hasOne(\App\Formateur::class);
    }
    public function admin()
    {
        return $this->hasOne(\App\Admin::class);
    }
    public function getGenreAttribute($attribute)
    {
        return $this->genreOption()[$attribute];
    }
    public function genreOption()
    {
        return [
            'h'=>"Homme",
            'f'=>"Femme"
        ];
    }
    protected $attributes=[
        "genre"=>'h',
    ];
}
