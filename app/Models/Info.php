<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon\HasTimestamps;

class Info extends Model
{
    use HasFactory;
    protected $table='login_info';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'id',
        'country',
        'device',
        'browser',
        'date',
        'ip',
        'os',
        'provider'
    ];
}