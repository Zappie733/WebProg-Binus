<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable; // Gunakan trait yang sudah disediakan Laravel (otomatis mengimplementasi abstract2 method dari Authenticatable)

    public function favoritePets(){
        return $this->hasMany(FavoritePet::class, 'userId', 'id');
    }

    public function favoriteArticles(){
        return $this->hasMany(FavoriteArticle::class, 'userId', 'id');
    }
}
