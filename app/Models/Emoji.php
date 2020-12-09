<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int|string|null $id)
 */
class Emoji extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'link', 'user_id'];

    public static function getUserEmojis($userId)
    {
        return Emoji::where('user_id', $userId)->get();
    }
}
