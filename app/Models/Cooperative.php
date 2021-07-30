<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooperative extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function kategori(){
        return $this->belongsTo(Category_cooperative::class, 'category_cooperative_id', 'id');
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
