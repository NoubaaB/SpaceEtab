<?php

namespace App;
use App\Stagiaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finformation extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;
    protected $dates=["deleted_at"];
    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class);
    }
}
