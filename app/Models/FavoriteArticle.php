<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteArticle extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function article(){
        return $this->belongsTo(Article::class, 'articleId', 'id');
    }
}
