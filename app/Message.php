<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $dates=["deleted_at"];
    public function fromContact()
    {
        return $this->hasOne(\App\User::class, 'id', 'from');
    }
}
