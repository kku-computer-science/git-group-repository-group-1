<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    //protected $hidden = ['pivot'];

    public function paper()
    {
        return $this->belongsToMany(Paper::class,'author_of_papers')->withPivot('author_type');
        // OR return $this->belongsTo('App\User');
    }

    public function academicwork()
    {
        return $this->belongsToMany(Academicwork::class,'author_of_academicworks')->withPivot('author_type');
        // OR return $this->belongsTo('App\User');
    }
}
