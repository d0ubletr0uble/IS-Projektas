<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class search_info extends Model
{
    use HasFactory;


    public static function mesg_query(){
        $query_mesg_type = 'SELECT `messages`.`type`,COUNT(`messages`.`type`) as `num`
                            FROM `users`
                            JOIN `group_members`
                            ON `users`.`id` = `group_members`.`user_id`
                            JOIN `messages`
                            ON `group_members`.`id` = `messages`.`group_member_id`
                            WHERE `group_members`.`user_id` = :id
                            GROUP BY `messages`.`type`';
        return $query_mesg_type;
    }
    
    public static function search_query(){
        $query_search = 'SELECT `search_info`.`search_info`,`search_info`.`date` 
                         FROM `search_info`
                         WHERE `search_info`.`user_id` = :id';
        return $query_search;
    }
}