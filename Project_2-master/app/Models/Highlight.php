<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'image_url', 
        'priority', 
        'status', 
        'expiration_date'
    ];
}
