<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $userId)
 */
class GroupMember extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'user_id'];

    public static function getMemberId($groupId, $userId)
    {
        return GroupMember::where('group_id', $groupId)->where('user_id', $userId)->select('id')->first()->id;
    }

}
