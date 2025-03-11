<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;
    protected $hidden = [
        
        'pivot'
    ];
    protected $fillable = [
        'paper_name',
        'paper_type',
        'paper_subtype',
        'paper_sourcetitle',
        'paper_url',
        'paper_yearpub',
        'paper_volume',
        'paper_issue',
        'paper_citation',
        'paper_page',
        'paper_doi',
        'paper_funder',
        'reference_number',
        'patent_date',
        'abstract',
        'keyword',
        'publication'
    
    ];
    protected $casts = [
        'keyword' => 'array',
    ];
    public function teacher()
    {
        return $this->belongsToMany(User::class,'user_papers')->withPivot('author_type');
    }

    public function source()
    {
        return $this->belongsToMany(Source_data::class,'source_papers');
    }
    public function author()
    {
        return $this->belongsToMany(Author::class,'author_of_papers')->withPivot('author_type');
        // OR return $this->hasOne('App\Phone');
    }
}
