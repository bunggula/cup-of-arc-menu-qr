<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'category_id', 
        'name', 
        'description', 
        'price', 
        'is_best_seller', 
        'is_available', 
        'image'
    ];

    // Relationship: Ang item ay pagmamay-ari ng isang Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}