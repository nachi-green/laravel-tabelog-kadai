<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Kyslik\ColumnSortable\Sortable;

class Shop extends Model
{
    use HasFactory, Favoriteable, Sortable;

    protected $dates = [
        'start_time', 'close_time',
    ];

    public function books() {
        return $this->hasMany(Book::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
