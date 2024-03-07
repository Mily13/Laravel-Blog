<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tags extends Model
{
    use HasFactory;

    protected $table = 'tags';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Posts::class, 'contains', 't_id', 'p_id');
    }
}
