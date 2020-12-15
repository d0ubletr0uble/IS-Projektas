<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @method static create(array $array)
 * @method static where(string $string, $userId)
 */
class GroupMember extends Model
{
    use HasFactory;
    public $table = "group_members";

    protected $fillable = ['group_id', 'user_id', 'user_username'];

    public static function getMemberId($groupId, $userId)
    {
        return GroupMember::where('group_id', $groupId)->where('user_id', $userId)->select('id')->first()->id;
    }

}
