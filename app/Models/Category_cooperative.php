<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_cooperative extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function koperasi(){
        return $this->belongsToMany(Cooperative::class, 'cooperative_has_categories');
    }
}
