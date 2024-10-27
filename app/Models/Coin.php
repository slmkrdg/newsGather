<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

    protected $table = 'coins';

    protected $fillable = [
        'name',
        'code',
        'news_id',
    ];


    public function news()
    {
        return $this->belongsTo(News::class, 'id');
    }
}
