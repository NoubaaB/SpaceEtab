<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stagiaire extends Model
{
    protected $fillable = ["result","heures_absence","user_id","filiere_id"];
    use SoftDeletes;
    protected $dates=["deleted_at"];
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
    public function filiere()
    {
        return $this->belongsTo(\App\Filiere::class);
    }
    public function finformation()
    {
        return $this->hasOne(\App\Finformation::class);
    }
    public function passage()
    {
        return $this->hasOne(\App\Passage::class);
    }


    public function modules()
    {
        return $this->hasMany(\App\Module::class);
    }
}
