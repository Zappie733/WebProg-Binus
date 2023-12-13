<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoritePet extends Model
{
    use HasFactory;

    public function pet(){
        return $this->belongsTo(Pet::class, 'petId', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
