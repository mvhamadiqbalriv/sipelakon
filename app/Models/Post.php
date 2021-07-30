<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function kategori(){
        return $this->belongsTo(Category_post::class, 'category_post_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment_post::class);
    }

    public function scopeFilterCategory($query, $category)
    {
        return $query->when($category, function ($q, $category) {
            return $q->where('category_post_id', $category);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
