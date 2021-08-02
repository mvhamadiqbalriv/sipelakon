<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function scopeFilterJudul($query, $judul)
    {
        return $query->when($judul, function ($q, $judul) {
            return $q->where('judul', 'LIKE', "%$judul%");
        });
    }

    public function scopeFilterPermission($query)
    {
        if (Auth::user()->jenis_akun == 'koperasi') {
            return $query->whereHas('user', function ($query) {
                 $query->where('cooperative_id', '=', Auth::user()->cooperative_id);
                 $query->orWhere('jenis_akun', '=', 'admin');
                 return $query->orWhere('jenis_akun', '=', 'dinas');
            });
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
