<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cooperative extends Model
{
    use SoftDeletes,HasFactory;

    protected $guarded = [
        'id'
    ];

    public function kategori(){
        return $this->belongsToMany(Category_cooperative::class, 'cooperative_has_categories');
    }

    public function desa(){
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }

    public function kecamatan(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function scopeFilterKecamatan($query, $kecamatan)
    {
        return $query->when($kecamatan, function ($q, $kecamatan) {
            return $q->where('district_id', $kecamatan);
        });
    }

}
