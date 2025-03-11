<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_th',
        'description_en',
        'description_th',
        'image_url_en',
        'image_url_th',
        'priority'
    ];

    protected $attributes = [
        'priority' => 1, //
    ];
}