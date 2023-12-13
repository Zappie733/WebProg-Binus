<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class, 'categoryId', 'id');
    }

    public function favoriteArticles(){
        return $this->hasMany(FavoriteArticle::class, 'articleId', 'id');
    }
}
