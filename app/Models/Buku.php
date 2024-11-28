<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Buku extends Model
{
    protected $table = 'bukus';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman()
    {
        return $this->hasOne(Peminjaman::class)->latest('created_at')->where('user_id', auth()->id());
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }

    public function koleksi()
    {
        return $this->hasMany(Koleksi::class);
    }

    public function averageRating()
    {
        return $this->ulasans()->avg('rating') ?: 0;
    }

}
//aku jaka dan aku jaka