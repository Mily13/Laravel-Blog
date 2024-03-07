<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contains extends Model
{
    protected $table = 'contains';
    public $timestamps = false;
    protected $guarded = ['id'];

    public static function getPostsByTagIds($t_ids){
        return self::whereIn('t_id', $t_ids)->distinct()->pluck('p_id')->toArray();
    }
}
