<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outsider extends Model
{
    use HasFactory;

    public function researchProject()
    {
        return $this->belongsToMany(ResearchProject::class,'outsiders_work_of_project')->withPivot('role');
        // OR return $this->belongsTo('App\User');
    }
}
