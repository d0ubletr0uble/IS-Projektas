<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed id
 * @property mixed name
 * @property int|mixed|string|null users_id
 * @method static create(array $array)
 * @method static where(string $string, $userId)
 * @method static join(string $string, string $string1, string $string2)
 */
class Group extends Model
{
    protected $fillable = ['name', 'users_id'];

    public static function getUserGroups($userId)
    {
        return Group::join('group_members', 'group_members.group_id', 'groups.id')->where('user_id', $userId)->get('groups.*');
    }

    public function getMessages()
    {
        if (!$this->hasUser(Auth::id()))
            return response(null, 403);
        else
            return Message::where('group_id', $this->id)->get()->toJson();
    }

    public function getLastMessageId()
    {
        if (!$this->hasUser(Auth::id()))
            return response(null, 401);
        else
            return Message::where('group_id', $this->id)->latest()->first()->id;
    }

    public function hasUser($userId)
    {
        return GroupMember::where('group_id', $this->id)->where('user_id', $userId)->exists();
    }
}
