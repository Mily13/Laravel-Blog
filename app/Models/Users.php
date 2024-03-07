<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Users extends Model
{
    use HasFactory;

    protected $table = 'user';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function posts(): HasMany
    {
        return $this->hasMany(Posts::class, 'u_id');
    }
}
