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
        'title_cn',
        'description_en',
        'description_th',
        'description_cn',
        'image_url_en',
        'image_url_th',
        'image_url_cn',
        'priority'
    ];

    protected $attributes = [
        'priority' => 1, //
    ];
}