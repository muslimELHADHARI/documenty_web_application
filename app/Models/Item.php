<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'file_path', 'cover_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
