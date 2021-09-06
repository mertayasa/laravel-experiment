<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'image',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
    ];


    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }

    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }

    public function media()
    {
        return $this->hasMany(\App\Models\Media::class);
    }
}
