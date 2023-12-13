<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class, 'categoryId', 'id');
    }

    public function favoritePets(){
        return $this->hasMany(FavoritePet::class, 'petId', 'id');
    }

    //pembelajaran
    //belongsTo(namaclass::class, kunci asing pada table saat ini, kunci primer pada tabel tujuan)
    //hasMany/hasOne(namaclass::class, kunci asing pada table tujuan, kunci primer pada tabel saat ini)
}
