<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    //recuperar o usário que postou o tweet
    //relacionamento de muitos para um
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        //no where é passada uma função de callback para verificar se o usuário está autenticado
        //se estiver marca os tweets curtidos
        return $this->hasMany(Like::class)
            ->where(function ($query) {
                if (auth()->check()) {
                    $query->where('user_id', auth()->user()->id);
                }
            });
    }
}
