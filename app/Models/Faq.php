<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    // Sabihin sa Laravel na itong dalawa lang ang pwedeng i-save
    protected $fillable = ['question', 'answer', 'order'];
}