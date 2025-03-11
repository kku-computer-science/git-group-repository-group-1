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
        'tags',
        'priority'
    ];

    protected $attributes = [
        'priority' => 1, //
    ];

    protected $casts = [
        'tags' => 'array',
    ];
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'highlight_has_tags', 'highlight_id', 'tag_id');
    }
    
    public function hasTags()
    {
        return $this->hasMany(HighlightHasTag::class, 'highlight_id', 'id');
    }

    
}