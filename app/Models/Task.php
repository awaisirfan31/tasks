<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','datetime'
    ];


    public static function timeZone()
    {
        $ipInfo = file_get_contents('http://ip-api.com/json/103.75.102.252');
        $ipInfo = json_decode($ipInfo);
        
        return $ipInfo;
    }
}
