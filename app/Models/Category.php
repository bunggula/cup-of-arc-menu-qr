<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Pinapayagan natin si Laravel na i-save itong mga columns na ito
    protected $fillable = ['name', 'slug'];

    /**
     * Relationship: Isang Category, maraming Items
     */
    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
} // <--- Siguraduhin na dito nagtatapos ang class