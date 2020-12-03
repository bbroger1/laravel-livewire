<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    //recuperar o usário que postou o tweet
    //relacionamento de muitos para um
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
