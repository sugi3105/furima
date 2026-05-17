<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Category;
class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'brand',
        'description',
        'img_url',
        'condition',
        'user_id',
        'is_sold',
        'purchaser_id',
    ];

    public function likes()
    {
      return $this->hasMany(Like::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    public function purchase()
    {
      return $this->hasOne(Purchase::class);
    }

    public function categories()
    {
      return $this->belongsToMany(Category::class);
    }
}
