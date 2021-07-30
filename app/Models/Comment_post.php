<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_post extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
