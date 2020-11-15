<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emoji extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'link', 'user_id'];
}
