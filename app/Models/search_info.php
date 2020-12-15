<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class search_info extends Model
{
    use HasFactory;


    public static function mesg_query(){
        $query_mesg_type = 'SELECT `freedbtech_orange`.`messages`.`type`,COUNT(`freedbtech_orange`.`messages`.`type`) as `num`
                            FROM `freedbtech_orange`.`group_members`
                            INNER JOIN `freedbtech_orange`.`messages`
                            ON `freedbtech_orange`.`group_members`.`group_id` = `freedbtech_orange`.`messages`.`group_id`
                            WHERE `freedbtech_orange`.`group_members`.`user_id` = :id
                            GROUP BY `freedbtech_orange`.`messages`.`type`';
        return $query_mesg_type;
    }
    
    public static function search_query(){
        $query_search = 'SELECT `freedbtech_orange`.`search_info`.`search_info`,`freedbtech_orange`.`search_info`.`date` 
                         FROM `freedbtech_orange`.`search_info`
                         WHERE `freedbtech_orange`.`search_info`.`user_id` = :id';
        return $query_search;
    }
}