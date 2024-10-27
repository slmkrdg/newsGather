<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'published_at',
        'news_id',
        'driver',
    ];


    public function coins()
    {
        return $this->hasMany(Coin::class, 'news_id');
    }
}
