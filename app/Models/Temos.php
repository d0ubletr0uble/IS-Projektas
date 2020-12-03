<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temos extends Model
{
    use HasFactory;


    public function User()
    {
        return $this->hasOne('App\Models\User', 'id','id');
        return $this->belongsTo('App\Models\User', 'foreign_key', 'owner_key');
    }
}
