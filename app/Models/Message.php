<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, mixed $id)
 */
class Message extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'type', 'status', 'group_id', 'group_member_id'];
}
