<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';

    protected $fillable = [
        'nama',
    ];

    public function bukus()
    {
        return $this->hasMany(Buku::class);
    }
}
