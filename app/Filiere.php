<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filiere extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $dates=["deleted_at"];
    public function modules()
    {
        return $this->hasMany(\App\Module::class);
    }
    public function stagiaires()
    {
        return $this->hasMany(\App\Stagiaire::class);
    }
}
