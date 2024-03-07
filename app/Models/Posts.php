<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'u_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tags::class, 'contains', 'p_id', 't_id');
    }
}
