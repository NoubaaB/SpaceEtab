<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $dates=["deleted_at"];
    public function filiere()
    {
            return $this->belongsTo(\App\Filiere::class);
    }
    public function stagiaire()
    {
        return $this->belongsTo(\App\Stagiaire::class);
    }
}
