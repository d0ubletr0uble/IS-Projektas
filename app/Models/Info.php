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
        'user_id',
        'country',
        'device',
        'browser',
        'date',
        'ip',
        'os',
        'provider'
    ];


    public static function info_query(){
        $query_ips = 'SELECT `login_info`.`ip`,COUNT(`login_info`.`ip`) as `num`
                      FROM `login_info`
                      WHERE `login_info`.`user_id` = :id
                      GROUP BY `login_info`.`ip`';
        return $query_ips;
    }

    public static function device_query(){
        $query_devices = 'SELECT `login_info`.`device`,COUNT(`login_info`.`device`) as `num`
                          FROM `login_info`
                          WHERE `login_info`.`user_id` = :id
                          GROUP BY `login_info`.`device`';
        return $query_devices;
    }    
}