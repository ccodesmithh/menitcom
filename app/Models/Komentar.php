<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'isi',
        'berita_id'
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }

}
